@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <p class="display-6 text-secondary text-capitalize">events</p>
    <div class="d-flex justify-content-center">
        <a class="btn btn-light border-danger py-1 px-5"
            href="{{ route('events.create') }}">
            Add Event
        </a>
    </div>
</div>

@if ($events->isEmpty())
    No event available yet.
@else
    <div class="row row-cols-1 row-cols-md-2 row-cols-md-3 row-cols-xl-4 g-3">
        @foreach($events as $event)
            <div class="card-group">

                <div class="card">

                    <a href="{{ route('events.show', $event->id) }}"
                        class="text-dark align-left" style="text-decoration: none">

                        <img
                            class="card-img-top"
                            src="{{ $event->image }}"
                            style="object-fit: cover"
                            alt="Card image" width="100%" height="150px"
                        >

                        <div class="card-body px-3 py-2">
                            <p class="card-title fs-4 mb-0">{{ $event->title }}</p>
                            <p class="text-muted mb-0">
                                @if (is_null($event->venue))
                                    Venue not booked yet.
                                @else
                                    at {{ $event->venue->name }}
                                @endif
                            </p>
                            <p class="text-muted mb-0">on {{ $event->getDatetime() }}</p>
                        </div>
                    </a>

                    @auth
                        <!-- Edit & Delete -->
                        <div class="btn-group border-top row g-0" role="group">
                            <a href="{{ route('events.edit', $event->id) }}"
                                class="btn br-tl-0 col-6">
                                Edit
                            </a>
                            <form class="form-inline col-6 border-start" action="{{ route('events.destroy', $event->id) }}" method="post">
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
