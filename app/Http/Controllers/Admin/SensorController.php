<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use App\Models\Site;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $sensors = Sensor::with('site')->get();
        return view('sensors.index', compact('sensors'));
    }

    // Show the form for creating a new resource
    public function create($idSite)
    {
        $site = Site::find($idSite);
        return view('admin.sensors.create', compact(['idSite', 'site']));
    }

    // Store a newly created resource in storage
    public function store(Request $request, $idSite)
    {
        Sensor::create($request->all());
        $site = Site::find($idSite);
        return redirect()->route('sites.show', [$site->factory_id, $idSite])->with('success', 'Sensor created successfully.');
    }

    // Display the specified resource
    public function show($idSite, $idSensor)
    {
        $sensor = Sensor::find($idSensor);
        return view('sensors.show', compact('sensor'));
    }

    // Show the form for editing the specified resource
    public function edit($idSite, $idSensor)
    {
        $sensor = Sensor::find($idSensor);
        $site = Site::find($idSite);
        return view('admin.sensors.edit', compact('sensor', 'site', 'idSite'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $idSite, $idSensor)
    {
        $sensor = Sensor::find($idSensor);
        $sensor->update($request->all());
        $site = Site::find($idSite);

        return redirect()->route('sites.show', [$site->factory_id, $idSite])->with('success', 'Sensor updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy($idSite, $idSensor)
    {
        $sensor = Sensor::find($idSensor);
        $sensor->delete();
        $site = Site::find($idSite);

        return redirect()->route('sites.show', [$site->factory_id, $idSite])->with('success', 'Sensor deleted successfully.');
    }
}
