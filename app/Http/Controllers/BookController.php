<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::orderBy('book_id', 'DESC')
            ->paginate(8);
        return $data;
    }
    public function search($search)
    {
        $data = Book::where('book_name', 'LIKE', "%{$search}%")->orderBy('book_id', 'DESC')
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

    public function makeSlug(String $string)
    {
        $string = strtolower($string);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
    }
    public function store(Request $request)
    {
        $postArray = $request->all();
        $imageName = 'book-' . time() . '.png';
        $request->book_cover->move(public_path('assets/img/books'), $imageName);
        $postArray['book_cover'] = $imageName;
        $imageName2 = 'book-back-' . time() . '.png';
        $request->book_back->move(public_path('assets/img/books'), $imageName2);
        $postArray['book_back'] = $imageName2;

        $file = $request->file('book_url');
        $imageName3 = 'book-' . time() . '.' . $file->clientExtension();
        $request->book_url->move(public_path('assets/img/books/pdf'), $imageName3);
        $postArray['book_url'] = $imageName3;

        $postArray['book_slug'] = $this->makeSlug($postArray['book_name']);
        if (!isset($message)) {
            $book = Book::create($postArray);
            if (!$book) {
                $responses = array(
                    'message' => 'An error occurred',
                    'type' => 'red',
                    'icon' => 'fa-check-circle',
                    'title' => 'Thank you'
                );
            } else {
                $responses = array(
                    'message' => 'Books Updated',
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($book_id)
    {
        $data = Book::where('book_id', '=', $book_id)->first();
        // dd($data);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $postArray = $request->all();
        if ($request->hasFile('book_cover')) {
            $imageName = 'book-' . time() . '.png';
            $request->book_cover->move(public_path('assets/img/books'), $imageName);
            $postArray['book_cover'] = $imageName;
        }
        if ($request->hasFile('book_back')) {
            $imageName2 = 'book-back-' . time() . '.png';
            $request->book_back->move(public_path('assets/img/books'), $imageName2);
            $postArray['book_back'] = $imageName2;
        }
        if ($request->hasFile('book_url')) {
            $file = $request->file('book_url');
            $imageName3 = 'book-' . time() . '.' . $file->clientExtension();
            $request->book_url->move(public_path('assets/img/books/pdf'), $imageName3);
            $postArray['book_url'] = $imageName3;
        }
        $postArray['book_slug'] = $this->makeSlug($postArray['book_name']);

        $update = Book::where('book_id', '=', $postArray['book_id'])->update($postArray);

        if ($update) {

            $responses = array(
                'message' =>  'Book updated successfully.',
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
