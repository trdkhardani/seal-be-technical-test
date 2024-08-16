<?php

namespace App\Http\Controllers\Api\ProjectManager;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class CreateProjectController extends Controller
{
    public function createProject(Request $request)
    {
        $projectData = $request->validate([
            'project_title' => ['required'],
            'project_description' => ['required'],
            'project_start_date' => ['required'],
            'project_due_date' => ['required'],
            'project_status' => [],
        ]);

        $projectData['project_status'] = 'in progress';

        Project::create($projectData);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully added project: ' . $request->project_title
        ]);
    }
}
