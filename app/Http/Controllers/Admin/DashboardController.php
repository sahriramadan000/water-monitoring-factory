<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use App\Models\Sensor;
use App\Models\Site;
use Illuminate\Http\Request;

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

        // Return the view with the data, including current and next factory/site
        return view('admin.dashboard.index', compact([
            'factories',
            'currentFactory',
            'nextFactory',
            'currentSite',
            'nextSite',
            'activeSitesCount',
            'inactiveSitesCount',
            'getSiteCode',
            'getSensorIdent'
        ]));
    }

}
