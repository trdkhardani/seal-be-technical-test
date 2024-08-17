<?php

namespace App\Http\Controllers\Api\ProjectManager;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteProjectController extends Controller
{
    public function deleteProject($projectId)
    {
        $project = Project::find($projectId);

        if(!$project){
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found',
            ], 404);
        }

        $project->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Project deleted successfully'
        ]);
    }
}
