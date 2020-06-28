<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function show(Request $request, Project $project)
    {
        return view('projects.show')->withProject($project);
    }
}
