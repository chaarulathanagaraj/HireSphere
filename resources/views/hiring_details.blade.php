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

        /* Customizing Form Layout */
        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .col-md-4 {
            padding-right: 15px;
        }

        /* Align filter button to the right */
        .filter-button {
            display: flex;
            justify-content: flex-end;
        }

        /* Making the labels consistent */
        label {
            color: #333;
            font-weight: bold;
        }
    </style>

    <div class="container">
        <h1>Hired Candidates Details </h1>

        <!-- Filtering form -->
        <form method="GET" action="{{ route('hiring.details') }}">
            <div class="form-row">
                <div class="col-md-4">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                </div>
                <div class="col-md-4">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                </div>
                <div class="col-md-4 filter-button">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
            <div class="mb-3">
                <label for="rows" class="form-label">Rows per page</label>
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
        </form>

        <!-- Requirement details table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Role Name</th>
                    <th>Candidate Name</th>
                    <th>Joining Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hiringData as $detail)
                <tr>
                    <td>{{ $detail->team_name }}</td>
                    <td>{{ $detail->role_name }}</td>
                    <td>{{ $detail->candidate_name }}</td>
                    <td>{{ $detail->joined_date }}</td>
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
