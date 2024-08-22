<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $sites = Site::with('factory')->get();
        return view('sites.index', compact('sites'));
    }

    // Show the form for creating a new resource
    public function create($idFactory)
    {
        return view('admin.sites.create', compact('idFactory'));
    }

    // Store a newly created resource in storage
    public function store(Request $request, $idFactory)
    {
        Site::create($request->all());

        return redirect()->route('factories.show', $idFactory)->with('success', 'Site created successfully.');
    }

    // Display the specified resource
    public function show($idFactory, $idSite)
    {
        $site = Site::with(['sensors' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->orderBy('id', 'asc')->findOrFail($idSite);
        return view('admin.sites.show', compact('site'));
    }

    // Show the form for editing the specified resource
    public function edit($idFactory, $idSite)
    {
        $site = Site::find($idSite);
        return view('admin.sites.edit', compact('idFactory', 'site'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $idFactory, $idSite)
    {
        $site = Site::find($idSite);
        $site->update($request->all());

        return redirect()->route('factories.show', $idFactory)->with('success', 'Site updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy($idFactory, $idSite)
    {
        $site = Site::find($idSite);
        $site->delete();

        return redirect()->route('factories.show', $idFactory)->with('success', 'Site deleted successfully.');
    }
}
