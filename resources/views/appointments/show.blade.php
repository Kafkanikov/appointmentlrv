@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $appointment->title }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong></p>
                    <p>{{ $appointment->description ?: 'No description provided.' }}</p>
                    <hr>
                    <p><strong>Client:</strong> {{ $appointment->client->name }}</p>
                    <p><strong>Host:</strong> {{ $appointment->host->name }}</p>
                    <p><strong>From:</strong> {{ $appointment->start_time->format('l, F j, Y \a\t H:i A') }}</p>
                    <p><strong>To:</strong> {{ $appointment->end_time->format('l, F j, Y \a\t H:i A') }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back to List</a>
                    @if(Auth::id() == $appointment->client_id)
                        <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">Cancel Appointment</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection