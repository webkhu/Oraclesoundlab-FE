<?php

namespace App\Http\Controllers;

use App\Traits\Template;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Aftermovie extends Controller
{
    //
    use Template;
    public function index(Request $request)
    {
        // Set default page
        $page = request()->has('page') ? request('page') : 1;
        $setting = (object) $this->Template();
        $perPage = $setting->main_page_video;
        $page_token = null;
        $playId = null;

        if (request()->query()) {
            $query = (object) request()->query();

            if (@$query->setPage) {
                $page_token = $query->setPage;
            }

            if (collect($query)->has('id')) {
                $playId = $query->id;
            }
        }

        // API WEB
        $ch = curl_init(env('API_LINK') . '/api/aftermovie');
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

        $stream_set = json_decode($response);
        $api_key = $stream_set->key->youtube_key;
        $playlist_id = $stream_set->list->playlist_id;

        $list = "https://www.googleapis.com/youtube/v3/playlistItems?key=" . $api_key . "&playlistId=" . $playlist_id . "&part=snippet&maxResults=" . $perPage . "&pageToken=" . $page_token;

        //API Youtube
        $ch = curl_init($list);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }
        curl_close($ch);

        // Check Respose
        if (@$response === "") {
            die('No data from server.');
        }

        $playList = json_decode($response);
        $crumb1 = collect($setting->pages)->firstWhere('name', 'aftermovie')->link;

        // Set custom pagination to result set
        $datas =  new LengthAwarePaginator(
            collect($playList->items)->flatten(),
            $playList->pageInfo->totalResults,
            $perPage,
            $page,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        // dd($datas);

        if (@$datas) {
            if (@$playList->nextPageToken) {
                $datas->nextPageToken = $playList->nextPageToken;
            } else {
                $datas->nextPageToken = null;
            }
            if (@$playList->prevPageToken) {
                $datas->prevPageToken = $playList->prevPageToken;
            } else {
                $datas->prevPageToken = null;
            }
        }

        // Youtube player
        if (@$playId) {
            $list = "https://www.googleapis.com/youtube/v3/videos?key=" . $api_key . "&part=snippet,player&maxWidth=2000&id=" . $playId;
            $ch = curl_init($list);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            }
            curl_close($ch);

            // Check Respose
            if (@$response === "") {
                die('No data from server.');
            }

            $setToPlay = json_decode($response);
            $setToPlay = $setToPlay->items[0];
        } else {
            $setToPlay = null;
        }

        $datas->playId = $playId;

        return view('aftermovie', $this->Template(), compact('setToPlay', 'datas', 'crumb1'));
    }
}
