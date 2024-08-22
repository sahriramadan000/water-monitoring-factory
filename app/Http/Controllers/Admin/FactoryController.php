<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
     // Display a listing of the resource
     public function index()
     {
         $factories = Factory::all();
         return view('admin.factories.index', compact('factories'));
     }

     // Show the form for creating a new resource
     public function create()
     {
         return view('admin.factories.create');
     }

     // Store a newly created resource in storage
     public function store(Request $request)
     {
         Factory::create($request->all());

         return redirect()->route('factories.index')->with('success', 'Factory created successfully.');
     }

     public function show($id)
     {
        $factory = Factory::with(['sites' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->orderBy('id', 'asc')->findOrFail($id);

        return view('admin.factories.show', compact('factory'));
     }

     // Show the form for editing the specified resource
     public function edit($id)
     {
         $factory = Factory::find($id);
         return view('admin.factories.edit', compact('factory'));
     }

     // Update the specified resource in storage
     public function update(Request $request, $id)
     {
         $factory = Factory::find($id);
         $factory->update($request->all());

         return redirect()->route('factories.index')->with('success', 'Factory updated successfully.');
     }

     // Remove the specified resource from storage
     public function destroy($id)
     {
         $factory = Factory::find($id);
         $factory->delete();

         return redirect()->route('factories.index')->with('success', 'Factory deleted successfully.');
     }
}
