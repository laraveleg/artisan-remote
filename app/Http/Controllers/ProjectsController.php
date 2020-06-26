<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\ProjectStoreRequest;

use App\Models\{
    Project,
    ProjectTeam
};

class ProjectsController extends Controller
{
    public function show(Project $project)
    {
        return view('projects.show')->withProject($project);
    }
}
