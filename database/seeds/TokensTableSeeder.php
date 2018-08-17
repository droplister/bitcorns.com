<?php

use App\Token;
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
        $tokens = [
            [
                'name' => 'CROPS',
                'xcp_core_asset_name' => 'CROPS',
                'type' => 'access',
                'image_url' => '/images/tokens/CROPS.png',
                'content' => 'Crops (CROPS:XCP) are arable block spaces suitable for growing Bitcorn on the blockchain. Addresses owning CROPS become bitcorn farms and can harvest Bitcorn, seasonally, until the Winter of 2022. There will only every be 100 CROPS.',
            ]
        ];

        foreach($tokens as $token)
        {
            Token::create([
                'name' => $token['name'],
                'xcp_core_asset_name' => $token['xcp_core_asset_name'],
                'type' => $token['type'],
                'image_url' => $token['image_url'],
                'content' => $token['content'],
            ]);
        }
    }
}
