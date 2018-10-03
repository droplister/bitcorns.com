<?php

namespace App\Jobs;

use App\Farm;
use App\Quote;
use Droplister\XcpCore\App\Credit;
use App\Achievements\SaltOfTheEarth;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateFarm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Credit
     *
     * @var \Droplister\XcpCore\App\Credit
     */
    protected $credit;

    /**
     * Create a new job instance.
     *
     * @param  \Droplister\XcpCore\App\Credit  $credit
     * @return void
     */
    public function __construct(Credit $credit)
    {
        $this->credit = $credit;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Make Farm
        $farm = $this->createFarm();

        // New Farms
        if ($farm->wasRecentlyCreated) {
            // Achievement!
            $farm->unlockIfLocked(new SaltOfTheEarth());

            // Farm Ordinal
            if ($farm->name !== 'Genesis Farm') {
                $farm->update(['name' => substr($farm->name, 0, -4) . $farm->id]);
            }
        }
    }

    /**
     * Create Farm
     *
     * @return \App\Farm
     */
    private function createFarm()
    {
        return Farm::firstOrCreate([
            'xcp_core_address' => $this->credit->address,
        ], [
            'xcp_core_credit_id' => $this->credit->id,
            'name' => $this->getName(),
            'image_url' => $this->getImageUrl(),
            'content' => $this->getContent(),
        ]);
    }

    /**
     * Get Name
     *
     * @return string
     */
    private function getName()
    {
        if ($this->credit->action === 'issuance') {
            return 'Genesis Farm';
        }

        return 'Bitcorn Farm #' . $this->getSalt();
    }

    /**
     * Get Salt
     *
     * @return string
     */
    private function getSalt()
    {
        // Avoid Collisions
        $a = chr(rand(65, 90));
        $b = chr(rand(65, 90));
        $c = chr(rand(65, 90));
        $d = chr(rand(65, 90));

        return $a . $b . $c . $d;
    }

    /**
     * Get Image Url
     *
     * @return string
     */
    private function getImageUrl()
    {
        return '/images/default/' . rand(1, 12) . '.jpg';
    }

    /**
     * Get Content
     *
     * @return string
     */
    private function getContent()
    {
        $quote = Quote::inRandomOrder()->first();

        return $quote->formatted;
    }
}
