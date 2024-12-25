<?php

namespace App\Http\Controllers;

use App\Models\HiringDetails;
use Illuminate\Http\Request;
use App\Models\Requirement;

use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
    



class RequirementController extends Controller
{
    public function updateRequestStatus(Request $request, $id)
{
    // Validate the status value (Optional)
    $request->validate([
        'status' => 'required',
    ]);

    // Find the request by the given ID
    $requestData = Requirement::findOrFail($id);

    // Update the status of the request
    $requestData->status = $request->status;
    $requestData->save();

    // Redirect back to the request page with a success message
    return redirect()->route('requests')->with('status', 'Request status updated successfully!');
}

public function requests(Request $request)
{
    try {
        // Get pagination parameters and filters from request
        $rowsPerPage = $request->get('rows', 10); // Default to 10 rows per page
        $teamFilter = $request->get('team', null);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Build the query
        $query = Requirement::select(
            'id',
            'team_name',
            'role_name',
            DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as request_date'),
            'requirement_count',
            'hired_count',
            'status'
        );

        // Apply filters if provided
        if (!empty($teamFilter)) {
            $query->where('team_name', $teamFilter);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Add pagination
        $req_data = $query->paginate($rowsPerPage);
      

        // Calculate status_text for each request
        foreach ($req_data as $req) {
            if ($req->hired_count === 0) {
                $req->status_text = 'Not Started';
            } elseif ($req->hired_count < $req->requirement_count) {
                $req->status_text = 'Partially Completed';
            } else {
                $req->status_text = 'Completed';
            }
        }
         
        // Get the list of distinct team names for the dropdown
        $teams = Requirement::distinct()->pluck('team_name');
        $statuses = Requirement::distinct()->pluck('status');
        // Return view with paginated data and team list
        return view('request_allteams', [
            'req_data' => $req_data,
            'teams' => $teams,
            'statuses' => $statuses,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    
    public function reqDetails(Request $request)
    {
        try {
            // Get the authenticated user's team name
            $userName = strtolower(Auth::user()->name);
    
            if (!$userName) {
                return redirect()->route('login'); // Redirect to login if user is not authenticated
            }
    
            // Pagination and filtering parameters
            $rowsPerPage = $request->get('rows', 5); // Default to 5 rows per page
            $page = $request->get('page', 1); // Default to page 1 if not specified
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
    
            // Build the query
            $query = Requirement::where('team_name', $userName);
    
            // Apply date filters if provided
            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]); // Using `created_at` as request_date
            }
    
            // Apply status filter
            if ($request->has('status') && $request->status != '') {
                $query->where('status', $request->status);
            }
    
            // Get paginated data
            $requirementData = $query->select(
                'id',
                'team_name',
                'role_name',
                DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as request_date'), // Formatting `created_at` as `request_date`
                'requirement_count','hired_count',
                DB::raw('COALESCE(status, "submitted") as status')
            )->paginate($rowsPerPage);
    
            // Fetch distinct statuses
            $statuses = Requirement::distinct()->pluck('status');
    
            // Fetch distinct teams (if needed for other dropdowns)
            $teams = Requirement::distinct()->pluck('team_name');
    
            // Return the view with required data
            return view('requestdetails', [
                'requirementData' => $requirementData,
                'teams' => $teams,
                'statuses' => $statuses,
                'currentPage' => $page,
                'totalPages' => $requirementData->lastPage(),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    public function submit(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'team_name' => 'required|string|max:255',
            'role_name' => 'required|string|max:255',
            'requirement_count' => 'required|integer|min:1|max:10',
        ]);
       

        // Check if the user's name matches the team name
     

        // If the validation passes, proceed with submission logic
        // Example: Save to the database
        
        $data = $request->all();
        
        // Mass assigment
        Requirement::create($data);
        

            // Return a JSON response for the fetch API
            return redirect()
            ->route('dashboard')
            ->with('success','Submmitted successfully!');
            
}
public function destroy($id)
{
    $requirement = Requirement::findOrFail($id);
    $requirement->delete();

    return redirect()->route('req_details')->with('success', 'Request deleted successfully.');
}


}

