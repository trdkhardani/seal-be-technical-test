<?php

namespace App\Http\Controllers\Api\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class ProjectListController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->has('project_status')) {
            $query->where('project_status', $request->project_status);
        }

        $projects = $query->paginate(3);

        foreach ($projects as $project) {
            $projectsData[] = [
                'project_title' => $project->project_title,
                'project_description' => $project->project_description,
                'project_status' => $project->project_status,
            ];
        }

        if($projects->isEmpty()){
            return response()->json([
                'status' => 'error',
                'message' => 'No project(s) found with ' . $request->project_status . ' status'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $projectsData,
            'pagination' => [
                'current_page' => $projects->currentPage(),
                'next_page' => $projects->nextPageUrl(),
                'prev_page' => $projects->previousPageUrl(),
            ],
        ]);
    }

    public function projectDetail($projectId)
    {
        $project = Project::find($projectId);

        if(!$project){
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found'
            ], 404);
        }

        $projectStartDate = date("j F Y", strtotime($project->project_start_date)); // DD-Month-YYYY
        $projectDueDate = date("j F Y", strtotime($project->project_due_date)); // DD-Month-YYYY

        return response()->json([
            'status' => 'success',
            'project_data' => [
                'project_title' => $project->project_title,
                'project_description' => $project->project_description,
                'project_start_date' => $projectStartDate,
                'project_due_date' => $projectDueDate,
                'project_status' => $project->project_status,
            ],
        ]);
    }
}
