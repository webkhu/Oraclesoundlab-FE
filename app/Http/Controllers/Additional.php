<?php

namespace App\Http\Controllers;

use App\Traits\Template;

class Additional extends Controller
{
    //
    use Template;
    public function index($page)
    {
        $page = collect($this->Template()['pages'])->firstWhere('name', $page);
        $subpage = collect($this->Template()['subpages'])->firstWhere('name', $page);
        return view('additional', $this->Template(), compact ('page', 'subpage'),[
            'crumb1' => strtoLower($page->link),
        ]);
    }
}
