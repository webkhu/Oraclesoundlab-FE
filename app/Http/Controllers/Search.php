<?php

namespace App\Http\Controllers;

use App\Traits\Template;
use Illuminate\Http\Request;

class Search extends Controller
{
    //
    use Template;

    public function index(request $request)
    {
        $ch = curl_init(env('API_LINK') . '/api/search/' . $request->search);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . base64_encode(env('API_URL_ID') . ' ' . env('API_URL_TOKEN'))));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        curl_close($ch);

        // Check Respose
        if (!empty(@$response)) {
            $page_title = collect(json_decode($response)->page_title);
            $artists = json_decode($response)->artists;
            $events = json_decode($response)->events;
            $articles = json_decode($response)->articles;
        }

        return view('Search', $this->Template(), compact('page_title', 'artists', 'events', 'articles'));
    }
}
