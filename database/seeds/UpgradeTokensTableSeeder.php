<?php

use Curl\Curl;
use App\Token;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UpgradeTokensTableSeeder extends Seeder
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
        $tokens = $this->getTokens();

        $harvest_id = 1;

        foreach($tokens as $token)
        {
            // Harvest
            if($token['name'] === 'CORNBADGER') $harvest_id = 2;

            // Ranking
            $harvest_ranking = Token::published()->whereType('upgrade')->where('harvest_id', '=', $harvest_id)->count() + 1;
            $overall_ranking = Token::published()->whereType('upgrade')->count() + 1;

            // Save Image
            $contents = file_get_contents($token['image_url']);
            $name = substr($token['image_url'], strrpos($token['image_url'], '/') + 1);
            $image_path = Storage::put('public/tokens/' . $name, $contents);
            $image_url = Storage::url($image_path);

            Token::create([
                'xcp_core_asset_name' => $token['name'],
                'harvest_id' => $harvest_id,
                'type' => 'upgrade',
                'name' => $token['display_name'],
                'image_url' => $image_url,
                'content' => $token['content'],
                'meta_data->harvest_ranking' => $harvest_ranking,
                'meta_data->overall_ranking' => $overall_ranking,
                'approved_at' => $token['public'] === 1 ? $token['updated_at'] : null,
                'published_at' => $token['public'] === 1 ? $token['updated_at'] : null,
            ]);
        }
    }

    /**
     * Get Tokens
     * 
     * @return array
     */
    private function getTokens()
    {
        $this->curl->get('https://bitcorns.com/api/migrate/cards');

        if ($this->curl->error) return []; // Some Error

        return json_decode($this->curl->response, true);
    }
}