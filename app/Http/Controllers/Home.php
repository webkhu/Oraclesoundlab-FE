<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Template;

class Home extends Controller
{
    use Template;
    public function index()
    {
        // dd(collect($this->Template()['pages'])->flatten()->where('id',7));
        return view('index', $this->Template());
    }
}
