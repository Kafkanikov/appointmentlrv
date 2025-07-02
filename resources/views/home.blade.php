@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2 class="font-weight-bold">Welcome back, {{ $user->name }}!</h2>
            <p class="text-muted">Here's a summary of your activity.</p>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="row">
        <!-- Upcoming Appointments Card -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card text-white bg-primary shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="bi bi-calendar-check me-2"></i>Upcoming</h5>
                        <h2 class="display-4 font-weight-bold">{{ $upcomingAppointmentsCount }}</h2>
                    </div>
                    <a href="{{ route('appointments.index') }}" class="stretched-link text-white-50">View all</a>
                </div>
            </div>
        </div>

        <!-- Hosting Card -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card text-white bg-success shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="bi bi-person-badge me-2"></i>As Host</h5>
                        <h2 class="display-4 font-weight-bold">{{ $hostingCount }}</h2>
                    </div>
                     <a href="{{ route('appointments.index') }}" class="stretched-link text-white-50">View details</a>
                </div>
            </div>
        </div>

        <!-- Booked by You Card -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card text-white bg-info shadow-sm h-100">
                 <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="bi bi-person-lines-fill me-2"></i>As Client</h5>
                        <h2 class="display-4 font-weight-bold">{{ $clientingCount }}</h2>
                    </div>
                     <a href="{{ route('appointments.index') }}" class="stretched-link text-white-50">View history</a>
                </div>
            </div>
        </div>

        <!-- New Appointment CTA Card -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card bg-light shadow-sm h-100">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <h5 class="card-title">Need to schedule?</h5>
                    <p class="card-text">Book a new appointment with another user.</p>
                    <a href="{{ route('appointments.create') }}" class="btn btn-dark stretched-link">
                        <i class="bi bi-plus-circle me-2"></i>Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upcoming Appointments List -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Your Next 5 Upcoming Appointments</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse ($upcomingAppointmentsList as $appointment)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('appointments.show', $appointment->appointment_id) }}" class="fw-bold">{{ $appointment->title }}</a>
                                    <small class="d-block text-muted">
                                        @if ($appointment->host_id == $user->user_id)
                                            With <strong>{{ $appointment->client->name }}</strong> (You are hosting)
                                        @else
                                            With <strong>{{ $appointment->host->name }}</strong>
                                        @endif
                                    </small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-secondary rounded-pill">
                                        {{ $appointment->start_time->format('D, M j, Y') }}
                                    </span>
                                    <div class="text-muted small">{{ $appointment->start_time->format('g:i A') }}</div>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center">
                                <i class="bi bi-emoji-sunglasses me-2"></i>You have no upcoming appointments. Enjoy your free time!
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-center">
                     <a href="{{ route('appointments.index') }}">View All Appointments</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection