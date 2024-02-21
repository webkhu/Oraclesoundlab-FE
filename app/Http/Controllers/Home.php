<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Template;

class Home extends Controller
{
    use Template;

    public function index()
    {
        //Set Variable
        $carousel = null;
        $page_title = null;
        $streaming = null;
        $release = null;
        $releases = null;
        $events = null;

        // Carousel
        $carousel = curl_init(env('API_LINK') . '/api/carousel');
        curl_setopt($carousel, CURLOPT_HTTPHEADER, array('Authorization: ' . base64_encode(env('API_URL_ID') . ' ' . env('API_URL_TOKEN'))));
        curl_setopt($carousel, CURLOPT_RETURNTRANSFER, true);
        $carousel_response = curl_exec($carousel);
        if (curl_errno($carousel)) {
            echo 'Error: ' . curl_error($carousel);
        }
        curl_close($carousel);

        if (!empty(@$carousel_response)) {
            $carousel = json_decode($carousel_response)->carousel;
        }

        // Get data for home page
        $datas = curl_init(env('API_LINK') . '/api/home');
        curl_setopt($datas, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($datas, CURLOPT_HTTPHEADER, array('Authorization: ' . base64_encode(env('API_URL_ID') . ' ' . env('API_URL_TOKEN'))));
        $datas_response = curl_exec($datas);
        if (curl_errno($datas)) {
            echo 'Error: ' . curl_error($datas);
        }
        curl_close($datas);

        if (!empty(@$datas_response)) {
            $setting = json_decode($datas_response)->setting; // Display image settings & API data
            $home_page_video = $setting->home_page_video;
            $page_title = collect(json_decode($datas_response)->page_title);
            $artists = json_decode($datas_response)->artists;
            $article = json_decode($datas_response)->article;
            $streaming = json_decode($datas_response)->streaming;
            $release = json_decode($datas_response)->release;
            $events = collect(json_decode($datas_response)->events)->sortByDesc('date');
        }

        // Get youtube Data
        if (!empty(@$streaming)) {
            $api_key = $setting->youtube_key;
            $playlist_id = $streaming->playlist_id;

            $list = "https://www.googleapis.com/youtube/v3/playlistItems?key=" . $api_key . "&playlistId=" . $playlist_id . "&part=snippet&maxResults=" . $home_page_video;

            $ch = curl_init($list);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $youtube_response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            }
            curl_close($ch);

            if (!empty(@$youtube_response)) {
                // $playList = json_decode($youtube_response);
                $streaming = collect(json_decode($youtube_response)->items)->flatten();
            }
        }

        //Get Releases (Sportify)
        if (!empty(@$release)) {
            foreach ($release as $list) {
                $album[] = $list->playlist_id;
            }
            $albumIds = implode(',', $album);

            // Get Access Token
            session_start();

            if (@$_SESSION['SpotifyToken'] && @$_SESSION['DiscardAfter'] <= time()) {
                $_SESSION['SpotifyToken'] = null;
            }

            if (!@$_SESSION['SpotifyToken'] || @$_SESSION['SpotifyToken'] === null) {

                $ch = curl_init('https://accounts.spotify.com/api/token');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Authorization: Basic ' . base64_encode($setting->spotify_id . ':' . $setting->spotify_secret),
                ]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $secret_response = curl_exec($ch);
                curl_close($ch);

                // Check Respose
                if (@$secret_response === "") {
                    die('No data from server.');
                } else {
                    $_SESSION['SpotifyToken'] = json_decode($secret_response)->access_token;
                    $_SESSION['DiscardAfter'] = time() + 3590;
                }
            }

            // Get Album
            $ch = curl_init('https://api.spotify.com/v1/albums?ids=' . $albumIds);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $_SESSION['SpotifyToken'],
            ]);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $spotify_response = curl_exec($ch);
            curl_close($ch);
            // Check Respose
            if (!empty(@$spotify_response)) {
                $releases = collect(json_decode($spotify_response)->albums)->shuffle();
            }
        }

        return view('index', $this->Template(), compact('carousel', 'page_title', 'artists', 'article', 'streaming', 'releases', 'events'));
    }
}
