<?php

namespace App\Http\Controllers\Api\ProjectManager;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateProjectController extends Controller
{
    public function updateProject(Request $request, $projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found'
            ], 404);
        }

        $projectData = $request->validate([
            'project_title' => ['required'],
            'project_description' => ['required'],
            'project_start_date' => ['required'],
            'project_due_date' => ['required'],
        ]);

        $project->update($projectData);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully updated project: ' . $request->project_title,
        ]);
    }
}
