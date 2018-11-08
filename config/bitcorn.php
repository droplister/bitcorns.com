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
     * Feature TX Index
     */
    'feature_tx_index' => env('BITCORN_FEATURE_TX_INDEX', 0),

    /**
     * ICO Block Index
     */
    'ico_block_index' => env('BITCORN_ICO_BLOCK_INDEX', 507151),

    /**
     * Public Chat ID
     */
    'public_chat_id' => env('PUBLIC_CHAT_ID'),

    /**
     * Private Chat ID
     */
    'private_chat_id' => env('PRIVATE_CHAT_ID'),

    /**
     * Bitcorn Message
     */
    'message' => env('BITCORN_MESSAGE', 'I authorize this change.'),

    /**
     * Feature Address
     */
    'feature_address' => env('BITCORN_FEATURE_ADDRESS', '1HomeYDQs6uNahNdT4SYDa1zQeQN4k8iYK'),

    /**
     * Field of Dreams
     */
    'field_of_dreams' => env('BITCORN_WHEELER_ADDRESS', '1KacrYMuQW5eqLbrYUotQ1mdsVpxin6hC9'),

    /**
     * Genesis Address
     */
    'genesis_address' => env('BITCORN_GENESIS_ADDRESS', '19QWXpMXeLkoEKEJv2xo9rn8wkPCyxACSX'),

    /**
     * Museum Address
     */
    'museum_address' => env('BITCORN_MUSEUM_ADDRESS', '1BitcornCropsMuseumAddressy149ZDr'),

    /**
     * Voting Address
     */
    'voting_address' => env('BITCORN_VOTING_ADDRESS', '1VoteMg3ENEknHm6WyJMcXMaFdQqz9GvQ'),

    /**
     * Store Address
     */
    'store_address' => env('BITCORN_STORE_ADDRESS', '1MerchXqHzpYfnWFz1s174KvyWNBcHMU7Z'),

    /**
     * Submmission Fee Address
     */
    'subfee_address' => env('BITCORN_SUBFEE_ADDRESS', '1BitcornSubmissionFeeAddressgL5Xg'),

    /**
     * Submmission Fee
     */
    'subfee' => env('BITCORN_SUBFEE', 1000),

    /**
     * Min Update
     */
    'min_update' => env('BITCORN_MIN_ACCESS_UPDATE', 3810),
    
    /**
     * Min Upload
     */
    'min_upload' => env('BITCORN_MIN_ACCESS_UPLOAD', 1000000),

    /**
     * Min Coop
     */
    'min_coop' => env('BITCORN_MIN_ACCESS_COOP', 10000000),

    /**
     * Min Cornfetti
     */
    'min_cornfetti' => env('BITCORN_MIN_CORNFETTI', 800),

    /**
     * Contact Email
     */
    'email' => env('BITCORN_EMAIL', 'bitcorncrops@gmail.com'),
    
    /**
     * Google Analytics
     */
    'analytics' => env('BITCORN_ANALYTICS', 'UA-112477384-4'),

    /**
     * Analytics URL
     */
    'analytics_url' => env('BITCORN_ANALYTICS_URL', 'https://datastudio.google.com/open/1XkRIJSWmgWB1kUd9SUY0wGT4Xa2ZtghB'),

    /**
     * Bitcorn Battle
     */
    'battle' => env('BITCORN_BATTLE', 'http://bitcornbattle.com'),

    /**
     * Bitcorn Battle (About)
     */
    'bitcornbattle' => env('BITCORN_BITCORNBATTLE', 'http://bitcornbattle.com/howtobattle'),

    /**
     * Counterwallet
     */
    'counterwallet' => env('BITCORN_COUNTERWALLET', 'https://xcpkey.com'),

    /**
     * Bitcorn Foundation
     */
    'foundation' => env('BITCORN_FOUNDATION', 'https://bitcorn.org'),

    /**
     * GitHub
     */
    'github' => env('BITCORN_GITHUB', 'https://github.com/droplister/bitcorns.com'),

    /**
     * Bitcorn Glasses
     */
    'glasses' => env('BITCORN_GLASSES', 'https://shop.bitcorns.com/products/bitcorn-glasses'),

    /**
     * Bitcorn Harvest
     */
    'harvest' => env('BITCORN_HARVEST', 'https://bitcornharvest.com'),

    /**
     * Medium
     */
    'medium' => env('BITCORN_MEDIUM', 'https://medium.com/@BitcornCrops'),

    /**
     * Bitcorn Museum
     */
    'museum' => env('BITCORN_MUSEUM', 'https://bitcornmuseum.org'),

    /**
     * Bitcorn Podcast
     */
    'podcast' => env('BITCORN_PODCAST', 'https://soundcloud.com/user-224956270'),

    /**
     * Bitcorn Store
     */
    'store' => env('BITCORN_STORE', 'https://shop.bitcorns.com'),

    /**
     * Telegram Chat
     */
    'telegram' => env('BITCORN_TELEGRAM', 'https://t.me/bitcorns'),

    /**
     * Twitter Account
     */
    'twitter' => env('BITCORN_TWITTER', 'https://twitter.com/bitcorncrops'),

    /**
     * GitHub Wiki
     */
    'wiki' => env('BITCORN_WIKI', 'https://github.com/droplister/bitcorns.com/wiki'),

    /**
     * Wufoo.com Form
     */
    'wufoo' => env('BITCORN_WUFOO', 'https://bitcorns.wufoo.com/forms/crops-order-form/'),

    /**
     * Counterparty Dex
     */
    'xcpdex' => env('BITCORN_XCPDEX', 'https://xcpdex.com/market/CROPS_XCP'),

    /**
     * Approval Route
     */
    'approval_route' => env('BITCORN_APPROVAL_ROUTE'),

    /**
     * Queue Route
     */
    'queue_route' => env('BITCORN_QUEUE_ROUTE'),
];
