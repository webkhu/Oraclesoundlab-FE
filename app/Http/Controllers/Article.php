<?php

namespace App\Http\Controllers;

use App\Traits\Template;

class Article extends Controller
{
    //
    use Template;
    public function index()
    {
        $ch = curl_init(env('API_LINK') . '/api/articles');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . env('API_URL_ID') . ' ' . env('API_URL_TOKEN')));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }

        curl_close($ch);

        return view('article', $this->Template(), [
            'articles' => json_decode($response)->teams,
            'crumb1' => 'Team',
        ]);
    }
}
