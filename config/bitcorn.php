<?php

return [

    /**
     * Access Token
     */
    'access_token' => env('BITCORN_ACCESS_TOKEN', 'CROPS'),

    /**
     * Reward Token
     */
    'reward_token' => env('BITCORN_REWARD_TOKEN', 'BITCORN'),

    /**
     * DAAB Token
     */
    'daab_token' => env('BITCORN_DAAB_TOKEN', 'DRYASABONE'),

    /**
     * DAAB Save Token
     */
    'daab_save_token' => env('BITCORN_DAAB_SAVE_TOKEN', 'FOREVERMOIST'),

    /**
     * Genesis Address
     */
    'genesis_address' => env('BITCORN_GENESIS_ADDRESS', '19QWXpMXeLkoEKEJv2xo9rn8wkPCyxACSX'),

    /**
     * Museum Address
     */
    'museum_address' => env('BITCORN_MUSEUM_ADDRESS', '1BitcornCropsMuseumAddressy149ZDr'),

    /**
     * Submmission Fee Address
     */
    'subfee_address' => env('BITCORN_SUBFEE_ADDRESS', '1BitcornSubmissionFeeAddressgL5Xg'),

    /**
     * Submmission Fee
     */
    'subfee' => env('BITCORN_SUBFEE', 500),

    /**
     * Contact Email
     */
    'email' => env('BITCORN_EMAIL', 'bitcorncrops@gmail.com'),

    /**
     * Counterwallet
     */
    'counterwallet' => env('BITCORN_COUNTERWALLET', 'https://xcpkey.com/'),

    /**
     * Telegram Chat
     */
    'telegram' => env('BITCORN_TELEGRAM', 'https://t.me/bitcorns'),

    /**
     * Twitter Account
     */
    'twitter' => env('BITCORN_TWITTER', 'https://twitter.com/bitcorncrops'),

    /**
     * Wufoo.com Form
     */
    'wufoo' => env('BITCORN_WUFOO', 'https://bitcorns.wufoo.com/forms/crops-order-form/'),

    /**
     * Counterparty Dex
     */
    'xcpdex' => env('BITCORN_XCPDEX', 'https://xcpdex.com/market/CROPS_XCP'),
];
