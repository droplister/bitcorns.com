<?php

use App\Harvest;
use Illuminate\Database\Seeder;

class HarvestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $harvests = $this->getHarvests();

        foreach($harvests as $harvest)
        {
            Harvest::create($harvest);
        }
    }

    /**
     * Get Harvests
     * 
     * @return array
     */
    private function getHarvests()
    {
        return [
            [
                'name' => 'Bitcorn Harvest #1',
                'content' => 'The first harvest ever! Welcome to Bitcorn, enjoy your stay...',
                'image_url' => '/images/harvests/spring.jpg',
                'quantity' => 2625000,
                'scheduled_at' => '2018-04-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #2',
                'content' => 'It\'s the summer time, and Bitcorn Crops is in full-stride.',
                'image_url' => '/images/harvests/summer.jpg',
                'quantity' => 2625000,
                'scheduled_at' => '2018-07-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #3',
                'content' => 'What a lovely day for a harvest. Let\'s round out 2018 strong!',
                'image_url' => '/images/harvests/fall.jpg',
                'quantity' => 2625000,
                'scheduled_at' => '2018-10-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #4',
                'content' => 'Last harvest at this level. First halvening soon! PANIC!!!',
                'image_url' => '/images/harvests/winter.jpg',
                'quantity' => 2625000,
                'scheduled_at' => '2019-01-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #5',
                'content' => 'Harvesting has become back breaking work... This game stinks!',
                'image_url' => '/images/harvests/fall.jpg',
                'quantity' => 1312500,
                'scheduled_at' => '2019-04-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #6',
                'content' => 'Remember 2018? Pepperidge Farms remembers... Bring back easy corn!',
                'image_url' => '/images/harvests/summer.jpg',
                'quantity' => 1312500,
                'scheduled_at' => '2019-07-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #7',
                'content' => 'Spooktacular harvest everyone! See you soon in 2020...',
                'image_url' => '/images/harvests/fall.jpg',
                'quantity' => 1312500,
                'scheduled_at' => '2019-10-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #8',
                'content' => 'BURRRR... I thought the future would be warmer!',
                'image_url' => '/images/harvests/winter.jpg',
                'quantity' => 1312500,
                'scheduled_at' => '2020-01-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #9',
                'content' => 'Ooph! Someone check the BITCORNSILO we\'re running low!',
                'image_url' => '/images/harvests/spring.jpg',
                'quantity' => 787500,
                'scheduled_at' => '2020-04-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #10',
                'content' => 'If this keeps up we\'re going to run out of corn by 2022!',
                'image_url' => '/images/harvests/summer.jpg',
                'quantity' => 787500,
                'scheduled_at' => '2020-07-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #11',
                'content' => 'FACT: Autumn corn tastes better with 11 herbs and spices.',
                'image_url' => '/images/harvests/fall.jpg',
                'quantity' => 787500,
                'scheduled_at' => '2020-10-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #12',
                'content' => 'Final halvening is now on the horizon. This is fine...',
                'image_url' => '/images/harvests/winter.jpg',
                'quantity' => 787500,
                'scheduled_at' => '2021-01-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #13',
                'content' => 'It\'s a good thing that my coop is alpha... #SQUADGOALS',
                'image_url' => '/images/harvests/spring.jpg',
                'quantity' => 525000,
                'scheduled_at' => '2021-04-10 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #14',
                'content' => 'Extreme heat and over-farming is taking its toll on CROPS...',
                'image_url' => '/images/harvests/summer.jpg',
                'quantity' => 525000,
                'scheduled_at' => '2021-07-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #15',
                'content' => 'Denial begins to set in about who will win #BRAGGING rights.',
                'image_url' => '/images/harvests/fall.jpg',
                'quantity' => 525000,
                'scheduled_at' => '2021-10-01 00:00:00',
            ],
            [
                'name' => 'Bitcorn Harvest #16',
                'content' => 'The roots of all BITCORN CROPS are tapped dry. Sad!',
                'image_url' => '/images/harvests/winter.jpg',
                'quantity' => 525000,
                'scheduled_at' => '2022-01-01 00:00:00',
            ]
        ];        
    }
}