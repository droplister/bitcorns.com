<?php

namespace App;

use Cache;
use Storage;
use Exception;
use App\Coop;
use Carbon\Carbon;
use App\Traits\Linkable;
use App\Traits\Touchable;
use App\Traits\Achievable;
use App\Events\TokenWasCreated;
use Gstt\Achievements\Achiever;
use Droplister\XcpCore\App\Burn;
use Droplister\XcpCore\App\Send;
use Droplister\XcpCore\App\Asset;
use Droplister\XcpCore\App\Dispense;
use Droplister\XcpCore\App\OrderMatch;
use App\Http\Requests\Cards\StoreRequest;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use Achievable, Achiever, Linkable, Sluggable, SluggableScopeHelpers, Touchable;

    /**
     * Enforce Type Limit
     */
    public static function boot()
    {
        static::creating(function (Token $token) {
            if (in_array($token->type, ['access', 'reward']) && static::whereType($token->type)->exists()) {
                throw new Exception('Token Limit Exceeded');
            }
        });
        parent::boot();
    }

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TokenWasCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xcp_core_asset_name',
        'xcp_core_burn_tx_hash',
        'harvest_id',
        'type',
        'name',
        'slug',
        'image_url',
        'content',
        'meta_data',
        'meta_data->orientation',
        'meta_data->hd_image_url',
        'meta_data->harvest_ranking',
        'meta_data->overall_ranking',
        'museumed_at',
        'approved_at',
        'rejected_at',
        'published_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta_data' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'museumed_at',
        'approved_at',
        'rejected_at',
        'published_at',
    ];

    /**
     * Set Content
     *
     * @param  string  $value
     * @return void
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strip_tags($value);
    }

    /**
     * Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'xcp_core_asset_name', 'asset_name');
    }

    /**
     * Balances
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances()
    {
        return $this->hasMany(TokenBalance::class, 'asset', 'xcp_core_asset_name')->nonZero();
    }

    /**
     * Balances (Including Zero)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allBalances()
    {
        return $this->hasMany(TokenBalance::class, 'asset', 'xcp_core_asset_name');
    }

    /**
     * Farm Balances
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function farmBalances()
    {
        return $this->hasMany(TokenBalance::class, 'asset', 'xcp_core_asset_name')->nonZero()->has('farm')->with('farm.coop')->orderBy('quantity', 'desc');
    }

    /**
     * Burn
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function burn()
    {
        return $this->belongsTo(Burn::class, 'xcp_core_burn_tx_hash', 'tx_hash');
    }

    /**
     * Farms
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function farms()
    {
        return $this->hasManyThrough(Farm::class, TokenBalance::class, 'asset', 'xcp_core_address', 'xcp_core_asset_name', 'address');
    }

    /**
     * Features
     */
    public function features()
    {
        return $this->morphMany(Feature::class, 'featurable');
    }

    /**
     * Sends
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sends()
    {
        return $this->hasMany(Send::class, 'asset', 'xcp_core_asset_name');
    }

    /**
     * Tokens
     */
    public function scopeTokens($query)
    {
        return $query->where('type', '!=', 'upgrade');
    }

    /**
     * Upgrades
     */
    public function scopeUpgrades($query)
    {
        return $query->where('type', '=', 'upgrade');
    }

    /**
     * Not Divisible
     */
    public function scopeNotDivisible($query)
    {
        return $query->whereHas('asset', function ($asset) {
            return $asset->where('divisible', '=', 0);
        });
    }

    /**
     * Locked
     */
    public function scopeLocked($query)
    {
        return $query->whereHas('asset', function ($asset) {
            return $asset->where('locked', '=', 1);
        });
    }

    /**
     * Paid For
     */
    public function scopePaidFor($query)
    {
        return $query->whereNotNull('xcp_core_burn_tx_hash');
    }

    /**
     * Museumed
     */
    public function scopeMuseumed($query)
    {
        return $query->whereNotNull('museumed_at');
    }

    /**
     * Approved
     */
    public function scopeApproved($query)
    {
        return $query->whereNotNull('approved_at')->whereNull('rejected_at');
    }

    /**
     * Rejected
     */
    public function scopeRejected($query)
    {
        return $query->whereNotNull('rejected_at');
    }

    /**
     * Pending
     */
    public function scopePending($query)
    {
        return $query->whereNull('published_at')->whereNull('rejected_at');
    }

    /**
     * Publishable
     */
    public function scopePublishable($query)
    {
        return $query->notDivisible()->locked()->paidFor()->museumed()->pending();
    }

    /**
     * Published
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    /**
     * Not Published
     */
    public function scopeNotPublished($query)
    {
        return $query->whereNull('published_at');
    }

    /**
     * Top Coop
     *
     * @return \App\Coop
     */
    public function topCoop()
    {
        return Cache::remember('token_top_coop_' . $this->slug, 60, function () {
            // Coops
            $unsorted = Coop::get();

            // Sorted
            return $unsorted->sortByDesc(function ($coop) {
                return $coop->getBalance($this->xcp_core_asset_name);
            })->first();
        });
    }

    /**
     * Top Farm
     *
     * @return \App\Farm
     */
    public function topFarm()
    {
        return Cache::remember('token_top_farm_' . $this->slug, 60, function () {
            // Top Farm
            return $this->farmBalances()->first() ? $this->farmBalances()->first()->farm : null;
        });
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
     * Create Card
     *
     * @param  \App\Http\Requests\Cards\StoreRequest  $request
     * @return \App\Token
     */
    public static function createCard(StoreRequest $request)
    {
        $card = static::create([
            'xcp_core_asset_name' => $request->name,
            'xcp_core_burn_tx_hash' => $request->burn,
            'type' => 'upgrade',
            'name' => $request->name,
            'content' => $request->content,
        ]);

        // Save Image
        $card->storeImage($request->image);

        // HD Optional
        if ($request->has('hd_image')) {
            // Save Image
            $card->storeImage($request->hd_image, true);
        }
    }

    /**
     * Store Image
     *
     * @param  string  $file
     * @param  boolean  $hd
     * @return string
     */
    public function storeImage($file, $hd = false)
    {
        // Get Key
        $key = $hd ? 'meta_data->hd_image_url' : 'image_url';

        // Put File
        $image_path = Storage::putFile('public/tokens', $file);

        // Relative
        $image_url = Storage::url($image_path);

        // Absolute
        $image_url = url($image_url);

        // Save IMG
        $this->update([$key => $image_url]);
    }

    /**
     * Last Match
     *
     * @return \Droplister\XcpCore\App\OrderMatch
     */
    public function lastMatch($quote_asset = null)
    {
        if ($quote_asset) {
            return OrderMatch::where('backward_asset', '=', $this->xcp_core_asset_name)
                ->where('forward_asset', '=', $quote_asset)
                ->where('status', '=', 'completed')
                ->orWhere('backward_asset', '=', $quote_asset)
                ->where('forward_asset', '=', $this->xcp_core_asset_name)
                ->where('status', '=', 'completed')
                ->orderBy('tx1_index', 'desc')
                ->first();
        }
        
        return OrderMatch::where('backward_asset', '=', $this->xcp_core_asset_name)
            ->where('status', '=', 'completed')
            ->orWhere('forward_asset', '=', $this->xcp_core_asset_name)
            ->where('status', '=', 'completed')
            ->orderBy('tx1_index', 'desc')
            ->first();
    }

    /**
     * Last Dispense
     *
     * @return \Droplister\XcpCore\App\Dispense
     */
    public function lastDispense()
    {
        return Dispense::where('asset', '=', $this->xcp_core_asset_name)
            ->orderBy('tx_index', 'desc')
            ->first();
    }

    /**
     * Last Price
     *
     * @return string
     */
    public static function lastPrice()
    {
        return Cache::remember('last_price', 60, function () {
            $crops = static::where('xcp_core_asset_name', '=', config('bitcorn.access_token'))->first();
            return $crops->lastMatch('XCP') ? number_format($crops->lastMatch('XCP')->trading_price_normalized) . ' XCP' : '0 XCP';
        });
    }

    /**
     * Get Filtered Cards
     *
     * @param  mixed  $filter
     * @return mixed
     */
    public static function getFilteredCards($filter)
    {
        // Cards to Filter
        $cards = Token::published()->upgrades();

        // Harvest
        if ($filter && is_int((int) $filter) && (int) $filter !== 0) {
            $cards = $cards->where('harvest_id', '=', $filter);
        } // HD
        elseif($filter && $filter === 'HD') {
            $cards = $cards->whereNotNull('meta_data->hd_image_url');
        }
        // Format
        elseif ($filter && is_string($filter)) {
            $cards = $cards->where('image_url', 'like', '%'. $filter);
        }

        return $cards->orderByRaw('CAST(meta_data->"$.overall_ranking" AS UNSIGNED)', 'asc');
    }

    /**
     * Get Average Card Price
     *
     * @return string
     */
    public static function getAverageCardPrice()
    {
        return Cache::remember('dex_average', 1440, function () {
            // Cards
            $card_assets = static::published()->upgrades()->pluck('xcp_core_asset_name')->toArray();

            // Buys
            $buys = OrderMatch::whereIn('forward_asset', $card_assets)
                ->where('backward_asset', '=', config('bitcorn.reward_token'))
                ->where('confirmed_at', '>=', Carbon::now()->subDays(30));
            $average_buy = $buys->sum('forward_quantity') === 0 ? 0 : $buys->sum('backward_quantity') / $buys->sum('forward_quantity');

            // Sells
            $sells = OrderMatch::whereIn('backward_asset', $card_assets)
                ->where('forward_asset', '=', config('bitcorn.reward_token'))
                ->where('confirmed_at', '>=', Carbon::now()->subDays(30));
            $average_sell = $sells->sum('backward_asset') === 0 ? 0 : $sells->sum('forward_asset') / $sells->sum('backward_asset');

            // DEX Average
            return number_format(($average_buy + $average_sell) / 2);
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
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
                'source' => 'name',
                'method' => function ($string, $separator) {
                    return $string;
                }
            ]
        ];
    }
}
