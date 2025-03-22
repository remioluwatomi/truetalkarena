<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Advert::orderBy('advert_id', 'DESC')
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
        $imageName = 'advert-' . time() . '.png';
        $request->advert_img->move(public_path('assets/img/adverts'), $imageName);
        $postArray['advert_img'] = $imageName;
        if (!isset($message)) {
            $advert = Advert::create($postArray);
            if (!$advert) {
                $responses = array(
                    'message' => 'An error occurred',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                $responses = array(
                    'message' => 'Advert Updated',
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
     * @param  \App\Models\Advert $advert
     * @return \Illuminate\Http\Response
     */
    public function show(Advert $advert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function edit(Advert $advert)
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
        if ($request->hasFile('advert_img')) {
            $imageName = 'advert-' . time() . '.png';
            $request->advert_img->move(public_path('assets/img/adverts'), $imageName);
            $postArray['advert_img'] = $imageName;
        }

        $update = Advert::where('advert_id', '=', $postArray['advert_id'])->update($postArray);

        if ($update) {

            $responses = array(
                'message' =>  'Advert updated successfully.',
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
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $advert)
    {
        //
    }
}
