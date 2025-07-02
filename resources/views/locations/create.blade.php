@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Location</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('locations.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Location Name *</label>
                            <input id="name" type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" 
                                   required autofocus placeholder="e.g., Conference Room A, Office 101">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      name="description" rows="3" 
                                      placeholder="Brief description of the location">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" type="text" 
                                   class="form-control @error('address') is-invalid @enderror" 
                                   name="address" value="{{ old('address') }}" 
                                   placeholder="Full address of the location">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Floor and Capacity -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="floor" class="form-label">Floor</label>
                                    <input id="floor" type="text" 
                                           class="form-control @error('floor') is-invalid @enderror" 
                                           name="floor" value="{{ old('floor') }}" 
                                           placeholder="e.g., 2nd Floor, Ground Floor">
                                    @error('floor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input id="capacity" type="number" 
                                           class="form-control @error('capacity') is-invalid @enderror" 
                                           name="capacity" value="{{ old('capacity') }}" 
                                           min="1" placeholder="Number of people">
                                    @error('capacity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Equipment -->
                        <div class="form-group mb-3">
                            <label for="equipment" class="form-label">Equipment</label>
                            <input id="equipment" type="text" 
                                   class="form-control @error('equipment') is-invalid @enderror" 
                                   name="equipment" value="{{ old('equipment') }}" 
                                   placeholder="e.g., Projector, Whiteboard, Video Conference (comma separated)">
                            <small class="form-text text-muted">
                                List equipment available in this location, separated by commas
                            </small>
                            @error('equipment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Active Status -->
                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="is_active" id="is_active" value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active (available for booking)
                                </label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('locations.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Create Location
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
