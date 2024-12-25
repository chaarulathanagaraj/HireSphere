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
            color: #333;
        }

        .table {
            width: 100%;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #333;
            color: white;
            padding: 10px;
        }

        td {
            text-align: center;
            padding: 10px;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .form-label {
            color: #333;
        }

        .form-control, .form-select {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #333;
            outline: none;
            box-shadow: 0 0 5px rgba(51, 51, 51, 0.3);
        }

        .btn-primary {
            background-color: #333;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #555;
            transform: scale(1.05);
        }

        /* Pagination Styling */
        .pagination .page-link {
            background-color: #f9f9f9;
            border-color: #ccc;
        }

        .pagination .page-link:hover {
            background-color: #333;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #333;
            color: white;
            border-color: #333;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f9f9f9;
            color: #ccc;
        }

        /* Badge Styling */
        .badge {
            font-size: 12px;
            padding: 5px 10px;
        }

        /* Customizing Form Layout */
        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .col-md-5, .col-md-2 {
            padding-right: 15px;
        }

        /* Making the labels consistent */
        label {
            color: #333;
            font-weight: bold;
        }

        /* Row styling for filtering form */
        .filter-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter-col {
            width: 48%;
        }

        .filter-btn {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
    </style>

    <!-- Content goes here -->
    <div class="container">
        <h1>Hired Candidates Details</h1>

        <!-- Filtering form -->
        <form method="GET" action="{{ url('/hired') }}">
            <div class="filter-row">
            <div class="filter-col">
                    <select class="form-control" id="team" name="team" required>
                        <option value="" disabled selected>Select Your Team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team }}">{{ $team }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-col">
                
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    
                  
                </div>
                <div class="filter-col">  <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}"></div>
                <div class="filter-col">
                   
                    <select name="rows" class="form-select">
                        <option value="5" {{ request('rows', 5) == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('rows') == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ request('rows') == 20 ? 'selected' : '' }}>20</option>
                        <option value="25" {{ request('rows') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                        <option value="75" {{ request('rows') == 75 ? 'selected' : '' }}>75</option>
                        <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="filter-btn">Filter</button>
        </form>

        <!-- Hiring details table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Team</th>
                    <th>Role</th>
                    <th>Candidate Name</th>
                    <th>Joined Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hiringData as $row)
                <tr>
                    <td>{{ $row->team_name }}</td>
                    <td>{{ $row->role_name }}</td>
                    <td>{{ $row->candidate_name }}</td>
                    <td>{{ $row->joined_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                @if ($hiringData->currentPage() > 1)
                <li class="page-item"><a class="page-link" href="{{ $hiringData->previousPageUrl() }}">Previous</a></li>
                @else
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                @endif

                <li class="page-item disabled"><span class="page-link">{{ $hiringData->currentPage() }}</span></li>

                @if ($hiringData->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $hiringData->nextPageUrl() }}">Next</a></li>
                @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </nav>
    </div>
</x-app-layout>
