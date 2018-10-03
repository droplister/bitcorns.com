<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Game Play
        'Droplister\XcpCore\App\Events\CreditWasCreated' => [
            // Game Play
            \App\Listeners\CreateFarmsFromCredits::class,
            // Achievements
            \App\Listeners\FarmCreditAchievements::class,
        ],
        'Droplister\XcpCore\App\Events\BalanceWasUpdated' => [
            \App\Listeners\AccessDependentOnCropsBalance::class,
        ],
        'Droplister\XcpCore\App\Events\DividendWasCreated' => [
            \App\Listeners\UpdateHarvestsOnDividend::class,
        ],
        // Achievements
        'Gstt\Achievements\Event\Unlocked' => [
            \App\Listeners\RelativeAchievementTimestamps::class,
            \App\Listeners\AchievementAchievements::class,
        ],
        \App\Events\FarmWasCreated::class => [
            \App\Listeners\FarmCreationAchievements::class,
        ],
        \App\Events\FeatureWasCreated::class => [
            \App\Listeners\FeatureAchievements::class,
        ],
        \App\Events\MapMarkerWasCreated::class => [
            \App\Listeners\MapMarkerAchievements::class,
        ],
        \App\Events\UploadWasCreated::class => [
            \App\Listeners\UploadAchievements::class,
        ],
        'Droplister\XcpCore\App\Events\BalanceWasCreated' => [
            \App\Listeners\TokenBalanceAchievements::class,
        ],
        'Droplister\XcpCore\App\Events\OrderMatchWasCreated' => [
            \App\Listeners\FarmTradingAchievements::class,
            \App\Listeners\TokenTradingAchievements::class,
        ],
        // Bitcorn Cards
        \App\Events\TokenWasCreated::class => [
            \App\Listeners\AnnounceNewCardSubmissions::class,
        ],
        'Droplister\XcpCore\App\Events\SendWasCreated' => [
            // Bitcorn Cards
            \App\Listeners\MonitorMuseumDeposits::class,
            \App\Listeners\MonitorSubmissionFees::class,
            // Achievements
            \App\Listeners\FarmSendAchievements::class,
            \App\Listeners\TokenSendAchievements::class,
        ],
        // Home Features
        'Droplister\XcpCore\App\Events\BlockWasCreated' => [
            \App\Listeners\FeatureListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
