<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SensorHistory;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Define parameters from the request or set defaults
        // $type = $request->input('type', 'day');
        // $type = 'day';
        $dateFrom = $request->input('dateFrom', date('Y-m-d')) . ' 00:00:00';
        $dateTo = $request->input('dateTo', date('Y-m-d')) . ' 23:59:59';
        // $month = $request->input('month', date('Y-m'));
        // $year = $request->input('year', date('Y'));
        $selectedSite = $request->input('site_code');
        $range = $request->range ?? '1';

        // Initialize an empty variable for logs report
        $logs_report = null;

        // Data Table & Chart Logic Based on Time Range
        // if ($type == 'day') {
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
                ->where('sensor_histories.site_code', $selectedSite)
                ->whereBetween('sensor_histories.created_at', [date('Y-m-d H:i:s', strtotime($dateFrom)), date('Y-m-d H:i:s', strtotime($dateTo))])
                ->orderBy('sensor_histories.created_at', 'asc')
                ->orderBy('datetime', 'desc')
                ->get()
                ->unique('datetime');
        // }
        // elseif ($type == 'month') {
        //     $dateFrom = date('Y-m-01 00:00:00', strtotime($month));
        //     $dateTo = date('Y-m-t 23:59:59', strtotime($month));

        //     $logs_report = DB::table('sensor_histories')
        //         ->join('sites', 'sensor_histories.site_code', '=', 'sites.site_code')
        //         ->select(DB::raw("
        //             date_trunc('day', sensor_histories.created_at) AS datetime,
        //             sensor_histories.flow,
        //             sensor_histories.total_debit,
        //             sensor_histories.ph,
        //             sensor_histories.total_credit,
        //             sites.site_name
        //         "))
        //         ->where('sensor_histories.site_code', $selectedSite)
        //         ->whereBetween('sensor_histories.created_at', [$dateFrom, $dateTo])
        //         ->orderBy('datetime', 'desc')
        //         ->get();
        // } elseif ($type == 'year') {
        //     $dateFrom = date('Y-01-01 00:00:00', strtotime($year));
        //     $dateTo = date('Y-12-t 23:59:59', strtotime($year));

        //     $logs_report = DB::table('sensor_histories')
        //         ->join('sites', 'sensor_histories.site_code', '=', 'sites.site_code')
        //         ->select(DB::raw("
        //             date_trunc('month', sensor_histories.created_at) AS datetime,
        //             sensor_histories.flow,
        //             sensor_histories.total_debit,
        //             sensor_histories.ph,
        //             sensor_histories.total_credit,
        //             sites.site_name
        //         "))
        //         ->where('sensor_histories.site_code', $selectedSite)
        //         ->whereBetween('sensor_histories.created_at', [$dateFrom, $dateTo])
        //         ->orderBy('datetime', 'desc')
        //         ->get();
        // }

        // Extract data for charts
        $flowVelocityData = $logs_report->pluck('flow')->toArray();
        $debitVolumeData = $logs_report->pluck('total_debit')->toArray();
        $acidityScoreData = $logs_report->pluck('ph')->toArray();
        $totalCreditData = $logs_report->pluck('total_credit')->toArray();
        $labels = $logs_report->pluck('datetime')->map(function($date) {
            return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s'); // Adjust format as needed
        })->toArray();

        // Query to get the list of sites for the dropdown
        $sites = Site::all();  // Ensure this is the actual method to get sites
        $selectedSiteName = $selectedSite ? Site::where('site_code', $selectedSite)->first()->site_name : 'All Sites';

        return view('admin.report.index', [
            'dataSensors' => $logs_report,
            'sites' => $sites,
            'selectedSite' => $selectedSite,
            // 'type' => $type,
            'range' => $range,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            // 'month' => $month,
            // 'year' => $year,
            'selectedSiteName' => $selectedSiteName,
            'flowVelocityData' => $flowVelocityData,
            'debitVolumeData' => $debitVolumeData,
            'acidityScoreData' => $acidityScoreData,
            'totalCreditData' => $totalCreditData,
            'labels' => $labels
        ]);
    }
}
