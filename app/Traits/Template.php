<?php

namespace App\Traits;

trait Template
{
    function Template()
    {
        $ch = curl_init(env('API_LINK') . '/api/template');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . env('API_URL_ID') . ' ' . env('API_URL_TOKEN')));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }

        curl_close($ch);

        if ($response) {
            $data = json_decode($response);

            $currentURL = url()->current();
            $currentURL = explode("/", $currentURL);

            if ($currentURL[3] === 'page'){
                $currentURL = $currentURL[4];
            } else {
                $currentURL = $currentURL[3];
            }

            if (@$currentURL) {
                $title = collect($data->pages)->firstWhere('name', $currentURL)->title;
                if (collect($title)->isEmpty()) {
                    $title = collect($data->subpages)->firstWhere('name', $currentURL)->title;
                    if (collect($title)->isEmpty()) {
                        $title = '';
                    }
                }
            } else {
                $title = '';
            }

            $set_data = [
                'url' => env('APP_URL'),
                'title' => $title,
                'pages' => $data->pages,
                'subpages' => $data->subpages,
                'categories' => $data->categories,
                'template' => $data->setting->template,
                'home_page_image' => $data->setting->home_page_image,
                'home_page_video' => $data->setting->home_page_video,
                'main_page_image' => $data->setting->main_page_image,
                'main_page_video' => $data->setting->main_page_video,
                'active' => isset($currentURL) ? $currentURL : 'index',
            ];
            return $set_data;
        } else {
            echo 'No API response from server.';
        }
    }
}
