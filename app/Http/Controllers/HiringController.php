<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Role;
use App\Models\HiringDetails;
use App\Models\Requirement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HiringController extends Controller
{
    //
    public function hired(Request $request)
    {
        try {
            // Get the number of rows per page and the current page
            $rowsPerPage = $request->get('rows', 5); // Default to 5 rows per page
            $page = $request->get('page', 1); // Default to page 1 if not specified
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            $team = $request->get('team'); 
           
        
            // Build the query for HiringDetails without using team_id or role_id
            $query = HiringDetails::query()
                ->select(
                    'team_name',
                    'role_name',
                    'candidate_name',
                    DB::raw('DATE_FORMAT(joined_date, "%Y-%m-%d") as joined_date')
                ) ;
                if ($team) {
                    $query->where('team_name', $team); // Filter by team_name
                }
        
            // Apply date filters if provided
            if ($startDate && $endDate) {
                $query->whereBetween('joined_date', [$startDate, $endDate]); // Filter based on joined_date
            }
        
            // Get paginated data
            $hiringData = $query->paginate($rowsPerPage);
        
            // Get the list of distinct team names for dropdown (if needed)
            $teams = HiringDetails::distinct()->pluck('team_name');
        
            return view('hired', [
                'hiringData' => $hiringData,
                'teams' => $teams,
                'currentPage' => $page,
                'totalPages' => $hiringData->lastPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }
    
    public function index(Request $request)
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
            $query = HiringDetails::where('team_name', $userName);

            // Apply date filters if provided
            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]); // Using `created_at` as request_date
            }

            // Get paginated data
            $hiringData = $query->select(
                    'team_name',
                    'role_name',
                    'candidate_name',
                    DB::raw('DATE_FORMAT(joined_date, "%Y-%m-%d") as joined_date')
                   
                )
                ->paginate($rowsPerPage);

            // Get the list of distinct team names for dropdown (if needed)
            $teams = HiringDetails::distinct()->pluck('team_name');

            return view('hiring_details', [
                'hiringData' => $hiringData,
                'teams' => $teams,
                'currentPage' => $page,
                'totalPages' => $hiringData->lastPage(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function hiringDetailsForm($id =null)
    {
        $requestData = Requirement::find($id); // Replace RequestModel with your actual model name
    
        if (!$requestData) {
            return redirect()->route('requests.index')->with('error', 'Request not found.');
        }
    
        return view('hiring_details_form', [
            'team_name' => $requestData->team_name,
            'role_name' => $requestData->role_name,
            'requirement_count' => $requestData->requirement_count,
        ]);
    }
    
    public function submitHiringDetails(Request $request)
    {
        $request->validate([
            'team_name' => 'required|string',
            'role_name' => 'required|string',
            'candidates' => 'required|array',
            'candidates.*.name' => 'nullable|string|max:255',
            'candidates.*.joining_date' => 'nullable|date',
        ]);

        $teamName = $request->team_name;
        $roleName = $request->role_name;
        $candidates = $request->candidates;

        $hiredCount = 0;

        // Process each candidate
        foreach ($candidates as $candidate) {
            // Insert into HiringDetails
            HiringDetails::create([
                'team_name' => $teamName,
                'role_name' => $roleName,
                'candidate_name' => $candidate['name'],
                'joined_date' => $candidate['joining_date'],
            ]);
            if (!empty($candidate['name']) && !empty($candidate['joining_date'])) {
            $hiredCount++;
            }
        }

        // Update the hired_count for the specific team and role in the Requirements table
        $requirement = Requirement::where('team_name', $teamName)
            ->where('role_name', $roleName)
            ->first();

        if ($requirement) {
            $requirement->hired_count += $hiredCount;
            $requirement->save();
        } else {
            return redirect()->back()->withErrors(['error' => 'No matching requirement found for this team and role.']);
        }

        return redirect()->route('dashboard')->with('success', "$hiredCount candidate(s) hired successfully!");
    
}


}