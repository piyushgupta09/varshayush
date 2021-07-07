@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <h4 class="text-secondary text-capitalize">{{ $event->title }}</h4>
    <p class="mb-0">{{ $event->detail }}</p>
    <p>
        on {{ $event->getDate() }}
        at {{ $event->venue->name }}
    </p>
    <div class="d-flex justify-content-center">
        <div class="btn-group" role="group">
            <a class="btn py-1 border-danger" href="{{ route('events.index') }}">
                Back
            </a>
            <a class="btn py-1 border-danger border-start-0" href="{{ route('guests.create') }}">
                Add Guest
            </a>
          </div>
    </div>
</div>


@if ($event->guests->isEmpty())
    No guest invited yet.
@else
<table class="table table-striped">
    <thead class="table-secondary">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Relation</th>
            <th>Adults</th>
            <th>Kids</th>
            <th>Travel</th>
            <th>Person</th>
            <th>Contact</th>
            <th>Senior</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach($event->guests as $guest)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->relation }}</td>
                <td>{{ $guest->adults }}</td>
                <td>{{ $guest->kids }}</td>
                <td>{{ $guest->travelby }}</td>
                <td>{{ $guest->contact }}</td>
                <td>{{ $guest->number }}</td>
                <td>{{ $guest->senior }}</td>
                <td>{{ $guest->address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection
