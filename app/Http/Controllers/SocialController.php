<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $count = Social::where('soc_name', '=', $postArray['soc_name'])->count();
            // $count = $query->num_rows;
            if ($count != 0) {
                $message = "Social already exist.";
                $responses = array(
                    'message' => 'Social already exist.',
                    'type' => 'orange',
                    'icon' => 'fa-bell',
                    'title' => 'Sorry'
                );
            }
        }

        if (!isset($message)) {
            $Social = Social::create($postArray);
            if ($Social) {
                $responses = array(
                    'message' => 'Social created successfully.',
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
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $postArray = $request->all();
        $update = Social::where('soc_id', '=', $postArray['soc_id'])->update($postArray);

        if ($update) {

            $responses = array(
                'message' => $postArray['soc_name'] . ' updated successfully.',
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
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social)
    {
        //
    }
}
