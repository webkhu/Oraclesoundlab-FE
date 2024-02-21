<?php

namespace App\Http\Controllers;

use App\Traits\Template;
use Illuminate\Pagination\LengthAwarePaginator;

class Events extends Controller
{
    //
    use Template;
    public function index()
    {
        $page = request()->has('page') ? request('page') : 1;
        $setting = (object) $this->Template();
        $perPage = $setting->main_page_image;

        $ch = curl_init(env('API_LINK') . '/api/events?page=' . $page);
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
        $list = $list->events;

        // Set custom pagination to result set
        $events =  new LengthAwarePaginator(
            collect($list->data)->sortByDesc('date'),
            $list->total,
            $perPage,
            $page,
            ['path' => request()->url(), 'pageName' => 'page']
        );
        $crumb1 = collect($this->Template()['pages'])->firstWhere('name', 'events')->link;

        return view('events', $this->Template(), compact('events', 'crumb1'));
    }

    public function event(string $slug)
    {
        $ch = curl_init(env('API_LINK') . '/api/event/' . $slug);
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

        $datas = json_decode($response)->events;
        $crumb1 = collect($this->Template()['pages'])->firstWhere('name', 'events')->link;
        $crumb2 = $datas->title;
        $date = $datas->date;

        list($d, $m, $Y) = explode('/', $date);
        if (strtotime($Y . '/' . $m . '/' . $d) > time()) {
            $status = "";
        } else {
            $status = "Past Event";
        }
        $month   = date("F", mktime(0, 0, 0, $m, 10));
        $date = $d . ' ' . $month . ' ' . $Y;

        return view('event', $this->Template(), compact('status', 'date', 'datas', 'crumb1', 'crumb2'));
    }
}
