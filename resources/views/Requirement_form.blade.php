<x-app-layout>
    <x-slot name="header">
        <!-- Header content if needed -->
    </x-slot>

    <style>
        /* General Body Styling */
        body {
            font-family: "Montserrat", sans-serif;
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
            
                <h3>Requirement Details Form</h3>
                <form id="RequestForm" action="/submit" class="was-validated" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
    <label for="team_name" class="form-label">Team Name</label>
    <select class="form-control" id="team_name" name="team_name" required>
        <option value="{{ auth()->user()->name }}" selected>{{ auth()->user()->name }}</option>
       
    </select>
</div>
                    <div class="mb-3">
                        <label for="role_name" class="form-label">Role Name</label>
                        <select class="form-control" id="role_name" name="role_name" required>
                            <option value="" disabled selected>Select a Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="requirement_count" class="form-label">Requirement Count</label>
                        <select class="form-control" id="requirement_count" name="requirement_count" required>
                            @for ($count = 1; $count <= 10; $count++)
                                <option value="{{ $count }}">{{ $count }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" id="submitButton" class="btn-custom">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
