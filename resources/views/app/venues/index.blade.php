@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <p class="display-6 text-secondary text-capitalize">venues</p>
    @auth
    <div class="d-flex justify-content-center">
        <a class="btn btn-light border-danger py-1 px-5"
            href="{{ route('venues.create') }}">
            Add Venue
        </a>
    </div>
    @endauth
</div>

@if ($venues->isEmpty())
    No venue added yet.
@else
    <div class="row row-cols-md-3 g-3">
        @foreach($venues as $venue)
            <div class="card-group">

                <div class="card">
                    <div class="card-body">
                        <p class="display-6 mb-1">{{ $venue->name }}</p>
                        <div class="my-2">{{ $venue->address }}</div>
                        <div class="btn-group w-100 rounded" role="group">
                            @if ($venue->number)
                                <a href="tel:{{ $venue->number }}" class="btn btn-light border-secondary">Call</a>
                            @else
                                <button class="btn btn-secondary" onclick="alert('Number unavailable')">Call</button>
                            @endif
                            @if ($venue->map)
                                <a href="{{ $venue->map }}" class="btn btn-light border-secondary" target="_blank">Map</a>
                            @else
                                <button class="btn btn-secondary" onclick="alert('Map unavailable')">Map</button>
                            @endif
                            @if ($venue->website)
                            <a href="{{ $venue->website }}" class="btn btn-light border-secondary" target="_blank">Website</a>
                            @else
                                <button class="btn btn-secondary" onclick="alert('Website url unavailable')">Website</button>
                            @endif
                        </div>
                    </div>

                    @auth
                        <!-- Edit & Delete -->
                        <div class="btn-group border-top row g-0" role="group">
                            <a href="{{ route('venues.edit', $venue->id) }}"
                                class="btn br-tl-0 col-6">
                                Edit
                            </a>
                            <form class="form-inline col-6 border-start" action="{{ route('venues.destroy', $venue->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn w-100 br-0 br-br-1">
                            </form>
                        </div>
                    @endauth
                </div>


            </div>
        @endforeach
    </div>
@endif

@endsection
