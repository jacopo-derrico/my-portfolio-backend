<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with('categories', 'technologies', 'images')->get();

        return response()->json([
            'success' => true,
            'baseUrl' => config('app.url'),
            'projects' => $projects,
        ]);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id)->load('categories', 'technologies', 'images');

        return response()->json([
            'success' => true,
            'project' => $project,
        ]);
    }
}
