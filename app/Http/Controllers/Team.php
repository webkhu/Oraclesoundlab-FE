<?php

namespace App\Http\Controllers;

use App\Traits\Template;

class Team extends Controller
{
    //
    use Template;
    public function index()
    {
        $ch = curl_init(env('API_LINK') . '/api/team');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . base64_encode(env('API_URL_ID') . ' ' . env('API_URL_TOKEN'))));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        curl_close($ch);

        if (@$response === "") {
            die('No data from server.');
        }

        return view('team', $this->Template(), [
            'teams' => json_decode($response)->teams,
            'crumb1' => strtoLower(collect($this->Template()['pages'])->firstWhere('name', 'team')->link),
        ]);
    }
}
