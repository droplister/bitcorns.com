<?php

use App\Token;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TokensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tokens = $this->getTokens();

        foreach ($tokens as $token) {
            $token['approved_at'] = Carbon::now();
            $token['published_at'] = Carbon::now();

            Token::create($token);
        }
    }

    /**
     * Get Tokens
     *
     * @return array
     */
    private function getTokens()
    {
        return [
            [
                'type' => 'access',
                'name' => 'CROPS',
                'xcp_core_asset_name' => 'CROPS',
                'image_url' => '/images/tokens/CROPS.png',
                'content' => 'Crops (CROPS:XCP) are arable block spaces suitable for growing Bitcorn on the blockchain. Addresses owning CROPS become bitcorn farms and can harvest Bitcorn, seasonally, until the Winter of 2022. There will only every be 100 CROPS.',
            ],[
                'type' => 'reward',
                'name' => 'BITCORN',
                'xcp_core_asset_name' => 'BITCORN',
                'image_url' => '/images/tokens/BITCORN.png',
                'content' => 'Bitcorn (BITCORN:XCP) is a kind of cryptographically modified organism (CMO) that is harvested four times per year by farms sowing Bitcorn Crops. Resistant to bugs and censorship of all types, there will only ever be 21,000,000 BITCORN.',
            ],[
                'type' => 'trophy',
                'name' => 'BRAGGING',
                'xcp_core_asset_name' => 'BRAGGING',
                'image_url' => '/images/tokens/BRAGGING.png',
                'content' => 'Bragging (BRAGGING:XCP) is a trophy token that will be awarded in the Year 2022 to the Bitcorns.com farm that harvests the most Bitcorn in total. Literal cryptographic bragging rights are on the line here, so bring your "A" game!',
            ],[
                'type' => 'trophy',
                'name' => 'SQUADGOALS',
                'xcp_core_asset_name' => 'SQUADGOALS',
                'image_url' => '/images/tokens/SQUADGOALS.png',
                'content' => 'Squad Goals (SQUADGOALS:XCP) is the trophy token that will be awarded in the Year 2022 to the Bitcorns.com coop that harvests the most Bitcorn in total. Ownership will go to the coop\'s creator and one token will go to each member farm.',
            ]
        ];
    }
}
