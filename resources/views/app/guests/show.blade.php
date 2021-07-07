@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <h4 class="text-secondary text-capitalize">{{ $event->title }}</h4>
    <p class="lead">{{ $event->detail }}</p>
    <div class="d-flex justify-content-center">
        <div class="btn-group" role="group">
            <a class="btn btn-secondary" href="{{ route('events.index') }}">
                Back to Events
            </a>
            <a class="btn btn-secondary" href="{{ route('guests.create') }}">
                Add New Guest
            </a>
          </div>
    </div>
</div>

@if ($event->guests->isEmpty())
    No guest invited yet.
@else
    <div class="row row-cols-1 row-cols-md-2 row-cols-md-3 row-cols-xl-4 g-3">
        @foreach($event->guests as $guest)
        <div class="col">
            <div class="card border-info">
                <div class="card-body">

                    <!-- Name -->
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title text-info fw-bold mb-0">{{ $guest->name }}</h5>
                        <a class="px-2 pt-0" role="button" data-bs-toggle="collapse"
                            href="#guest-{{ $guest->id }}-profile" aria-expanded="false"
                            aria-controls="guest-{{ $guest->id }}-profile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </a>
                    </div>

                    <!-- Nickname -->
                    <div class="text-muted text-capitalize fst-italic">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-hash" viewBox="0 0 16 16">
                            <path
                                d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z" />
                        </svg>
                        {{ ($guest->nickname) ?? 'nickname' }}
                    </div>

                    @auth
                    <div class="btn-group d-flex justify-content-between mt-1 mb-2" role="group">
                        <!-- Edit guest Profile -->
                        <a class="btn btn-sm py-0 btn-secondary text-light"
                            data-bs-toggle="modal" data-bs-target="#editguestModal"
                            data-bs-family="{{ $family->id }}"
                            data-bs-guest="{{ $guest->id }}"
                            data-bs-relation="{{ $guest->relation }}"
                            data-bs-name="{{ $guest->name }}"
                            data-bs-nickname="{{ $guest->nickname }}"
                            data-bs-contact="{{ $guest->contact }}"
                            data-bs-email="{{ $guest->email }}"
                            data-bs-note="{{ $guest->note }}"
                            data-bs-married="{{ $guest->married }}"
                            data-bs-senior="{{ $guest->senior }}"
                            data-bs-kid="{{ $guest->kid }}"
                            data-bs-callable="{{ $guest->callable }}">
                            Edit
                        </a>

                        <!-- Delete guest Profile -->
                        <a class="btn btn-sm py-0 btn-secondary text-light"
                            data-bs-toggle="modal" data-bs-target="#deleteguestModal"
                            data-bs-guest="{{ $guest->id }}">
                            Delete
                        </a>

                        <!-- Invite guest Profile -->
                        <a class="btn btn-sm py-0 btn-secondary text-light"
                            data-bs-toggle="modal" data-bs-target="#inviteguestModal"
                            data-bs-guest="{{ $guest->id }}">
                            Invite
                        </a>
                    </div>
                    @endauth

                    <!-- Profile Details -->
                    <div class="collapse" id="guest-{{ $guest->id }}-profile">

                        @if($guest->hasProfile())

                            @if($guest->relation)
                                <p class="mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-people" viewBox="0 0 16 16">
                                        <path
                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                                    </svg>
                                    <span class="ms-2">{{ $guest->relation }}</span>
                                </p>
                            @endif

                            @if($guest->contact)
                                <p class="mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-telephone" viewBox="0 0 16 16">
                                        <path
                                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                    </svg>
                                    <span class="ms-2">{{ $guest->contact }}</span>
                                </p>
                            @endif

                            @if($guest->email)
                                <p class="mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path
                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                                    </svg>
                                    <span class="ms-2">{{ $guest->email }}</span>
                                </p>
                            @endif

                            @if($guest->note)
                                <p class="mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-lightbulb" viewBox="0 0 16 16">
                                        <path
                                            d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1z" />
                                    </svg>
                                    <span class="ms-2">{{ $guest->note }}</span>
                                </p>
                            @endif

                        @else
                            No profile available
                        @endif

                        @if($guest->upcomingOccations()->isNotEmpty())
                            <ul class="list group mt-2 mb-1 ps-0">
                                @foreach($guest->upcomingOccations() as $occasion)
                                    <li class="list-group-item">
                                        <h6 class="mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                                fill="currentColor" class="bi bi-diamond-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435z" />
                                            </svg>
                                            <span class="ms-1">{{ $occasion->title }}</span>
                                        </h6>
                                        <small class="ms-3 text-muted">{{ $occasion->getDatetime() }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    </div>

                    <!-- Tags -->
                    <div class="btn-group mt-2" role="group" aria-label="Basic example">


                        @if($guest->senior)
                            <span class="badge me-1 rounded-pill text-secondary border border-secondary">Senior</span>
                        @endif

                        @if($guest->callable)
                            <span class="badge me-1 rounded-pill text-secondary border border-secondary">Callable</span>
                        @endif

                        @if($guest->martial)
                            <span class="badge me-1 rounded-pill text-secondary border border-secondary">Married</span>
                        @elseif($guest->kid)
                            <span class="badge me-1 rounded-pill text-secondary border border-secondary">Kid</span>
                        @else
                            <span class="badge me-1 rounded-pill text-secondary border border-secondary">Single</span>
                        @endif

                        @if($guest->gender)
                            <span class="badge me-1 rounded-pill text-secondary border border-secondary">M</span>
                        @else
                            <span class="badge me-1 rounded-pill text-secondary border border-secondary">F</span>
                        @endif

                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
