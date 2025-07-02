@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>{{ $location->name }}</h4>
                        <span class="badge {{ $location->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $location->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    @if($location->description)
                        <p><strong>Description:</strong></p>
                        <p>{{ $location->description }}</p>
                        <hr>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Address:</strong></p>
                            <p>{{ $location->address ?: 'Not specified' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Floor:</strong></p>
                            <p>{{ $location->floor ?: 'Not specified' }}</p>
                        </div>
                    </div>

                    @if($location->capacity)
                        <p><strong>Capacity:</strong></p>
                        <p>{{ $location->capacity }} people</p>
                    @endif

                    @if($location->equipment && count($location->equipment) > 0)
                        <p><strong>Available Equipment:</strong></p>
                        <div class="mb-3">
                            @foreach($location->equipment as $item)
                                <span class="badge bg-info me-1">{{ $item }}</span>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-3">
                        <p><strong>Statistics:</strong></p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-calendar-event me-2"></i>Total Appointments: {{ $location->appointments()->count() }}</li>
                            <li><i class="bi bi-calendar-check me-2"></i>Upcoming Appointments: {{ $location->appointments()->where('start_time', '>=', now())->count() }}</li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('locations.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Locations
                        </a>
                        <div>
                            <a href="{{ route('locations.edit', $location->location_id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil me-2"></i>Edit
                            </a>
                            @if($location->appointments()->count() == 0)
                                <form action="{{ route('locations.destroy', $location->location_id) }}" 
                                      method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this location?')">
                                        <i class="bi bi-trash me-2"></i>Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Appointments</h5>
                </div>
                <div class="card-body">
                    @if($recentAppointments->count() > 0)
                        @foreach($recentAppointments as $appointment)
                            <div class="border-bottom pb-2 mb-2">
                                <h6 class="mb-1">{{ $appointment->title }}</h6>
                                <small class="text-muted">
                                    {{ $appointment->start_time->format('M j, Y \a\t g:i A') }}<br>
                                    Client: {{ $appointment->client->name }}<br>
                                    Host: {{ $appointment->host->name }}
                                </small>
                            </div>
                        @endforeach
                        <div class="text-center mt-3">
                            <a href="{{ route('appointments.index') }}?location={{ $location->location_id }}" 
                               class="btn btn-sm btn-outline-primary">
                                View All Appointments
                            </a>
                        </div>
                    @else
                        <p class="text-muted text-center">No appointments yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
