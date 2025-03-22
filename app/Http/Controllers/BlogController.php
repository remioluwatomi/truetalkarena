<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Blog = Blog::where('')->get();
        // return $Blog;
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
    public function makeSlug(String $string)
    {
        $string = strtolower($string);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
    }
    public function store(Request $request)
    {
        // header('Content-Type: text/html; charset=utf-8');
        $postArray = $request->all();
        // $postArray['news_img'] = file_get_contents($postArray['news_img']);
        $imageName = 'blog-' . time() . '.png';
        $postArray['blog_slug'] = $this->makeSlug($postArray['blog_title']);
        $request->blog_img->move(public_path('assets/img/blog'), $imageName);
        $postArray['blog_img'] = $imageName;
        $news = Blog::create($postArray);
        if ($news) {
            $responses = array(
                'message' => 'News uploaded successfully',
                'type' => 'green',
                'icon' => 'fa-bell',
                'title' => 'Hello!'
            );
        } else {
            $responses = array(
                'message' => 'Sorry! - something went wrong. ',
                'type' => 'red',
                'icon' => 'fa-bell',
                'title' => 'Sorry'
            );
        }
        return json_encode($responses);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $blog_id)
    {
        $blog_id = $request['blog_id'];
        $count = Blog::where('blog_id', '=', $blog_id)->count();
        if ($count > 0) {
            $account = Blog::where('blog_id', $blog_id)->delete();
            $responses = array(
                'message' => 'Blog deleted successfully.',
                'type' => 'green',
                'icon' => 'fa-check-circle',
                'title' => 'Thank you'
            );
        } else {
            $responses = array(
                'message' => 'Blog does not exist',
                'type' => 'red',
                'icon' => 'fa-check-circle',
                'title' => 'Thank you'
            );
        }
        echo json_encode($responses);
    }
}
