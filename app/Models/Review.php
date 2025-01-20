<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Fillable is a property on a model that lets you specify that some properties can be mass assigned
    protected $fillable = ['review', 'rating']; 

    public function book()
    {
        return $this->belongsTo(Book::class);

        //It's important to mention that we can specify the FK
        //return $this->belongsTo(Book::class,'FK');

    }
}
