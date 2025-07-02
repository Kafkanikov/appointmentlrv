@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center bg-warning text-dark">
                    <h3 class="my-3"><i class="bi bi-pencil-square me-2"></i>Edit Appointment</h3>
                    <p class="mb-0 text-muted fst-italic">"{{ $appointment->title }}"</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('appointments.update', $appointment->appointment_id) }}">
                        @csrf
                        @method('PUT') <!-- Crucial for update operations -->

                        <!-- Title -->
                        <div class="form-floating mb-3">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $appointment->title) }}" required autofocus placeholder="Appointment Title">
                            <label for="title"><i class="bi bi-fonts me-2"></i>Title</label>
                            @error('title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- Host Selection -->
                        <div class="form-floating mb-3">
                            <select id="host_id" class="form-select @error('host_id') is-invalid @enderror" name="host_id" required>
                                <option value="" disabled>Select a Host</option>
                                @foreach($hosts as $host)
                                    <option value="{{ $host->user_id }}" {{ old('host_id', $appointment->host_id) == $host->user_id ? 'selected' : '' }}>
                                        {{ $host->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="host_id"><i class="bi bi-person-badge me-2"></i>Book with (Host)</label>
                            @error('host_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Start Time -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="start_time" type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time', $appointment->start_time->format('Y-m-d\TH:i')) }}" required>
                                    <label for="start_time"><i class="bi bi-calendar-plus me-2"></i>Start Time</label>
                                    @error('start_time')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <!-- End Time -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="end_time" type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time', $appointment->end_time->format('Y-m-d\TH:i')) }}" required>
                                    <label for="end_time"><i class="bi bi-calendar-minus me-2"></i>End Time</label>
                                    @error('end_time')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-floating mb-3">
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" style="height: 120px">{{ old('description', $appointment->description) }}</textarea>
                            <label for="description"><i class="bi bi-text-left me-2"></i>Description (Optional)</label>
                             @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        
                        <div class="mt-4 d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-2"></i>Update Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection