<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Streamer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\View;

class DisplayController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function index()
    {
        $this->streamersUpdate();
        return view('assets.display', ['streamers' => Streamer::orderBy('login')->get(), 'event' => Event::firstWhere('date', ">", now()->addHour()),]);
    }

    /**
     * @throws GuzzleException
     */
    public function streamersUpdate()
    {
        $twitch = new Client([
            'base_uri' => 'https://api.twitch.tv/helix/',
            'headers' => [
                'Authorization' => ' Bearer ' . TwitchAccessToken::get(),
                'Client-Id' => config('twitch.client_id'),
            ]
        ]);

        $streamers = Streamer::all();
        $query = '';

        foreach ($streamers as $streamer) {
            $streamer->update(['title' => '', 'online' => false]);
            $query = $query . '&user_login=' . $streamer->login;
        }

        $res = $twitch->get('streams?' . $query);
        $streams = json_decode($res->getBody()->getContents(), true)['data'];
        foreach ($streams as $stream) {
            $streamer = $streamers->where('login', $stream['user_login'])->firstOrFail();
            $streamer->update(['title' => $stream['title'], 'online' => true]);
        }
        return View::make("assets.partials.streamers", ['streamers' => Streamer::orderBy('login')->get()])->render();
    }

    public function eventUpdate()
    {
        return View::make("assets.partials.event", ['event' => Event::firstWhere('date', ">", now()->addHours(1)),])->render();
    }

    private function getClosest($search, $arr)
    {
        $closest = null;
        foreach ($arr as $item) {
            if ($closest === null || abs($search - $closest) > abs($item - $search)) {
                $closest = $item;
            }
        }
        return $closest;
    }
}

