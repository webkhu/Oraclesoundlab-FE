<?php

namespace App\Http\Controllers;

use App\Traits\Template;
use Illuminate\Pagination\LengthAwarePaginator;

class Releases extends Controller
{
    //
    use Template;
    public function index()
    {
        $releases = null;
        $albumIds = null;

        $page = request()->has('page') ? request('page') : 1;
        $setting = (object) $this->Template();
        $perPage = $setting->main_page_image;

        $ch = curl_init(env('API_LINK') . '/api/releases?page=' . $page);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: ' . base64_encode(env('API_URL_ID') . ' ' . env('API_URL_TOKEN'))
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        curl_close($ch);

        // Check Respose
        if (!empty(@$response)) {
            $spotify_id = json_decode($response)->key->spotify_id;
            $spotify_secret = json_decode($response)->key->spotify_secret;
            $lists = json_decode($response)->list;
            // dd($lists);
            if (!empty(@$lists)) {
                foreach ($lists->data as $list) {
                    $album[] = $list->playlist_id;
                }
                $album = implode(',', $album);
                $albumIds = new LengthAwarePaginator(
                    collect($list->playlist_id),
                    $lists->total,
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'pageName' => 'page']
                );
            }
        }

        // Get Spotify Access Token
        if (!empty(@$album)) {
            session_start();

            if (@$_SESSION['SpotifyToken'] && $_SESSION['DiscardAfter'] <= time()) {
                $_SESSION['SpotifyToken'] = null;
            }

            if (!@$_SESSION['SpotifyToken'] || empty(@$_SESSION['SpotifyToken'])) {

                $ch = curl_init('https://accounts.spotify.com/api/token');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Authorization: Basic ' . base64_encode($spotify_id . ':' . $spotify_secret),
                ]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $response = curl_exec($ch);
                curl_close($ch);

                // Check Respose
                if (!empty(@$response)) {
                    $_SESSION['SpotifyToken'] = json_decode($response)->access_token;
                    $_SESSION['DiscardAfter'] = time() + 3590;
                } else {
                    $_SESSION['SpotifyToken'] = null;
                }
            }

            if (!empty(@$_SESSION['SpotifyToken'])) {
                // Get Spotify Album
                $ch = curl_init('https://api.spotify.com/v1/albums?ids=' . $album);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Authorization: Bearer ' . $_SESSION['SpotifyToken'],
                ]);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $response = curl_exec($ch);
                curl_close($ch);

                // Check Respose
                if (!empty(@$response)) {
                    $releases = json_decode($response)->albums;
                }
            }
        }

        return view('releases', $this->Template(), [
            'crumb1' => strtoLower(collect($this->Template()['pages'])->firstWhere('name', 'releases')->link),
            'releases' => $releases,
            'albumIds' => $albumIds,
        ]);
    }

    public function show($id)
    {
        $albumDetail = null;

        session_start();

        if (@$_SESSION['SpotifyToken'] && $_SESSION['DiscardAfter'] <= time()) {
            $_SESSION['SpotifyToken'] = null;
        }

        if (!@$_SESSION['SpotifyToken'] || empty(@$_SESSION['SpotifyToken'])) {
            $ch = curl_init(env('API_LINK') . '/api/releases');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: ' . base64_encode(env('API_URL_ID') . ' ' . env('API_URL_TOKEN'))
            ]);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            }
            curl_close($ch);

            // Check Respose
            if (!empty(@$response)) {
                $spotify_id = json_decode($response)->key->spotify_id;
                $spotify_secret = json_decode($response)->key->spotify_secret;
            }

            if (!empty(@$spotify_id)) {
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

                // Check Respose
                if (!empty(@$response)) {
                    $_SESSION['SpotifyToken'] = json_decode($response)->access_token;
                    $_SESSION['DiscardAfter'] = time() + 3590;
                }
            }
        }

        if (!empty(@$_SESSION['SpotifyToken'])) {
            // Get Spotify Album Detail
            $ch = curl_init('https://api.spotify.com/v1/albums/' . base64_decode($id));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $_SESSION['SpotifyToken'],
            ]);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            // Check Respose
            if (!empty(@$response)) {
                $albumDetail = json_decode($response);
            }
        }

        return view('releases_album', $this->Template(), [
            'crumb1' => strtoLower(collect($this->Template()['pages'])->firstWhere('name', 'releases')->link),
            'crumb2' => 'Details',
            'albumDetail' => $albumDetail,

            // 'albumId' => base64_decode($id),

        ]);
    }
}
