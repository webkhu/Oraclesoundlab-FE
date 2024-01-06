<?php

namespace App\Traits;

trait Template
{
    function Template()
    {
        $json_data = file_get_contents(env('API_LINK') . '/api/template');
        $data = json_decode($json_data, true);
        $menus = $data['menu'];
        $setup = $data['setting'];
        foreach ($setup as $set) {
            $template = $set['template'];
        }
        $set_data = [
            'menus' => $menus,
            'template' => $template
        ];
        return $set_data;
    }
}
