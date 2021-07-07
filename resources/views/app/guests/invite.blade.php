@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <h4 class="text-secondary text-capitalize">Invite {{ $guest->name }}</h4>
    <p class="lead">{{ $guest->membersCount() }}</p>
    <div class="d-flex justify-content-center">
        <div class="btn-group" role="group">
            <a class="btn btn-secondary" href="{{ route('events.index') }}">
                Back to Guests
            </a>
          </div>
    </div>
</div>

@if ($events->isEmpty())
    No upcoming events available.
@else
    <div class="lead">
        Followings are the upcoming events:
    </div>
    <form class="my-4" action="{{ route('guests.persist') }}" method="post">
        @csrf

        <input type="hidden" name="nature" value="make-invite">
        <input type="hidden" name="guest" value="{{ $guest->id }}">

        @foreach ($events as $event)
        <div class="mb-2">
            <label for="event-{{ $event->id }}" class="sr-only">{{ $event->title }}</label>
            <div class="form-check form-switch text-start">
                <input class="form-check-input" type="checkbox" id="event-{{ $event->id }}" name="events[]" value="{{ $event->id }}">
                <label class="form-check-label" for="event-{{ $event->id }}">{{ $event->title }}</label>
            </div>
        </div>
        @endforeach

        <input type="submit" value="Save Invite" class="btn btn-secondary px-5 mt-4">

    </form>
@endif

@endsection
