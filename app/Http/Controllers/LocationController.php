<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::active()->orderBy('name')->get();
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'floor' => 'nullable|string|max:50',
            'capacity' => 'nullable|integer|min:1',
            'equipment' => 'nullable|string',
        ]);

        $data = $request->all();
        
        // Convert equipment string to array
        if ($request->equipment) {
            $data['equipment'] = array_filter(array_map('trim', explode(',', $request->equipment)));
        }

        Location::create($data);

        return redirect()->route('locations.index')
                         ->with('success', 'Location created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        // Get recent appointments for this location
        $recentAppointments = $location->appointments()
            ->with(['client', 'host'])
            ->orderBy('start_time', 'desc')
            ->limit(10)
            ->get();

        return view('locations.show', compact('location', 'recentAppointments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'floor' => 'nullable|string|max:50',
            'capacity' => 'nullable|integer|min:1',
            'equipment' => 'nullable|string',
        ]);

        $data = $request->all();
        
        // Convert equipment string to array
        if ($request->equipment) {
            $data['equipment'] = array_filter(array_map('trim', explode(',', $request->equipment)));
        }

        $location->update($data);

        return redirect()->route('locations.index')
                         ->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        // Check if location has appointments
        if ($location->appointments()->count() > 0) {
            return redirect()->route('locations.index')
                           ->with('error', 'Cannot delete location with existing appointments.');
        }

        $location->delete();

        return redirect()->route('locations.index')
                         ->with('success', 'Location deleted successfully.');
    }

    /**
     * Toggle location active status.
     */
    public function toggleStatus(Location $location)
    {
        $location->update(['is_active' => !$location->is_active]);
        
        $status = $location->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()
                         ->with('success', "Location {$status} successfully.");
    }
}
