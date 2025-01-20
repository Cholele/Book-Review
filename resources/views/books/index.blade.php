@extends('layouts.app')

@section('content')
  <h1 class = "mb-10 text-2x1">Books</h1>

  {{-- This form will be our filter --}}
  <form method = "GET" action="{{ route('books.index')}}" class="mb-4 flex items-center space-x-2">
    <input type="text" name="title" placeholder="search by title" value="{{ request('title' )}}" class="input h-10"/>
    <button type="submit" class="btn h-10"> Search</button>
    <a href="{{ route('books.index') }}" class="btn h-10">Clear</a>
  </form>

  <div class="filter-container mb-4 flex">
    @php
      $filters = [
        '' => 'latest',
        'popular_last_month' => 'Popular Last Month',
        'popular_last_6months' => 'Popular Last 6 Months',
        'highestRates_last_month' => 'Highest Rated Last Month',
        'highestRates_last_6months' => 'Highest Rated Last 6 Months'
      ];
    @endphp

    @foreach ($filters as $key => $label)
      <a href="#" class="{{ request('filter') === $key ? 'filter-item-active' : 'filter-item' }}">
        {{ $label }}
      </a>
    @endforeach
  </div>
  
  {{-- We display all the books --}}
  <ul>
    @forelse ($books as $book)
      <li class="mb-4">
        <div class="book-item">
          <div
            class="flex flex-wrap items-center justify-between">
            <div class="w-full flex-grow sm:w-auto">
              <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
              <span class="book-author">{{ $book->author }}</span>
            </div>
            <div>
              <div class="book-rating">
                {{ number_format($book->reviews_avg_rating, 1) }}
              </div>
              <div class="book-review-count">
                out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
              </div>
            </div>
          </div>
        </div>
      </li>    
    @empty
      <li class="mb-4">
        <div class="empty-book-item">
          <p class="empty-text">No books found</p>
          <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
        </div>
      </li> 
    @endforelse
  </ul>
@endsection()
