<?php

namespace App\Http\Controllers;

use App\Models\Streamer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class StreamerController extends Controller
{
    // Method to create the OAuth authorization URL and start the authorization process
    public function create()
    {
        // Generate a random state string for security purposes
        $state = Str::random(24);
        session(['state' => $state]); // Store the state in session

        // Construct the Twitch authorization URL
        $url = "https://id.twitch.tv/oauth2/authorize" .
            "?response_type=code" .
            "&force_verify=true" .
            "&client_id=" . config('twitch.client_id') .
            "&redirect_uri=" . route('streamers.twitch-response') .
            "&scope=channel%3Amanage%3Avips+openid" .
            "&state=$state"; // Include the state for verification

        // Return the view with the authorization URL
        return view('streamer.create', ['url' => $url]);
    }

    // Method to handle the response from Twitch after the authorization process
    public function store(Request $request)
    {
        // Verify if the state from the request matches the session state
        if ($request->get('state') !== session('state')) {
            // Clear the session data
            $request->session()->flush();
            return redirect(route('streamers.register'))->with('danger', 'Invalid state.');
        }

        // Clear the session data after successful state verification
        $request->session()->flush();

        // Check for an error in the Twitch response
        if ($request->get('error')) {
            return redirect(route('streamers.register'))->with('danger', $request->get('error_description'));
        }

        // Base URL for Twitch API requests
        $twitchApiBaseUrl = "https://api.twitch.tv/helix";

        // POST request to exchange the authorization code for an access token
        $getUserAccessToken = Http::post('https://id.twitch.tv/oauth2/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('twitch.client_id'),
            'client_secret' => config('twitch.client_secret'),
            'code' => $request->get('code'),
            'redirect_uri' => route('streamers.twitch-response'),
        ]);

        // Decode the JWT token received from Twitch
        $jwt = $getUserAccessToken->json('id_token');
        list($header, $payload, $signature) = explode('.', $jwt);
        $decoded_payload = json_decode($this->base64UrlDecode($payload), true);

        // Extract data from the decoded JWT payload
        $broadcaster_id = $decoded_payload['sub']; // 'sub' represents the user ID of the broadcaster
        $user_access_token = $getUserAccessToken->json("access_token"); // Access token for making API requests

        // GET request to retrieve the Twitch user information
        $getUsers = Http::withHeaders([
            'Authorization' => 'Bearer ' . $user_access_token,
            'Client-Id' => config('twitch.client_id')
        ])->get($twitchApiBaseUrl . '/users', ['id' => $broadcaster_id]);

        if ($getUsers->successful()) {
            // The request was successful
            $twitchInfos = $getUsers->json('data')[0]; // Extract user information from the response

            // Create or update the Streamer record in the database with the retrieved user information
            Streamer::updateOrCreate([
                'login' => $twitchInfos['login'], // Twitch username
                'display_name' => $twitchInfos['display_name'], // Twitch username
                'description' => $twitchInfos['description'], // User description
                'profile_image_url' => $twitchInfos['profile_image_url'], // URL to the user's profile image
            ]);
        } else {
            // The request failed
            return redirect(route('streamers.register'))->with('danger', $getUsers->json('message')());
        }

        // POST request to add a VIP to the broadcaster's channel
        $updateVips = Http::withHeaders([
            'Authorization' => 'Bearer ' . $user_access_token,
            'Client-Id' => config('twitch.client_id')
        ])->post($twitchApiBaseUrl . '/channels/vips', ['broadcaster_id' => $broadcaster_id, 'user_id' => 964806515]);

        if ($updateVips->successful()) {
            // VIP successfully added
            return redirect(route('streamers.register'))->with('success', "Compte ajouté avec succès");
        } else {
            // The VIP update failed
            return redirect(route('streamers.register'))->with('info', $updateVips->json('message'));
        }
    }

    // Helper function to decode a base64 URL-encoded string
    private function base64UrlDecode($input)
    {
        // Ensure the base64 string is properly padded
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $addlen = 4 - $remainder;
            $input .= str_repeat('=', $addlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }
}
