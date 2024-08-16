<?php

namespace App\Http\Controllers\Api\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
