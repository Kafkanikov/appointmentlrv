<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Get appointments where the user is either the client or the host
        $appointments = Appointment::where('client_id', $userId)
            ->orWhere('host_id', $userId)
            ->with(['client', 'host']) // Eager load relationships
            ->orderBy('start_time', 'desc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all users except the currently logged-in one to select as a host
        $hosts = User::where('user_id', '!=', Auth::id())->get();
        return view('appointments.create', compact('hosts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'host_id' => 'required|exists:tb_users,user_id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'description' => 'nullable|string',
        ]);

        $appointment = new Appointment($request->all());
        $appointment->client_id = Auth::id(); // Set the client to the logged-in user
        $appointment->save();

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        // Authorization: Ensure the user can view this appointment
        $this->authorizeUserAction($appointment);

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        // Authorization
        $this->authorizeUserAction($appointment);

        $hosts = User::where('user_id', '!=', Auth::id())->get();
        return view('appointments.edit', compact('appointment', 'hosts'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Authorization
        $this->authorizeUserAction($appointment);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'host_id' => 'required|exists:tb_users,user_id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'description' => 'nullable|string',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        // Authorization
        $this->authorizeUserAction($appointment);

        $appointment->delete();

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment canceled successfully.');
    }

    /**
     * Helper function for authorization.
     */
    private function authorizeUserAction(Appointment $appointment)
    {
        if (Auth::id() !== $appointment->client_id && Auth::id() !== $appointment->host_id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
