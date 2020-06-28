<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function show(Request $request, Project $project)
    {
        return view('projects.show')->withProject($project);
    }
}
