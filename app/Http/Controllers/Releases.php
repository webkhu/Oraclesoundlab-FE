<?php

namespace App\Http\Controllers;

use App\Traits\Template;

class Releases extends Controller
{
    //
    use Template;
    public function index()
    {
        $ch = curl_init(env('API_LINK') . '/api/releases');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: ' . env('API_URL_ID') . ' ' . env('API_URL_TOKEN')
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        curl_close($ch);

        $spotify_id = json_decode($response)->key->spotify_id;
        $spotify_secret = json_decode($response)->key->spotify_secret;

        $lists = json_decode($response)->list;
        foreach ($lists as $list) {
            $album[] = $list->playlist_id;
        }
        $albumIds = implode(',', $album);

        // Get Spotify Access Token
        session_start();

        if (@$_SESSION['SpotifyToken'] && $_SESSION['DiscardAfter']) {
            $_SESSION['SpotifyToken'] = null;
        }

        if (!@$_SESSION['SpotifyToken'] || $_SESSION['SpotifyToken'] === null) {

            $ch = curl_init('https://accounts.spotify.com/api/token');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Basic ' . base64_encode($spotify_id . ':' . $spotify_secret),
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            curl_close($ch);

            // dd(json_decode($response));

            $_SESSION['SpotifyToken'] = json_decode($response)->access_token;
            $_SESSION['DiscardAfter'] = time() + 3590;
        }

        // Get Spotify Album
        $ch = curl_init('https://api.spotify.com/v1/albums?ids=' . $albumIds);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $_SESSION['SpotifyToken'],
        ]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $releases = json_decode($response)->albums;

        // dd($releases);

        return view('releases', $this->Template(), [
            'crumb1' => strtoLower(collect($this->Template()['pages'])->firstWhere('name', 'releases')->link),
            'releases' => $releases,

        ]);
    }

    public function show($id)
    {
        session_start();

        if (@$_SESSION['SpotifyToken'] && $_SESSION['DiscardAfter']) {
            $_SESSION['SpotifyToken'] = null;
        }

        if (!@$_SESSION['SpotifyToken'] || $_SESSION['SpotifyToken'] === null) {
            $ch = curl_init(env('API_LINK') . '/api/releases');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: ' . env('API_URL_ID') . ' ' . env('API_URL_TOKEN')
            ]);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            }
            curl_close($ch);

            $spotify_id = json_decode($response)->key->spotify_id;
            $spotify_secret = json_decode($response)->key->spotify_secret;

            // Get Spotify Access Token
            $ch = curl_init('https://accounts.spotify.com/api/token');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Basic ' . base64_encode($spotify_id . ':' . $spotify_secret),
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            curl_close($ch);

            $_SESSION['SpotifyToken'] = json_decode($response)->access_token;
            $_SESSION['DiscardAfter'] = time() + 3590;
        }

        // Get Spotify Album Detail
        $ch = curl_init('https://api.spotify.com/v1/albums/' . base64_decode($id));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $_SESSION['SpotifyToken'],
        ]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $albumDetail = json_decode($response);
        // dd($albumDetail);

        return view('releases_album', $this->Template(), [
            'crumb1' => strtoLower(collect($this->Template()['pages'])->firstWhere('name', 'releases')->link),
            'crumb2' => 'Details',
            'albumDetail' => $albumDetail,
            
            // 'albumId' => base64_decode($id),

        ]);
    }
}
