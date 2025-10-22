<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function weeklyReport(Request $request)
    {
        $weekOffset = (int) $request->get('week_offset', 0);
        $weekOffset = max(0, $weekOffset);
        $endDate = Carbon::now()->subWeeks($weekOffset)->endOfDay();
        $startDate = Carbon::now()->subWeeks($weekOffset)->subDays(6)->startOfDay();
        $weeklyMoods = auth()->user()->moods()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
        $mostCommonMood = null;
        if ($weeklyMoods->isNotEmpty()) {
            $moodCounts = $weeklyMoods->groupBy('mood')->map->count();
            $mostCommonMood = $moodCounts->sortDesc()->keys()->first();
        }
    
        $consistencyRate = 0;
        if ($weeklyMoods->isNotEmpty()) {
            $uniqueDays = $weeklyMoods->groupBy(function($mood) {
                return $mood->created_at->format('Y-m-d');
            })->count();
            $consistencyRate = round(($uniqueDays / 7) * 100);
        }
        
        return view('Reports.weekly_report', compact(
            'weeklyMoods', 
            'mostCommonMood', 
            'consistencyRate',
            'startDate',
            'endDate',
            'weekOffset'
        ));
    }
}