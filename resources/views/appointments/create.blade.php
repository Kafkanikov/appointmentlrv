@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Book a New Appointment</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf

                        <!-- Title -->
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- Host Selection -->
                        <div class="form-group mb-3">
                            <label for="host_id">Book with (Host)</label>
                            <select id="host_id" class="form-control @error('host_id') is-invalid @enderror" name="host_id" required>
                                <option value="">Select a Host</option>
                                @foreach($hosts as $host)
                                    <option value="{{ $host->user_id }}" {{ old('host_id') == $host->user_id ? 'selected' : '' }}>
                                        {{ $host->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('host_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- Start Time -->
                        <div class="form-group mb-3">
                            <label for="start_time">Start Time</label>
                            <input id="start_time" type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time') }}" required>
                            @error('start_time')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        
                        <!-- End Time -->
                        <div class="form-group mb-3">
                            <label for="end_time">End Time</label>
                            <input id="end_time" type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time') }}" required>
                            @error('end_time')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description">Description (Optional)</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                             @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Book Appointment</button>
                        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection