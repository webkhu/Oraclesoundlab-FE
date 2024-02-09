<?php

namespace App\Http\Controllers;

use App\Traits\Template;

class Additional extends Controller
{
    //
    use Template;
    public function index($page)
    {
        $page = collect(array_merge($this->Template()['pages'], $this->Template()['subpages']))->firstWhere('name', $page);
        return view('additional', $this->Template(), compact ('page'),[
            'crumb1' => strtoLower($page->link),
        ]);
    }
}
