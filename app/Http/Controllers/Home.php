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

        // Artists
        $artists = curl_init(env('API_LINK') . '/api/artists');
        curl_setopt($artists, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($artists, CURLOPT_HTTPHEADER, array('Authorization: ' . env('API_URL_ID') . ' ' . env('API_URL_TOKEN')));
        $artists_response = curl_exec($artists);
        if (curl_errno($artists)) {
            echo 'Error: ' . curl_error($artists);
        }
        curl_close($artists);
        $artists = json_decode($artists_response)->artists;
        shuffle($artists);

        return view('index', $this->Template(), [
            'carousel' => json_decode($carousel_response)->carousel,
            'artists' => array_slice($artists, 0, $this->Template()['home_page']),
        ]);
    }
}
