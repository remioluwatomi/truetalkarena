<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Video::orderBy('video_id', 'DESC')
            ->paginate(8);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postArray = $request->all();
        if (!isset($message)) {
            $count = Video::where('video_title', '=', $postArray['video_title'])->count();
            // $count = $query->num_rows;
            if ($count != 0) {
                $message = "Video already exist.";
                $responses = array(
                    'message' => 'Video already exist.',
                    'type' => 'orange',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                );
            }
        }
        if (!isset($message)) {
            $count = Video::where('video_url', '=', $postArray['video_url'])->count();
            // $count = $query->num_rows;
            if ($count != 0) {
                $message = "Video link already exist.";
                $responses = array(
                    'message' => 'Video already exist.',
                    'type' => 'orange',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                );
            }
        }

        if (!isset($message)) {
            $Video = Video::create($postArray);
            if ($Video) {
                $responses = array(
                    'message' => 'Video created successfully.',
                    'type' => 'green',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                $responses = array(
                    'message' => 'Sorry! An error occured',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Sorry'
                );
            }
        }
        return json_encode($responses);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $postArray = $request->all();
        $update = Video::where('video_id', '=', $postArray['video_id'])->update($postArray);

        if ($update) {

            $responses = array(
                'message' => 'Video updated successfully.',
                'type' => 'green',
                'icon' => 'fa-check-circle',
                'title' => 'Thank you'
            );
        } else {
            $responses = array(
                'message' => 'Sorry! An error occured',
                'type' => 'red',
                'icon' => 'fa-check-circle',
                'title' => 'Sorry'
            );
        }
        return json_encode($responses);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
