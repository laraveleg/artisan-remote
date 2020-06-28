<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ArtisanSent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ArtisansController extends Controller
{
    public function send(Project $project, Request $request)
    {

        $artisan = ArtisanSent::create([
            'projet_id' => $project->id,
            'guid' => Str::random(11),
            'artisan_sent' => $request->artisan,
        ]);

        $hash_authorization = hash_hmac('sha256', $project->public_key, $project->secret_key);

        try {
            $response = Http::withHeaders([
                'Authorization' => $hash_authorization,
            ])->post($project->url_listener, [
                'artisan' => $request->artisan,
                'callback_url' => route('artisan.callback', [$artisan->guid]),
            ]);
        } catch (\Throwable $th) {
            return[
                'status' => 'warning',
                'message' => 'Error callback URL',
                'data' => [],
            ];
        }

        $check_received = ($response->successful()) ? ' - The artisan was received on the server' : ' - The artisan was not received on the server';

        return[
            'status' => ($response->successful()) ? 'success' : 'warning',
            'message' => 'The artisan has been sent to your project'.$check_received,
            'data' => [
                'project_reception_status' => $response->successful(), // project reception status to artisan
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
