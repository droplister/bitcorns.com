<?php

namespace App\Http\Controllers;

use Cache;
use Gstt\Achievements\Model\AchievementDetails;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    /**
     * Achievements
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Sorts
        $sort = $request->has('sort') && $request->sort === 'hard' ? 'sortBy' : 'sortByDesc';

        // Farms
        $farm_achievements = Cache::remember('farm_achievements_index_' . $sort, 60, function () use ($sort) {
            return AchievementDetails::whereHas('progress', function ($progress) {
                return $progress->where('achiever_type', '=', \App\Farm::class);
            })->get()->{$sort}(function ($achievement) {
                return $achievement->unlocks()->count();
            });
        });

        // Tokens
        $token_achievements = Cache::remember('token_achievements_index_' . $sort, 60, function () use ($sort) {
            return AchievementDetails::whereHas('progress', function ($progress) {
                return $progress->where('achiever_type', '=', \App\Token::class);
            })->get()->{$sort}(function ($achievement) {
                return $achievement->unlocks()->count();
            });
        });

        // Index View
        return view('achievements.index', compact('sort', 'farm_achievements', 'token_achievements'));
    }

    /**
     * Achievement
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Gstt\Achievements\Model\AchievementDetails  $achievement
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AchievementDetails $achievement)
    {
        // Locked
        $locked_achievements = Cache::remember('locked_achievements_' . $achievement->id, 60, function () use ($achievement) {
            return $achievement->progress()->where('unlocked_at', '=', null)->get()->sortByDesc('points');
        });

        // Unlocked
        $unlocked_achievements = Cache::remember('unlocked_achievements_' . $achievement->id, 60, function () use ($achievement) {
            return $achievement->unlocks()->sortBy('unlocked_at');
        });

        // Show View
        return view('achievements.show', compact('achievement', 'locked_achievements', 'unlocked_achievements'));
    }
}
