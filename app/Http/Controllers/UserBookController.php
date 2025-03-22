<?php

namespace App\Http\Controllers;

use App\Models\UserBook;
use Illuminate\Http\Request;

class UserBookController extends Controller
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
    public function create($book_id, $user_id)
    {
        $check = UserBook::where('book_id', '=', $book_id)->where('user_id', '=', $user_id)->count();
        if ($check > 0) {
            return false;
        } else {
            UserBook::create(['book_id' => $book_id, 'user_id' => $user_id]);
            return true;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserBook  $userBook
     * @return \Illuminate\Http\Response
     */
    public function show(UserBook $userBook)
    {
        //
    }
    public function showByUser($user_id)
    {
        $data = UserBook::join('books', 'books.book_id', '=', 'user_books.book_id')
            ->where('user_id', '=', $user_id)->get();
        return $data;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserBook  $userBook
     * @return \Illuminate\Http\Response
     */
    public function edit(UserBook $userBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserBook  $userBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserBook $userBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserBook  $userBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserBook $userBook)
    {
        //
    }
}
