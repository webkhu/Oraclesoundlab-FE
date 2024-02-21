<?php

namespace App\Http\Controllers;

use App\Traits\Template;
use Illuminate\Pagination\LengthAwarePaginator;

class Artists extends Controller
{
    //
    use Template;
    public function index()
    {
        $page = request()->has('page') ? request('page') : 1;
        $setting = (object) $this->Template();
        $perPage = $setting->main_page_image;

        $ch = curl_init(env('API_LINK') . '/api/artists?page=' . $page);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . base64_encode(env('API_URL_ID') . ' ' . env('API_URL_TOKEN'))));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        curl_close($ch);

        // Check Respose
        if (!empty(@$response)) {
            $list = json_decode($response);
            $list = $list->artists;
        }

        if (!empty(@$list)) {
            // Set custom pagination to result set
            $artists =  new LengthAwarePaginator(
                collect($list->data)->sortBy('name'),
                $list->total,
                $perPage,
                $page,
                ['path' => request()->url(), 'pageName' => 'page']
            );
        } else {
            $artists = null;
        }
        
        $crumb1 = collect($this->Template()['pages'])->firstWhere('name', 'artists')->link;
        
        return view('artists', $this->Template(), compact('artists', 'crumb1'));
    }

    public function artist(string $slug)
    {
        $ch = curl_init(env('API_LINK') . '/api/artist/' . $slug);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . base64_encode(env('API_URL_ID') . ' ' . env('API_URL_TOKEN'))));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        curl_close($ch);

        // Check Respose
        if (@$response === "") {
            die('No data from server.');
        }

        return view('artist', $this->Template(), [
            'datas' => json_decode($response)->artist,
            'items' => json_decode($response)->galleries,
            'crumb1' => collect($this->Template()['pages'])->firstWhere('name', 'artists')->link,
            'crumb2' => json_decode($response)->artist->name,
        ]);
    }
}
