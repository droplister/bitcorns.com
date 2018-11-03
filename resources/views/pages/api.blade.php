@extends('layouts.app')

@section('title', 'Developer API')

@section('content')
<div class="container">
    <h1 class="display-4 my-5">
        API Docs
    </h1>
    <p class="lead">
        Welcome to the Bitcorns API (v1). For support or to report errors, please email: <a href="mailto:{{ config('bitcorn.email') }}">{{ config('bitcorn.email') }}</a>. It's important to note that the data provided by these endpoints are specific to the Bitcorn Crops game and may show less data than the Counterparty API.
    </p>
    <p class="lead mb-5">
        NPM Package: <a href="https://www.npmjs.com/package/bitcorns-api" target="_blank">https://www.npmjs.com/package/bitcorns-api</a>
    </p>
    <div class="card mb-4">
        <div class="card-body">
            <h3>List Farms</h3>
            <p><span class="badge badge-primary">GET</span> /api/farms</p>
            <p>Lists all of the farms ever made and whether or not they have access.</p>
            <p><em><strong>Note:</strong> A farm without CROPS is considered a "no cropper".</em></p>
        </div>
        <div class="card-footer">
<pre>
// https://bitcorns.com/api/farms

[
  {
    "name": "Genesis Farm",
    "address": "19QWXpMXeLkoEKEJv2xo9rn8wkPCyxACSX",
    "description": "In the beginning, Satoshi created the blockchain and the earth...",
    "link": "https://bitcorns.com/farms/19QWXpMXeLkoEKEJv2xo9rn8wkPCyxACSX",
    "farm": "https://bitcorns.com/images/original/DF2w36OvfnWw8y1sZ9HmTHlRZJtVr0UHDxskg9YU.jpeg",
    "access": true
  },
  {
    "name": "NO CROPPER",
    "address": "1PGYYY2EYBQrP6NLr2pP2Fs2DET5uTJemE",
    "description": "This address has no CROPS and is therefore not playing.",
    "link": "https://bitcorns.com/farms/1PGYYY2EYBQrP6NLr2pP2Fs2DET5uTJemE",
    "farm": "https://bitcorns.com/img/farms/0.jpg",
    "access": false
  }
]
</pre>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h3>Show Farm</h3>
            <p><span class="badge badge-primary">GET</span> /api/farms/{farm}</p>
            <p>Show different kinds of data about the given farm.</p>
            <p><em><strong>Note:</strong> This route is subject to frequent change.</em></p>
        </div>
        <div class="card-footer">
<pre>
// https://bitcorns.com/api/farms/1BTqJzuYn8SvmbgXrJr4g8QP7hypBDeYsN

{
  "name": "The Slaughterhouse",
  "address": "1BTqJzuYn8SvmbgXrJr4g8QP7hypBDeYsN",
  "description": "The only thing worse than being rekt, is being taken to the slaughterhouse.",
  "link": "https://bitcorns.com/farms/1BTqJzuYn8SvmbgXrJr4g8QP7hypBDeYsN",
  "farm": "https://bitcorns.com/images/original/P9MOabaYAMCEOjeKXdEq8NoW2jKd5ecQ3N9NODvj.jpeg",
  "access": true,
  "coop": {
    "name": "Panic At The Disco",
    "slug": "panic-at-the-disco",
    "link": "https://bitcorns.com/coops/panic-at-the-disco"
  },
  "tokens": [
    {
      "name": "CROPS",
      "balance": 11
    },
    {
      "name": "BITCORN",
      "balance": 109000
    }
  ],
  "cards": [
    {
      "name": "HELIPAD",
      "balance": 2
    },
    {
      "name": "YACHTDOCK",
      "balance": 2
    }
  ],
  "harvests": [
    {
      "date": "2018-04-01",
      "total": 293763,
      "tx_id": 1221452
    }
  ],
  "position": {
    "lat": 20.68296,
    "lng": -88.567868
  }
}
</pre>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h3>List Coops</h3>
            <p><span class="badge badge-primary">GET</span> /api/coops</p>
            <p>Lists all of the coops and the links to them on Bitcorns.com.</p>
            <p><em><strong>Note:</strong> It's possible a coop lists here may have no members.</em></p>
        </div>
        <div class="card-footer">
<pre>
// https://bitcorns.com/api/coops

[
  {
    "name": "CORN TANG CLAN",
    "slug": "corn-tang-clan",
    "link": "https://bitcorns.com/coops/corn-tang-clan",
    "description": "Welcome to the Clan! We study ancient Shaolin farming principles, play loud music for our killer bees, & beneath the surface we host honey badger cage fights. #weacceptcrops."
  },
  {
    "name": "Panic At The Disco",
    "slug": "panic-at-the-disco",
    "link": "https://bitcorns.com/coops/panic-at-the-disco",
    "description": "Organic AF"
  }
]
</pre>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h3>Show Coop</h3>
            <p><span class="badge badge-primary">GET</span> /api/coops/{coop}</p>
            <p>Show the resources and members of a given farming cooperative.</p>
            <p><em><strong>Note:</strong> This route is subject to frequent change.</em></p>
        </div>
        <div class="card-footer">
<pre>
// https://bitcorns.com/api/coops/c-gulag

{
  "name": "C-GULAG",
  "slug": "c-gulag",
  "link": "https://bitcorns.com/coops/c-gulag",
  "description": "Corn-GUild and Labour Administration Group",
  "crops": 0.002,
  "bitcorn": 52,
  "bitcorn_harvested": 3958,
  "member_count": 1,
  "members": [
    {
      "name": "North Locker",
      "address": "1JP8iewjQ4zP9gubAWEgFurTLbT5Q1xwJs",
      "link": "https://bitcorns.com/farms/1JP8iewjQ4zP9gubAWEgFurTLbT5Q1xwJs",
      "farm": "https://bitcorns.com/img/farms/7.jpg",
      "access": true
    }
  ]
}
</pre>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h3>List Cards</h3>
            <p><span class="badge badge-primary">GET</span> /api/cards</p>
            <p>Lists all of the approved and published Bitcorn cards with their images and issuance data.</p>
            <p><em><strong>Note:</strong> All of the cards returned on this list are non-divisible and locked.</em></p>
        </div>
        <div class="card-footer">
<pre>
// https://bitcorns.com/api/cards

[
  {
    "name": "HELIPAD",
    "link": "https://bitcorns.com/tokens/HELIPAD",
    "card": "https://bitcorns.com/img/cards/HELIPAD.png",
    "issued": 31,
    "burned": 1,
    "supply": 30,
    "harvest": 1,
    "harvest_ranking": 1,
    "overall_ranking": 1
  },
  {
    "name": "YACHTDOCK",
    "link": "https://bitcorns.com/tokens/YACHTDOCK",
    "card": "https://bitcorns.com/img/cards/YACHTDOCK.png",
    "issued": 31,
    "burned": 1,
    "supply": 30,
    "harvest": 1,
    "harvest_ranking": 2,
    "overall_ranking": 2
  }
]
</pre>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h3>Show Card</h3>
            <p><span class="badge badge-primary">GET</span> /api/cards/{card}</p>
            <p>Show data specific to a given card, especially the farms owning that card.</p>
            <p><em><strong>Note:</strong> The "holders" are those addresses that own/have owned CROPS.</em></p>
        </div>
        <div class="card-footer">
<pre>
// https://bitcorns.com/api/cards/LAMBOGARAGE.COSBY

{
  "name": "LAMBOGARAGE.COSBY",
  "link": "https://bitcorns.com/tokens/A11876617019837304885",
  "card": "https://bitcorns.com/img/cards/LAMBOGARAGE.COSBY.png",
  "issued": 2,
  "burned": 1,
  "supply": 1,
  "holder_count": 2,
  "holders": [
    {
      "address": "1BitcornCropsMuseumAddressy149ZDr",
      "balance": 1
    },
    {
      "address": "1E7jTopwbtXVpJQsiV92ksU6u49aZSREuY",
      "balance": 1
    }
  ]
}
</pre>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h3>List Tokens</h3>
            <p><span class="badge badge-primary">GET</span> /api/tokens</p>
            <p>Lists all tokens used in the Bitcorn Crops game and their basic issuance data.</p>
            <p><em><strong>Note:</strong> BITCORN supply here excludes unharvested and burned bitcorn.</em></p>
        </div>
        <div class="card-footer">
<pre>
// https://bitcorns.com/api/tokens

[
  {
    "name": "CROPS",
    "type": "access",
    "issued": 100,
    "burned": 0.0000381,
    "supply": 99.9999619,
    "divisible": 1,
    "locked": 1
  },
  {
    "name": "BITCORN",
    "type": "reward",
    "issued": 21000000,
    "burned": 2032,
    "supply": 2622968,
    "divisible": 0,
    "locked": 1
  }
]
</pre>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h3>Show Token</h3>
            <p><span class="badge badge-primary">GET</span> /api/tokens/{token}.json</p>
            <p>Show enhanced asset description for the given token in Counterparty protcol format.</p>
            <p><em><strong>Note:</strong> Can be used by any in-game upgrade creator in their asset description.</em></p>
        </div>
        <div class="card-footer">
<pre>
// https://bitcorns.com/api/tokens/CROPS.json

{
  "image": "https://bitcorns.com/img/tokens/images/CROPS.png",
  "asset": "CROPS",
  "description": "Crops (CROPS:XCP) are arable block spaces suitable for growing Bitcorn on the blockchain. Addresses owning CROPS become bitcorn farms and can harvest Bitcorn, seasonally, until the Winter of 2022. There will only every be 100 CROPS.",
  "website": "https://bitcorns.com",
  "pgpsig": ""
}
</pre>
        </div>
    </div>
</div>

@endsection