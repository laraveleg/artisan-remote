<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\ProjectStoreRequest;

use App\Models\{
    Project,
    ProjectTeam
};

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $projects = ProjectTeam::where('user_id', '=', $request->user()->id)->get();

        $_projects = [];
        foreach ($projects as $project) {
            $_projects []= [
                'guid' => $project->project->guid,
                'name' => $project->project->name,
                'url' => route('projects.show', [$project->project->guid])
            ];
        }

        return[
            'status' => 'success',
            'message' => 'Projects index',
            'data' => [
                'projects' => $_projects
            ],
        ];
    }

    public function store(ProjectStoreRequest $request)
    {
        $data = [
            'guid' => Str::random(9),
            'public_key' => Str::random(16),
            'secret_key' => Str::random(64),
            'name' => $request->name,
            'url_listener' => $request->url_listener
        ];

        $Project = Project::create($data);

        ProjectTeam::create([
            'user_id' => $request->user()->id,
            'projet_id' => $Project->id,
            'role' => 1
        ]);

        return[
            'status' => 'success',
            'message' => 'Project added',
            'data' => [],
        ];
    }
}
