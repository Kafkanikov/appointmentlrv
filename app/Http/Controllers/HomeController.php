<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->user_id; // Using our custom primary key 'user_id'

        // --- Fetch data for the summary cards ---

        // Upcoming appointments (where user is client or host)
        $upcomingAppointmentsCount = Appointment::where(function ($query) use ($userId) {
                $query->where('client_id', $userId)
                      ->orWhere('host_id', $userId);
            })
            ->where('start_time', '>=', now())
            ->count();
            
        // Total appointments as a Host
        $hostingCount = Appointment::where('host_id', $userId)->count();

        // Total appointments as a Client (booked by the user)
        $clientingCount = Appointment::where('client_id', $userId)->count();


        // --- Fetch data for the upcoming appointments list ---
        $upcomingAppointmentsList = Appointment::where(function ($query) use ($userId) {
                $query->where('client_id', $userId)
                      ->orWhere('host_id', $userId);
            })
            ->where('start_time', '>=', now())
            ->with(['client', 'host']) // Eager load to prevent N+1 queries
            ->orderBy('start_time', 'asc') // Show the soonest first
            ->limit(5)
            ->get();
        
        return view('home', compact(
            'user', 
            'upcomingAppointmentsCount', 
            'hostingCount', 
            'clientingCount',
            'upcomingAppointmentsList'
        ));
    }
}
