<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'images',
        'title',
        'description',
        'publisher',
        'released_at',
        'stock',
        'cost',
        'genre_id',
        'author_id',
    ];
}
