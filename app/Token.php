<?php

namespace App;

use Storage;
use Exception;
use App\Traits\Linkable;
use App\Traits\Touchable;
use App\Traits\Achievable;
use App\Events\TokenWasCreated;
use Gstt\Achievements\Achiever;
use Droplister\XcpCore\App\Send;
use Droplister\XcpCore\App\Asset;
use Droplister\XcpCore\App\OrderMatch;
use App\Http\Requests\Cards\IndexRequest;
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
    public static function boot() {
        static::creating(function (Token $token) {
            if(in_array($token->type, ['access', 'reward']) && static::whereType($token->type)->exists()) {
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
     * Farms
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function farms()
    {
        return $this->hasManyThrough(Farm::class, TokenBalance::class, 'asset', 'xcp_core_address', 'xcp_core_asset_name', 'address');
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
        return $query->whereNull('approved_at')->whereNull('rejected_at');
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
        if(isset($hd_image_url))
        {
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
    private function storeImage($file, $hd=false)
    {
        // Get Key
        $key = $hd ? 'meta_data->hd_image_url' : 'image_url';

        // Put File
        $image_path = Storage::putFile('public/tokens/', $file);

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
    public function lastMatch($quote_asset='XCP')
    {
        return OrderMatch::where('backward_asset', '=', $this->xcp_core_asset_name)
            ->where('forward_asset', '=', $quote_asset)
            ->where('status', '=', 'completed')
            ->orWhere('backward_asset', '=', $quote_asset)
            ->where('forward_asset', '=', $this->xcp_core_asset_name)
            ->where('status', '=', 'completed')
            ->orderBy('tx1_index', 'desc')
            ->first();
    }

    /**
     * Get Filtered Cards
     *
     * @param  \App\Http\Requests\Cards\IndexRequest  $request
     * @param  mixed  $filter
     * @return mixed
     */
    public static function getFilteredCards(IndexRequest $request, $filter)
    {
        // Cards to Filter
        $cards = Token::published()->upgrades();

        // Harvest
        if($filter && is_int((int) $filter) && (int) $filter !== 0)
        {
            $cards = $cards->where('harvest_id', '=', $filter);
        }
        // Format
        elseif($filter && is_string($filter))
        {
            $cards = $cards->where('image_url', 'like', '%'. $filter);
        }

        return $cards->orderBy('meta_data->overall_ranking', 'asc');
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
