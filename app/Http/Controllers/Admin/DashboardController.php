<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use App\Models\Sensor;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $currentFactoryId = $request->query('current_factory_id');
        $currentSiteId = $request->query('current_site_id');

        // Retrieve all active factories
        $factories = Factory::with(['sites' => function ($query) {
            $query->orderBy('id', 'asc'); // Only active sites
        }])
        ->where('status', true) // Only active factories
        ->orderBy('id', 'asc')
        ->get();

        // Determine the current factory
        $currentFactory = $factories->firstWhere('id', $currentFactoryId) ?? $factories->first();

        // Determine the current site within the current factory
        $currentSite = $currentFactory->sites->firstWhere('id', $currentSiteId) ?? $currentFactory->sites->first();

        // Determine the next active factory
        $nextFactory = Factory::where('id', '>', $currentFactory->id)
                            ->where('status', true) // Only active factories
                            ->orderBy('id', 'asc')
                            ->first() ?? Factory::where('status', true)->orderBy('id', 'asc')->first();

        // Determine the next active site within the current factory
        $nextSite = Site::where('id', '>', $currentSite->id)
                            ->where('factory_id', $currentFactory->id)
                            ->where('status', true) // Only active sites
                            ->orderBy('id', 'asc')
                            ->first() ?? Site::where('factory_id', $currentFactory->id)->where('status', true)->orderBy('id', 'asc')->first();

        // Count active and inactive sites for the current factory
        $activeSitesCount = Site::where('factory_id', $currentFactory->id)
                                ->where('status', true)
                                ->count();
        $inactiveSitesCount = Site::where('factory_id', $currentFactory->id)
                                ->where('status', false)
                                ->count();

        $getSiteCode = Site::where('factory_id', $currentFactory->id)
                        ->get()->pluck('site_code');

        $getSensorIdent = Sensor::where('site_id', $currentSite->id)
                        ->get()->pluck('sensor_ident');

        // Retrieve the chart data
        $range = 60; // Interval in minutes for grouping data
        $dateFrom = now()->startOfDay();
        $dateTo = now()->endOfDay();

        $logs_report = DB::table('sensor_histories')
                    ->join('sites', 'sensor_histories.site_code', '=', 'sites.site_code')
                    ->select(DB::raw("
                        date_trunc('hour', sensor_histories.created_at) +
                        (((date_part('minute', sensor_histories.created_at)::integer / ".$range."::integer) * ".$range."::integer)
                        || 'minutes')::interval AS datetime,
                        sensor_histories.flow,
                        sensor_histories.total_debit,
                        sensor_histories.ph,
                        sensor_histories.total_credit,
                        sites.site_name
                    "))
                    ->where('sensor_histories.site_code', $currentSite->site_code)
                    ->whereBetween('sensor_histories.created_at', [$dateFrom, $dateTo])
                    ->orderBy('sensor_histories.created_at', 'asc')
                    ->orderBy('datetime', 'desc')
                    ->get()
                    ->unique('datetime');

        $flowVelocityData = $logs_report->pluck('flow')->toArray();
        $debitVolumeData = $logs_report->pluck('total_debit')->toArray();
        $acidityScoreData = $logs_report->pluck('ph')->toArray();
        $totalCreditData = $logs_report->pluck('total_credit')->toArray();
        $labels = $logs_report->pluck('datetime')->map(function($date) {
            return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s'); // Adjust format as needed
        })->toArray();

        // Return the view with the data, including current and next factory/site and chart data
        return view('admin.dashboard.index', compact([
            'factories',
            'currentFactory',
            'nextFactory',
            'currentSite',
            'nextSite',
            'activeSitesCount',
            'inactiveSitesCount',
            'getSiteCode',
            'getSensorIdent',
            'flowVelocityData',
            'debitVolumeData',
            'acidityScoreData',
            'totalCreditData',
            'labels',
        ]));
    }

}
