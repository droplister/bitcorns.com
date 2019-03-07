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
        \Droplister\XcpCore\App\Events\CreditWasCreated::class => [
            // Game Play
            \App\Listeners\CreateFarmsFromCredits::class,
            // Achievements
            \App\Listeners\FarmCreditAchievements::class,
        ],
        \Droplister\XcpCore\App\Events\BalanceWasUpdated::class => [
            \App\Listeners\AccessDependentOnCropsBalance::class,
        ],
        \Droplister\XcpCore\App\Events\DividendWasCreated::class => [
            \App\Listeners\UpdateHarvestsOnDividend::class,
        ],
        // Achievements
        \Gstt\Achievements\Event\Unlocked::class => [
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
        \Droplister\XcpCore\App\Events\BalanceWasCreated::class => [
            \App\Listeners\TokenBalanceAchievements::class,
        ],
        \Droplister\XcpCore\App\Events\OrderMatchWasCreated::class => [
            \App\Listeners\FarmTradingAchievements::class,
            \App\Listeners\TokenTradingAchievements::class,
        ],
        // Bitcorn Cards
        \App\Events\TokenWasCreated::class => [
            \App\Listeners\AnnounceNewCardSubmissions::class,
        ],
        \Droplister\XcpCore\App\Events\SendWasCreated::class => [
            // Bitcorn Cards
            \App\Listeners\MonitorMuseumDeposits::class,
            \App\Listeners\MonitorSubmissionFees::class,
            // Achievements
            \App\Listeners\FarmSendAchievements::class,
            \App\Listeners\TokenSendAchievements::class,
        ],
        // Home Features
        \Droplister\XcpCore\App\Events\BlockWasCreated::class => [
            \App\Listeners\FeatureListener::class,
        ],


        // XC3-PO Channel
        \Droplister\XcpCore\App\Events\MessageWasCreated::class => [
            \App\Listeners\XC3POTelegramChannel::class,
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
