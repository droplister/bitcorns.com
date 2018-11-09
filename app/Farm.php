<?php

namespace App;

use Cache;
use Storage;
use Exception;
use App\Coop;
use App\Token;
use App\Upload;
use App\Harvest;
use App\MapMarker;
use App\Traits\Linkable;
use App\Traits\Signable;
use App\Traits\Achievable;
use App\Traits\SortsFarms;
use App\Events\FarmWasCreated;
use Gstt\Achievements\Achiever;
use Droplister\XcpCore\App\Credit;
use Droplister\XcpCore\App\Address;
use Droplister\XcpCore\App\Balance;
use Droplister\XcpCore\App\Transaction;
use App\Http\Requests\Farms\UpdateRequest;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use Achievable, Achiever, Linkable, Signable, Sluggable, SluggableScopeHelpers, SortsFarms;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => FarmWasCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xcp_core_address',
        'xcp_core_credit_id',
        'coop_id',
        'name',
        'slug',
        'image_url',
        'content',
        'total_harvested',
        'access',
    ];

    /**
     * Display Content
     *
     * @var string
     */
    public function getDisplayContentAttribute()
    {
        $cause = array_random([
            'a fever',
            'dysentery',
            'measles',
            'cholera',
            'typhoid',
            'exhaustion',
            'a snakebite',
            'a broken leg',
            'a broken arm',
            'drowning'
        ]);

        $death = "Died of {$cause}...";

        return $this->accessBalance()->quantity > 0 ? $this->content : $death;
    }

    /**
     * Display Name
     *
     * @var string
     */
    public function getDisplayNameAttribute()
    {
        return $this->accessBalance()->quantity > 0 ? $this->name : 'NO CROPPER';
    }

    /**
     * Display Image URL
     *
     * @var string
     */
    public function getDisplayImageUrlAttribute()
    {
        return $this->accessBalance()->quantity > 0 ? asset($this->image_url) : asset('/images/default/0.jpg');
    }

    /**
     * Map Radius
     *
     * @var string
     */
    public function getMapRadiusAttribute()
    {
        // Zero is Zero
        if (! $this->access === 0) {
            return 0;
        }

        // 0.00003810 CROPS = 1 Arce
        $acres = $this->accessBalance()->quantity_normalized / 0.00003810;

        // Area Formula (using meters squared)
        $area = $meters_squared = $acres * 4046.85642;

        // Radius Formula
        $radius = sqrt($area / pi());

        // 10x Multiplier
        return $radius * 10;
    }

    /**
     * Map Type
     *
     * @var string
     */
    public function getMapTypeAttribute()
    {
        return $this->hasBalance('HAYABUSATWO') ? 'satellite' : 'terrain';
    }

    /**
     * Progress
     *
     * @var string
     */
    public function getProgressAttribute()
    {
        // Tokens: Upgrades Owned
        $upgrades_owned = $this->upgradeBalances()->count();

        // Tokens: Upgrades Total
        $upgrades_total = Cache::remember('upgrades_total', 60, function () {
            return Token::published()->upgrades()->count();
        });

        // Tokens: % of Progress
        return round($upgrades_owned / $upgrades_total * 100);
    }

    /**
     * Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'xcp_core_address', 'address');
    }

    /**
     * Asset Balances
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assetBalances()
    {
        return $this->hasMany(Balance::class, 'address', 'xcp_core_address');
    }

    /**
     * Balances
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances()
    {
        return $this->hasMany(TokenBalance::class, 'address', 'xcp_core_address');
    }

    /**
     * Token Balances
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokenBalances()
    {
        return $this->hasMany(TokenBalance::class, 'address', 'xcp_core_address')->published()->tokens();
    }

    /**
     * Upgrade Balances
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function upgradeBalances()
    {
        return $this->hasMany(TokenBalance::class, 'address', 'xcp_core_address')->published()->upgrades()->nonZero();
    }

    /**
     * Coop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coop()
    {
        return $this->belongsTo(Coop::class, 'coop_id', 'id');
    }

    /**
     * First CROPS (Credit Event)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firstCrops()
    {
        return $this->belongsTo(Credit::class, 'xcp_core_credit_id', 'id');
    }

    /**
     * Features
     */
    public function features()
    {
        return $this->morphMany(Feature::class, 'featurable');
    }

    /**
     * Harvests
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function harvests()
    {
        return $this->belongsToMany(Harvest::class, 'farm_harvest', 'farm_id', 'harvest_id')->withPivot('coop_id', 'quantity', 'multiplier');
    }

    /**
     * Map Markers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mapMarkers()
    {
        return $this->hasMany(MapMarker::class);
    }

    /**
     * Map Marker
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mapMarker()
    {
        return $this->hasOne(MapMarker::class)->major();
    }

    /**
     * Transactions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'source', 'xcp_core_address');
    }

    /**
     * Uploads
     */
    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }

    /**
     * Has Access
     */
    public function scopeHasAccess($query)
    {
        return $query->where('access', '=', 1);
    }

    /**
     * Has Access
     */
    public function scopeDoesntHaveAccess($query)
    {
        return $query->where('access', '=', 0);
    }

    /**
     * Access Balance
     *
     * @return \App\Balance
     */
    public function accessBalance()
    {
        return $this->getBalance(config('bitcorn.access_token'));
    }

    /**
     * Reward Balance
     *
     * @return \App\Balance
     */
    public function rewardBalance()
    {
        return $this->getBalance(config('bitcorn.reward_token'));
    }

    /**
     * Get Balance
     *
     * @return \App\Balance
     */
    public function getBalance($asset_name)
    {
        return $this->balances()
            ->where('asset', '=', $asset_name)
            ->first();
    }

    /**
     * Has Balance
     *
     * @return \App\TokenBalance
     */
    public function hasBalance($asset_name)
    {
        return $this->balances()
            ->where('asset', '=', $asset_name)
            ->where('quantity', '>', 0)
            ->exists();
    }

    /**
     * Has Asset Balance
     *
     * @return \App\Balance
     */
    public function hasAssetBalance($asset_name)
    {
        return $this->assetBalances()
            ->where('asset', '=', $asset_name)
            ->where('quantity', '>', 0)
            ->exists();
    }

    /**
     * Locked Achievements
     *
     * @return \Gstt\Achievements\Model\AchievementProgress
     */
    public function lockedAchievements()
    {
        return $this->achievements()->with('details')
            ->whereNull('unlocked_at')
            ->oldest('unlocked_at')
            ->get()
            ->sortByDesc(function ($achievement) {
                return $achievement->points / $achievement->details->points;
            });
    }

    /**
     * Unlocked Achievements
     *
     * @return \Gstt\Achievements\Model\AchievementProgress
     */
    public function unlockedAchievements()
    {
        return $this->achievements()->with('details')
            ->whereNotNull('unlocked_at')
            ->oldest('unlocked_at')
            ->get();
    }

    /**
     * Harvest Coop
     *
     * @param \App\Harvest  $harvest
     * @return boolean
     */
    public function harvestCoop(Harvest $harvest)
    {
        $result = $this->harvests()->where('harvest_id', '=', $harvest->id)->first();

        return Coop::find($result->pivot->coop_id);
    }

    /**
     * Coop Total
     *
     * @param \App\Coop  $coop
     * @param boolean  $multiply
     * @var string
     */
    public function coopTotal($coop, $multiply = false)
    {
        return $this->harvests()->where('coop_id', '=', $coop->id)->get()->sum(function ($coop) use ($multiply) {
            if ($multiply) {
                return $coop->pivot->quantity * $coop->pivot->multiplier;
            }

            return $coop->pivot->quantity;
        });
    }

    /**
     * Get Battle Stat
     *
     * @param string  $key
     * @return array
     */
    public function getBattleStat($key)
    {
        try {
            $data = Cache::remember('battle_stats_' . $this->xcp_core_address, 60, function () {
                $data = file_get_contents('http://bitcornbattle.com/api/winloss.php?a=' . $this->xcp_core_address);
                return json_decode($data, true);
            });

            return isset($data[$key]) ? (int) $data[$key] : 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Is DAAB
     *
     * @return boolean
     */
    public function isDAAB()
    {
        // DAAB Token
        $token = Token::where('xcp_core_asset_name', '=', config('bitcorn.daab_token'))->first();

        // Balances (hi -> lo)
        $token_balances = $token->balances()->has('farm')->with('farm')->orderBy('quantity', 'desc')->get();

        // Check Whether DAAB
        foreach ($token_balances as $token_balance) {
            // Forever Moist!
            if ($token_balance->farm->hasBalance(config('bitcorn.daab_save_token'))) {
                continue;
            }

            // Dry as a Bone!
            return $token_balance->farm->id === $this->id;
        }

        // Nope
        return false;
    }

    /**
     * Update Farm
     *
     * @param  \App\Http\Requests\Farms\UpdateRequest  $request
     */
    public function updateFarm(UpdateRequest $request)
    {
        // Farm Image
        if ($request->has('image')) {
            // Save Image
            $this->storeImage($request->image);
        }

        /// Update Farm
        return $this->update($request->only(['name', 'content']));
    }

    /**
     * Store Image
     *
     * @param  string  $file
     * @return string
     */
    public function storeImage($file)
    {
        // Put File
        $image_path = Storage::putFile('public/farms', $file);

        // Relative
        $image_url = Storage::url($image_path);

        // New Upload
        $upload = new Upload([
            'new_image_url' => $image_url,
            'old_image_url' => $this->image_url,
        ]);

        // Save Upload
        $this->uploads()->save($upload);

        // Save Image
        $this->update(['image_url' => $image_url]);
    }

    /**
     * Update Map Marker
     *
     * @param  string  $latitude
     * @param  string $longitude
     * @return mixed
     */
    public function updateMapMarker($latitude, $longitude)
    {
        if (! $latitude || ! $longitude) {
            return false;
        }

        // Update
        if ($this->mapMarker) {
            $this->mapMarker->update([
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        } // Create
        else {
            MapMarker::create([
                'farm_id' => $this->id,
                'latitude' => $latitude,
                'longitude' => $longitude,
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

        Cache::forget('world_map');
    }

    /**
     * Field of Dreams
     */
    public static function getFieldOfDreams()
    {
        return static::findBySlug(config('bitcorn.field_of_dreams'));
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'xcp_core_address',
                'method' => function ($string, $separator) {
                    return $string;
                }
            ]
        ];
    }
}
