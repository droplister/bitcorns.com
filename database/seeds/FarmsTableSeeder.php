<?php

use Curl\Curl;
use App\Coop;
use App\Farm;
use App\Upload;
use App\MapMarker;
use Illuminate\Database\Seeder;

class FarmsTableSeeder extends Seeder
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->curl = new Curl();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farms = $this->getFarms();
        $coops = $this->getCoops();

        foreach($farms as $data)
        {
            // Farm
            $farm = Farm::findBySlug($data['address']);

            // Edge Case
            if(! $farm) continue;
            
            // Coop
            $coop = $this->getCoop($data['group']);

            // Harvests
            $this->updateHarvests($farm, $coops);

            // Map Marker
            $this->handleMapMarker($farm, $data);

            // Uploads
            $this->handleUploads($farm, $data['uploads']);

            // Image URL
            $image_url = $this->currentImage($data['image_url']);

            $farm->update([
                'coop_id' => isset($coop) ? $coop->id : null,
                'name' => strlen($data['name']) <= 30 ? $data['name'] : $farm->name,
                'image_url' => $image_url,
                'content' => $data['description'],
            ]);
        }
    }

    /**
     * Get Coop
     * 
     * @param  array  $coop
     * @return mixed
     */
    private function getCoop($coop)
    {
        if(! $coop) return null;

        return Coop::firstOrCreate([
            'name' => $coop['name'],
        ],[
            'content' => $coop['description'],
        ]);
    }

    /**
     * Update Harvests
     * 
     * @param  \App\Farm  $farm
     * @param  array  $coops
     * @return void
     */
    private function updateHarvests($farm, $coops)
    {
        $harvests = $this->getRewards($farm->xcp_core_address);

        foreach($harvests as $harvest)
        {
            $coop_id = $harvest['pivot']['group_id'] ? Coop::findBySlug($coops[$harvest['pivot']['group_id']])->id : null;

            DB::table('farm_harvest')
                ->where('harvest_id', '=', $harvest['pivot']['reward_id'])
                ->where('farm_id', '=', $farm->id)
                ->update(['coop_id' => $coop_id]);
        }
    }

    /**
     * Handle Map Marker
     *
     * @param  \App\Farm  $farm
     * @param  array  $data
     * @return \App\MapMarker
     */
    private function handleMapMarker($farm, $data)
    {
        if($data['latitude'] === null) return false;

        return MapMarker::create([
            'farm_id' => $farm->id,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'settings' => [
                'options' => [
                    'editable' => false,
                    'strokeColor' => '#000000',
                    'fillColor' => '#FFFFFF',
                ]
            ],
            'major' => 1,
        ]);
    }

    /**
     * Handle Uploads
     * 
     * @param  \App\Farm  $farm
     * @param  array  $uploads
     * @return void
     */
    private function handleUploads($farm, $uploads)
    {
        // Uploads
        foreach($uploads as $data)
        {
            $new_image_url = $this->downloadUrl($data['new_image_url']);
            $old_image_url = $this->getOldImage($data['old_image_url']);

            $upload = new Upload([
                'new_image_url' => $new_image_url,
                'old_image_url' => $old_image_url,
                'approved_at' => $data['accepted_at'],
                'rejected_at' => $data['rejected_at'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
            ]);

            $farm->uploads()->save($upload);
        }
    }

    /**
     * Download URL
     * 
     * @param  string  $url
     * @return string
     */
    private function downloadUrl($url)
    {
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        $image_path = Storage::put('public/farms/' . $name, $contents);

        return '/storage/farms/' . $name;
    }

    /**
     * Get Old Image
     *
     * @param  string  $url
     * @return string
     */
    private function getOldImage($url)
    {
        if(substr($url, 0, 15) === 'https://bitcorns.com/img/')
        {
            return '/images/default/' . substr($url, -5);
        }
        else
        {
            return $this->downloadUrl($url);
        }
    }

    /**
     * Current Image
     * 
     * @param  string  $image_url
     * @return string
     */
    private function currentImage($image_url)
    {
        // Default Image
        if(substr($image_url, 0, 31) === 'https://bitcorns.com/img/farms/')
        {
            return str_replace('https://bitcorns.com/img/farms/', '/images/default/', $image_url);
        }

        return str_replace('https://bitcorns.com/storage/custom/', '/storage/farms/', $image_url);
    }

    /**
     * Get Coops
     * 
     * @return array
     */
    private function getCoops()
    {
        $this->curl->get('https://bitcorns.com/api/migrate/groups');

        if ($this->curl->error) return []; // Some Error

        return json_decode($this->curl->response, true);
    }

    /**
     * Get Farms
     * 
     * @return array
     */
    private function getFarms()
    {
        $this->curl->get('https://bitcorns.com/api/migrate/farms');

        if ($this->curl->error) return []; // Some Error

        return json_decode($this->curl->response, true);
    }

    /**
     * Get Rewards
     * 
     * @return array
     */
    private function getRewards($address)
    {
        $this->curl->get('https://bitcorns.com/api/migrate/rewards/' . $address);

        if ($this->curl->error) return []; // Some Error

        return json_decode($this->curl->response, true);
    }
}