<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['book_name', 'book_slug', 'book_url', 'book_cover', 'book_back', 'book_price', 'book_desc'];
}
