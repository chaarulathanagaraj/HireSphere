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
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #ffffff; /* White background */
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
        }

        h1 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #333333;
        }

        .table {
            width: 100%;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #333333; /* Dark grey header */
            color: white;
            padding: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        td {
            text-align: center;
            padding: 10px;
            color: #333333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .form-label {
            color: #333333;
        }

        .form-control, .form-select {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #333333;
            outline: none;
            box-shadow: 0 0 5px rgba(51, 51, 51, 0.3);
        }

        .btn-primary {
            background-color: #333333; /* Primary button color */
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #555555; /* Hover effect */
            transform: scale(1.05);
        }

        /* Grey Button Styling for Accept and Reject */
        .btn-grey {
            background-color: #333333; /* Accept/Reject button color */
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
        }

        .btn-grey:hover {
            background-color: #555555; /* Hover effect for accept/reject */
        }

        /* Pagination Styling */
        .pagination .page-link {
            background-color: #f9f9f9;
            border-color: #333333;
        }

        .pagination .page-link:hover {
            background-color: #333333;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #333333;
            color: white;
            border-color: #333333;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f9f9f9;
            color: #ccc;
        }

        /* Customizing Form Layout */
        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .col-md-4 {
            padding-right: 15px;
        }

        /* Align filter button to the right of rows per page */
        .filter-button {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 10px;
        }

        /* Filter Form Styling */
        .filter-form {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
        }

        /* Making the labels consistent */
        label {
            color: #333333;
            font-weight: bold;
        }

        /* Larger column for accept/reject buttons */
        .action-column {
            width: 25%; /* Increased width */
            text-align: center;
        }

        /* Ensuring button placement */
        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        .small-btn {
    font-size: 0.8rem;  /* Smaller font size */
    padding: 5px 10px;  /* Reduced padding */
    min-width: 100px;    /* Set a min-width to maintain a uniform size */
    height: auto;       /* Adjust height accordingly */
}

    </style>

    <!-- Main Content -->
    <div class="container">
        <h1>Requests</h1>

        <!-- Filtering Form -->
        <form method="GET" action="/requests" class="filter-form">
            <div class="form-row">
                <div class="col-md-4">
                    <select class="form-control" id="team" name="team" required>
                        <option value="" disabled selected>Select Your Team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team }}">{{ $team }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                </div>
                <div class="col-md-4">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                </div>
            </div>
            <div class="mb-3">
               
                <select name="rows" class="form-select">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="75">75</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="col-md-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
            <div class="filter-button">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>

        <!-- Hiring Details Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Team</th>
                    <th>Role</th>
                    <th>Request Date</th>
                    <th>Requirement Count</th>
                    <th>Hired Count</th>
                    <th class="action-column">Actions</th> <!-- Larger column -->
                    <th>Hiring Details Form</th>
                </tr>
            </thead>
            <tbody>
                @foreach($req_data as $row)
                    <tr>
                        <td>{{ $row->team_name }}</td>
                        <td>{{ $row->role_name }}</td>
                        <td>{{ $row->request_date }}</td>
                        <td>{{ $row->requirement_count }}</td>
                        <td>{{$row->hired_count}}</td>
                        
                        <td class="action-column">
    @if($row->status == 'Accepted')
        <span class="status-text">Accepted: {{ $row->status_text }}</span>
    @elseif($row->status == 'Rejected')
        <span class="status-text">Rejected</span>
    @else
        <div class="button-container">
            <form method="POST" action="{{ route('requests.update', $row->id) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="Accepted">
                <button type="submit" class="btn-grey small-btn">Accept</button>
            </form>
            <form method="POST" action="{{ route('requests.update', $row->id) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="Rejected">
                <button type="submit" class="btn-grey small-btn">Reject</button>
            </form>
        </div>
    @endif
</td>

<td>
    @if($row->status == 'Accepted')
        <a href="{{ route('hiringDetailsForm', ['id' => $row->id]) }}" class="btn-primary small-btn">Fill Details</a>
    @endif
</td>

                    </tr>
                    
                @endforeach
                
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-container">
            {{ $req_data->links() }}
        </div>
    </div>
</x-app-layout>
