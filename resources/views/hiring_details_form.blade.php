<x-app-layout>
    <x-slot name="header">
        <!-- Header content if needed -->
    </x-slot>

    <style>
        /* General Body Styling */
        body {
            font-family: 'Montserrat', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: #333;
        }

        /* Input Panel */
        .input-panel {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            max-width: 600px;
            margin: 20px auto;
        }

        .input-panel h3 {
            color: #555;
            margin-bottom: 20px;
        }

        /* Form Styling */
        .form-label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 15px;
            width: 100%;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #333;
            outline: none;
            box-shadow: 0 0 5px rgba(51, 51, 51, 0.3);
        }

        .btn-custom {
            background-color: #333;
            color: #ffffff;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn-custom:hover {
            background-color: #555;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .input-panel {
                padding: 15px;
                margin: 15px;
            }

            .form-control {
                font-size: 0.9rem;
            }

            .btn-custom {
                padding: 8px 16px;
            }
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="input-panel">
                <h3>Hiring Details Form</h3>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="HiringDetailsForm" action="{{ route('submitHiringDetails') }}" method="POST" class="was-validated" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="team_name" class="form-label">Team Name</label>
                       
                        <input type="text" id="team_name" name="team_name" class="form-control" value="{{ $team_name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="role_name" class="form-label">Role Name</label>
                        <input type="text" id="role_name" name="role_name" class="form-control" value="{{ $role_name }}" readonly>
                    </div>
                    @for ($i = 1; $i <= $requirement_count; $i++)
                    <div class="mb-3">
                    <label for="candidate_name_{{ $i }}">Candidate Name {{ $i }}</label>
                    <input type="text" id="candidate_name_{{ $i }}" name="candidates[{{ $i }}][name]" class="form-control" placeholder="Enter Candidate Name">
                    </div>

                    <div class="mb-3">
                    <label for="joined_date_{{ $i }}">Joining Date {{ $i }}</label>
                    <input type="date" id="joined_date_{{ $i }}" name="candidates[{{ $i }}][joining_date]" class="form-control">
                    </div>
                    @endfor
                    <div class="text-center">
                        <button type="submit" class="btn-custom">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
