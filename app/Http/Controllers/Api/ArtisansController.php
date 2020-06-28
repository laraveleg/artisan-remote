<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

use App\Http\Requests\ProjectStoreRequest;

use App\Models\{
    Project,
    ProjectTeam,
    ArtisanSent
};

class ArtisansController extends Controller
{
    public function send(Project $project, Request $request)
    {

        $artisan = ArtisanSent::create([
            'projet_id' => $project->id,
            'guid' => Str::random(11),
            'artisan_sent' => $request->artisan
        ]);

        $hash_authorization = hash_hmac('sha256', $project->public_key, $project->secret_key);

        try {
            $response = Http::withHeaders([
                'Authorization' => $hash_authorization,
            ])->post($project->url_listener, [
                'artisan' => $request->artisan,
                'callback_url' => route('artisan.callback', [$artisan->guid])
            ]);
        } catch (\Throwable $th) {
            return[
                'status' => 'warning',
                'message' => 'Error callback URL',
                'data' => [],
            ];
        }

        return[
            'status' => 'success',
            'message' => 'The artisan has been sent to your project',
            'data' => [
                'project_reception_status' => $response->successful() // project reception status to artisan
            ],
        ];
    }

    public function callback(ArtisanSent $ArtisanSent, Request $request)
    {
        \Log::info($request->output);
        $ArtisanSent->artisan_output = $request->output;
        $ArtisanSent->save();
    }
}
