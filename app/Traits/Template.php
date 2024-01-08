<?php

namespace App\Traits;

trait Template
{
    function Template()
    {
        $json_data = file_get_contents(env('API_LINK') . '/api/template');
        $data = json_decode($json_data);
        $setup = $data->setting;
        foreach ($setup as $set) {
            $template = $set->template;
        }
        
        $currentURL = url()->current();
        $currentURL = explode("/", $currentURL);

        $set_data = [
            'url' => env('APP_URL'),
            'pages' => $data->pages,
            'subpages' => $data->subpages,
            'template' => $template,
            'active' => isset($currentURL[3])?$currentURL[3]:'index',
        ];
        return $set_data;
    }
}
