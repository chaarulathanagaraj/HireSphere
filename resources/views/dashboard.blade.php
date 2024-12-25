<x-app-layout>
    <x-slot name="header">
        <!-- Header content if needed -->
    </x-slot>

    <style>
        /* General Body Styling */
        body {
            font-family: "Montserrat", sans-serif;
            background: #f5f5f5; /* Light grey background */
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: #333; /* Dark grey text */
        }

        /* Dashboard Container */
        .dashboard-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
            background-color: #ffffff; /* White background for container */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            border: 1px solid #ccc; /* Light grey border */
        }

        /* Navigation Links Styling */
        .dashboard-nav {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .dashboard-nav h3 {
            color: #555;
            margin-bottom: 10px;
        }

        .dashboard-nav ul {
            list-style: none;
            padding: 0;
        }

        .dashboard-nav li {
            margin-bottom: 10px;
        }

        .dashboard-nav a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 10px;
            background-color: #333; /* Dark grey background */
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .dashboard-nav a:hover {
            background-color: #555; /* Medium grey hover */
            transform: scale(1.05);
        }

        /* Content Section Styling */
        .dashboard-content {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .dashboard-content h3 {
            color: #555;
        }

        .welcome-user {
            font-size: 1.5rem;
            color: #333;
            font-weight: bold;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 10px;
            }

            .dashboard-nav, .dashboard-content {
                padding: 15px;
            }
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Container (single div for both navigation and content) -->
            <div class="dashboard-container">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="color:green">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
                <!-- Navigation Links -->
                <div class="dashboard-nav">
                <div class="dashboard-content">
                    <h3>Welcome to the Recruitement Portal</h3>
                    <p class="welcome-user">Hello, {{ auth()->user()->name }}!</p>
                    <!-- Add other content for the dashboard here -->
                </div>
                   
                    @if (auth()->user()->name === 'HR')
                        <ul>
                           
                            <li><a href="/requests">Requests</a></li>
                            <li><a href="/hired">Hired Candidates Details</a></li>
                        </ul>
                    @else
                        <ul>
                            <li><a href="/requirement-form">Requirement Form</a></li>
                            <li><a href="/req_details">Request Details</a></li>
                            <li><a href="/hiring-details">Hired Candidates Details</a></li>
                        </ul>
                    @endif
                </div>

                <!-- Content Section -->
                
            </div>
        </div>
    </div>
</x-app-layout>
