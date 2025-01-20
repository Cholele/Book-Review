<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Book;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        /* The follow code will create 33 books, will decide randomly how many revies generate (5 to 30) in each book
        
        Then, each review created will run the overwriting method "Good" associated with the book created by  
            ->for($book)
        and finally it will be saved*/

        //Creating 33 books with good reviews
        Book::factory(33)->create()->each(function ($book){
            $numReviews = random_int(5, 30);

             /* Laravel knows how the 2 models are related (Book ---> Review), it knows which column on the review model is used to create the relationship on the db 
    
            So it means that laravel will set the value on:
                'book_id' => null on the ReviewFactory 
            The value will be the id of the created Book*/ 

            Review::factory()->count($numReviews)
                ->good()
                ->for($book)
                ->create();
        });


        //Creating 33 books with bad reviews
        Book::factory(33)->create()->each(function ($book){
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)
                ->bad()
                ->for($book)
                ->create();
        });


        //Creating 34 books with average reviews
        Book::factory(34)->create()->each(function ($book){
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)
                ->avg()
                ->for($book)
                ->create();
        });
    }
}
