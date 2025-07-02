@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>My Appointments</h1>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('appointments.create') }}" class="btn btn-primary">Book New Appointment</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">Your Scheduled Appointments</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Client</th>
                                <th>Host</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->title }}</td>
                                    <td>{{ $appointment->client->name }}</td>
                                    <td>{{ $appointment->host->name }}</td>
                                    <td>{{ $appointment->start_time->format('Y-m-d H:i') }}</td>
                                    <td>{{ $appointment->end_time->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-info btn-sm">View</a>
                                        <!-- Only allow editing if the user is the client -->
                                        @if(Auth::id() == $appointment->client_id)
                                            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Cancel</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">You have no appointments.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

