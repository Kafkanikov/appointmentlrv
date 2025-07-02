@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Locations</h1>
                <a href="{{ route('locations.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Add New Location
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">All Locations</h5>
                </div>
                <div class="card-body">
                    @if($locations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Floor</th>
                                        <th>Capacity</th>
                                        <th>Status</th>
                                        <th>Appointments</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locations as $location)
                                        <tr>
                                            <td>
                                                <strong>{{ $location->name }}</strong>
                                                @if($location->description)
                                                    <br><small class="text-muted">{{ Str::limit($location->description, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $location->address ?: 'Not specified' }}</td>
                                            <td>{{ $location->floor ?: '-' }}</td>
                                            <td>
                                                @if($location->capacity)
                                                    <span class="badge bg-info">{{ $location->capacity }} people</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($location->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $location->appointments()->count() }}</span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('locations.show', $location->location_id) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('locations.edit', $location->location_id) }}" 
                                                       class="btn btn-sm btn-outline-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('locations.toggle-status', $location->location_id) }}" 
                                                          method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary" 
                                                                title="{{ $location->is_active ? 'Deactivate' : 'Activate' }}">
                                                            <i class="bi bi-{{ $location->is_active ? 'pause' : 'play' }}"></i>
                                                        </button>
                                                    </form>
                                                    @if($location->appointments()->count() == 0)
                                                        <form action="{{ route('locations.destroy', $location->location_id) }}" 
                                                              method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                    onclick="return confirm('Are you sure you want to delete this location?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-geo-alt display-1 text-muted"></i>
                            <h4 class="text-muted mt-3">No locations found</h4>
                            <p class="text-muted">Start by adding your first location.</p>
                            <a href="{{ route('locations.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Add New Location
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
