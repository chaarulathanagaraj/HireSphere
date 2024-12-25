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
    </style>

    <div class="container" >
    @if (session('success'))
    <div class="alert alert-success" style="color:green">
        {{ session('success') }}
    </div>
@endif

        <h1>Request Details</h1>

        <!-- Filtering form -->
        <form method="GET" action="{{ route('req_details') }}">
       
            <div class="form-row mb-3">
          
                <div class="col-md-3">
                    <label for="start_date">Start</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Start Date">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="End Date">
                </div>
                <div class="col-md-3">
                    
                    <select name="rows" id="rows" class="form-select">
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
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Requirement details table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Role Name</th>
                    <th>Request Date</th>
                    <th>Required Count</th>
                    <th>Hired Count</th>
                    <th>Status</th>
                    <th>Action</th>
                   
                </tr>
            </thead>
            
                @foreach ($requirementData as $detail)
                <tr>
                    <td>{{ $detail->team_name }}</td>
                    <td>{{ $detail->role_name }}</td>
                    <td>{{ $detail->request_date }}</td>
                    <td>{{ $detail->requirement_count }}</td>
                    <td>{{$detail->hired_count}}</td>
                    <td>{{ $detail->status }}</td>
                    <td>
                    <div style="background-color: #333333; padding: 15px; margin: 10px 0; border-radius: 8px; color: #fff;">
                <form method="POST" action="{{ route('req_details.destroy', $detail->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this request?')">Delete</button>
                </form>
            </td>
                </tr>
                @endforeach
    </div>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                @if ($requirementData->currentPage() > 1)
                <li class="page-item"><a class="page-link" href="{{ $requirementData->previousPageUrl() }}">Previous</a></li>
                @else
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                @endif

                <li class="page-item disabled"><span class="page-link">{{ $requirementData->currentPage() }}</span></li>

                @if ($requirementData->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $requirementData->nextPageUrl() }}">Next</a></li>
                @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </nav>
    </div>
</x-app-layout>
