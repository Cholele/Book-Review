<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function reviews()      // <------ This will be the name of the relationships 
    {
        return $this->hasMany(Review::class);
    }

    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopePopular(Builder $query, $from = null, $to = null):Builder
    {
        return $query->withCount(['reviews' => fn(Builder $query2) => $this->dateRangeFilter($query2, $from, $to) ])
            ->orderBy('reviews_count', 'desc');
    }
   

    public function scopeHighestRated(Builder $query, $from = null, $to =null):Builder
    {
        return $query->withAvg(['reviews' => fn(Builder $query2) => $this->dateRangeFilter($query2, $from, $to)], 'rating')  
            ->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeMinReviews(Builder $query, int $minReviews): Builder
    {
        return $query->having('reviews_count', '>=', $minReviews);
    }
    

    private function dateRangeFilter(Builder $query, $from = null, $to = null)
    {
        if($from && !$to){
            $query->where('created_at','>=', $from);
        }else if($to && !$from){
            $query->where('created_at','<=', $to);
        }else{
            $query->whereBetween('created_at', [$from, $to]);
        }
    }
}
