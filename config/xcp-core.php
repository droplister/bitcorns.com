<?php

return [
    /**
     * Bitcoin Core API (Mainnet)
     */
    'bc' => [
        'api' => env('XCP_CORE_BC_API'),
        'user' => env('XCP_CORE_BC_USER'),
        'password' => env('XCP_CORE_BC_PASSWORD'),
    ],

    /**
     * Counterparty API (Mainnet)
     */
    'cp' => [
        'api' => env('XCP_CORE_CP_API', 'http://public.coindaddy.io:4000/api/'),
        'user' => env('XCP_CORE_CP_USER', 'rpc'),
        'password' => env('XCP_CORE_CP_PASSWORD', '1234'),
    ],


    /**
     * Counterblock API (Mainnet)
     */
    'cb' => [
        'api' => env('XCP_CORE_CB_API', 'http://public.coindaddy.io:4100/api/'),
        'user' => env('XCP_CORE_CB_USER', 'rpc'),
        'password' => env('XCP_CORE_CB_PASSWORD', '1234'),
    ],

    /**
     * First Block
     */
    'first_block' => env('XCP_CORE_ENV_NET', 'mainnet') === 'mainnet' ? 278270 : 310000,

    /**
     * Advanced (Blocks + TXs info)
     */
    'advanced' => env('XCP_CORE_ADVANCED', false),

    /**
     * Indexing (Production = true)
     */
    'indexing' => env('XCP_CORE_INDEXING', false),

    /**
     * Sync Size (Maximum = 250)
     */
    'sync_size' => env('XCP_CORE_SYNC_SIZE', 1),

    /**
     * Quote Assets
     */
    'quote_assets' => [
        'BTC',
        'XCP',
        'XBTC',
        'FLDC',
        'NVST',
        'SJCX',
        'VACUS',
        'BITCRYSTALS',
        'LTBCOIN',
        'SCOTCOIN',
        'PEPECASH',
        'BITCORN',
        'DATABITS',
        'MAFIACASH',
        'PENISIUM',
        'RUSTBITS',
        'WILLCOIN',
        'XFCCOIN',
    ],
];