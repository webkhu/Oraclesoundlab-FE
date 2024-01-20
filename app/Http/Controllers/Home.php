<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Template;

class Home extends Controller
{
    use Template;
    public function index()
    {
        return view('index', $this->Template());
    }
}
