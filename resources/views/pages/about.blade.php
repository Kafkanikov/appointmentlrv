@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center p-5 mb-4 bg-light rounded-3 shadow-sm">
                <h1 class="display-5 fw-bold">Appointment Scheduler</h1>
                <p class="fs-4">A Sample Laravel CRUD Application</p>
                <p>This project demonstrates a complete CRUD (Create, Read, Update, Delete) application built with Laravel. It allows registered users to book and manage appointments with each other.</p>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started →</a>
            </div>

            <div class="row">
                <!-- Features Card -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 fw-normal"><i class="bi bi-star-fill me-2"></i>Core Features</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>User Authentication (Register/Login)</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Personalized User Dashboard</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Create Appointments with Other Users</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>View All Appointments (as Host or Client)</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Edit Upcoming Appointments</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Cancel (Delete) Appointments</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Custom Table & Primary Key Naming</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tech Stack Card -->
                <div class="col-md-6 mb-4">
                     <div class="card h-100 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 fw-normal"><i class="bi bi-hdd-stack-fill me-2"></i>Technology Stack</h4>
                        </div>
                        <div class="card-body">
                             <ul class="list-unstyled mt-3 mb-4">
                                <li class="mb-2"><i class="bi bi-arrow-right-short me-2"></i><strong>Backend:</strong> Laravel 10</li>
                                <li class="mb-2"><i class="bi bi-arrow-right-short me-2"></i><strong>Frontend:</strong> Bootstrap 5</li>
                                <li class="mb-2"><i class="bi bi-arrow-right-short me-2"></i><strong>Authentication:</strong> Laravel UI</li>
                                <li class="mb-2"><i class="bi bi-arrow-right-short me-2"></i><strong>Database:</strong> MySQL</li>
                                <li class="mb-2"><i class="bi bi-arrow-right-short me-2"></i><strong>Asset Bundling:</strong> Vite</li>
                            </ul>
                        </div>
                        <div class="card-footer text-muted">
                            Created by Meas Martin & Kim Monika
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection