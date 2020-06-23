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
    public function store(ProjectStoreRequest $request)
    {
        $data = [
            'name' => $request->name,
            'guid' => Str::random(9),
            'public_key' => Str::random(16),
            'secret_key' => Str::random(64),
        ];

        $Project = Project::create($data);

        ProjectTeam::create([
            'user_id' => $request->user()->id,
            'projet_id' => $Project->id,
            'role' => 1
        ]);

        return 'Done';
    }
}
