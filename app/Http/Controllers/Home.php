<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Template;

class Home extends Controller
{
    use Template;

    public function index()
    {
        // Carousel
        $carousel = curl_init(env('API_LINK') . '/api/carousel');
        curl_setopt($carousel, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($carousel, CURLOPT_HTTPHEADER, array('Authorization: ' . env('API_URL_ID') . ' ' . env('API_URL_TOKEN')));
        $carousel_response = curl_exec($carousel);
        if (curl_errno($carousel)) {
            echo 'Error: ' . curl_error($carousel);
        }
        curl_close($carousel);

        // Get data for home page
        $datas = curl_init(env('API_LINK') . '/api/home');
        curl_setopt($datas, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($datas, CURLOPT_HTTPHEADER, array('Authorization: ' . env('API_URL_ID') . ' ' . env('API_URL_TOKEN')));
        $datas_response = curl_exec($datas);
        if (curl_errno($datas)) {
            echo 'Error: ' . curl_error($datas);
        }
        curl_close($datas);

        $setting = json_decode($datas_response)->setting;        
        $home_page_video = $setting->home_page_video;
        $streaming = json_decode($datas_response)->streaming;

        if (@$streaming) {
            $api_key = $streaming->api_key;
            $playlist_id = $streaming->playlist_id;

            $list = "https://www.googleapis.com/youtube/v3/playlistItems?key=" . $api_key . "&playlistId=" . $playlist_id . "&part=snippet&maxResults=" . $home_page_video;

            //API Youtube
            $ch = curl_init($list);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            }
            curl_close($ch);

            $playList = json_decode($response);
        } else {
            $playList = null;
        }

        // $page_title = collect(json_decode($datas_response)->page_title);
        // @dd($playList);

        return view('index', $this->Template(), [
            'carousel' => json_decode($carousel_response)->carousel,
            'page_title' => collect(json_decode($datas_response)->page_title),
            'artists' => json_decode($datas_response)->artists,
            'streaming' => collect($playList->items)->flatten(),
        ]);
    }
}
