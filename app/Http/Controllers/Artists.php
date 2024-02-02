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

        $ch = curl_init(env('API_LINK') . '/api/artists?page=' .$page);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . env('API_URL_ID') . ' ' . env('API_URL_TOKEN')));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }

        curl_close($ch);
        
        $list = json_decode($response);
        $list = $list->artists;

        // Set custom pagination to result set
        $datas =  new LengthAwarePaginator(
            collect($list->data),
            $list->total,
            $perPage,
            $page,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        return view('artists', $this->Template(), [
            'artists' => $datas,
            'crumb1' => 'Artists',
        ]);
    }

    public function artist(string $slug)
    {
        $ch = curl_init(env('API_LINK') . '/api/artist/' . $slug);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . env('API_URL_ID') . ' ' . env('API_URL_TOKEN')));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }

        curl_close($ch);

        return view('artist', $this->Template(), [
            'datas' => json_decode($response)->artist,
            'items' => json_decode($response)->galleries,
            'crumb1' => strtoLower(collect($this->Template()['pages'])->firstWhere('name', 'artists')->link),
            'crumb2' => json_decode($response)->artist->name,
        ]);
    }
}
