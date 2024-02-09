<?php

namespace App\Http\Controllers;

use App\Traits\Template;
use Illuminate\Pagination\LengthAwarePaginator;

class Article extends Controller
{
    //
    use Template;
    public function index()
    {
        $page = request()->has('page') ? request('page') : 1;
        $setting = (object) $this->Template();
        $perPage = $setting->main_page_image;

        $ch = curl_init(env('API_LINK') . '/api/article?page=' . $page);
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

        $list = json_decode($response);
        $list = $list->articles;

        // Set custom pagination to result set
        $datas =  new LengthAwarePaginator(
            collect($list->data),
            $list->total,
            $perPage,
            $page,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        return view('articles', $this->Template(), [
            'articles' => $datas,
            'crumb1' => 'Team',
        ]);
    }

    public function article(string $slug)
    {
        $ch = curl_init(env('API_LINK') . '/api/article/' . $slug);
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

        return view('article', $this->Template(), [
            'datas' => json_decode($response)->article,
            'items' => json_decode($response)->galleries,
            'crumb1' => strtoLower(collect($this->Template()['pages'])->firstWhere('name', 'article')->link),
            'crumb2' => json_decode($response)->article->title,
        ]);
    }
}
