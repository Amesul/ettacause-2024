<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TwitchAccessToken;
use App\Models\Streamer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class AdminStreamerController extends Controller
{
    public function index()
    {
        return view('dashboard.streamers.index', [
            'streamers' => Streamer::orderBy('login')->get(),
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function store(Request $request)
    {
        $twitch = new Client([
            'base_uri' => 'https://api.twitch.tv/helix/',
            'headers' => [
                'Authorization' => ' Bearer ' . TwitchAccessToken::get(),
                'Client-Id' => config('twitch.client_id'),
            ]
        ]);

        $validated = $request->validate([
            'login' => ['required'],
        ]);
        $logins = explode(",", $validated['login']);

        foreach ($logins as $login) {
            if ($login) {
                $res = $twitch->get('users?login=' . trim($login));
                $decodedRes = json_decode($res->getBody()->getContents(), true)['data'];
                if (!empty($decodedRes)) {
                    $user = $decodedRes[0];

                    Streamer::updateOrCreate([
                        'login' => $user['login'],
                        'display_name' => $user['display_name'],
                        'description' => $user['description'],
                        'profile_image_url' => $user['profile_image_url']
                    ]);
                } else {
                    return back()->with('danger', 'Un compte n\'existe pas.');

                }
            }
        }
        return back()->with('success', 'Participant·e ajouté·e.');
    }

    public function update(Request $request, Streamer $streamer)
    {
        $validated = $request->validate([
            'login' => ['required'],
        ]);

        $streamer->update($validated);

        return $streamer;
    }

    public function destroy(Streamer $streamer)
    {
        $streamer->delete();
        return back()->with('danger', 'Participant·e supprimé·e.');
    }
}
