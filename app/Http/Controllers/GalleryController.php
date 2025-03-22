<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admIndex()
    {
        $infos = Gallery::paginate(6);
        return $infos;
    }
    public function index()
    {
        $infos = Gallery::paginate(12);
        return $infos;
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
        $imageName = 'image-' . time() . '.png';
        $request->image->move(public_path('assets/img/gallery'), $imageName);
        $postArray['image'] = $imageName;
        if (!isset($message)) {
            $Event = Gallery::create($postArray);
            if (!$Event) {
                $responses = array(
                    'message' => 'An error occurred',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                $responses = array(
                    'message' => 'Gallery Updated',
                    'type' => 'green',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            }
        }
        return json_encode($responses);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $postArray = $request->all();
        if ($request->hasFile('image')) {
            $imageName = 'image-' . time() . '.png';
            $request->image->move(public_path('assets/img/gallery'), $imageName);
            $postArray['image'] = $imageName;
        }

        $update = Gallery::where('gallery_id', '=', $postArray['gallery_id'])->update($postArray);

        if ($update) {

            $responses = array(
                'message' =>  'Gallery updated successfully.',
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
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
