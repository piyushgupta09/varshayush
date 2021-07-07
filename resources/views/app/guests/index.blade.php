@extends('layouts.app')

@section('content')

<!-- Page Title -->
<!-- Page Title -->
<div class="py-5 text-center">
    <p class="display-6 text-secondary text-capitalize">guests</p>
    @auth
    <div class="d-flex justify-content-center">
        <a class="btn btn-light border-danger py-1 px-5"
            href="{{ route('guests.create') }}">
            Add Guest
        </a>
    </div>
    @endauth
</div>

@if($guests->isEmpty())
    No guest added yet.
@else

    <!-- Guest List -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-md-3 row-cols-xl-4 g-3">
        @foreach($guests as $guest)
            <div class="card-deck">

                <div class="card">

                    <!-- View Detail -->
                    <div class="d-flex" style="cursor: pointer;"
                        data-bs-name="{{ $guest->name }}"
                        data-bs-relation="{{ $guest->relation }}"
                        data-bs-address="{{ $guest->address }}"
                        data-bs-note="{{ $guest->note }}"
                        data-bs-travelby="{{ $guest->travelby }}"
                        data-bs-contact="{{ $guest->contact }}"
                        data-bs-number="{{ $guest->number }}"
                        data-bs-senior="{{ $guest->senior }}"
                        data-bs-member="{{ $guest->membersCount() }}"
                        data-bs-toggle="modal"
                        data-bs-target="#guestDetailModal">

                        <img class="m-2 me-0 rounded-3" src="{{ $guest->image }}" style="object-fit: cover"
                            alt="Card image" width="75px" height="75px">

                        <div class="card-body">
                            <h5 class="card-title text-capitalize fs-4 mb-1">{{ $guest->name }}</h5>
                            <p class="text-muted mb-0">{{ $guest->membersCount() }}</p>
                        </div>

                    </div>

                    @if ($guest->events->isEmpty())
                        <div class="btn btn-light border-top"
                        style="cursor: default">
                            No upcoming events
                        </div>
                    @else
                        <div class="btn btn-light border-top"
                            data-bs-toggle="collapse" href="#guestsUpcomingEvents-{{ $guest->id }}"
                            aria-expanded="false" aria-controls="guestsUpcomingEvents-{{ $guest->id }}">
                            Show upcoming events
                        </div>

                        <div class="collapse" id="guestsUpcomingEvents-{{ $guest->id }}">
                            @foreach ($guest->events as $event)
                                <div class="px-3 py-2 border-top">
                                    <p class="lead mb-0">{{ $event->title }}</p>
                                    <p class="mb-0">{{ $event->getDate() }}</p>
                                    @auth
                                    <div class="btn-group mt-2" role="group">
                                        <button type="button" class="btn btn-sm border bg-light-success">
                                            Accept
                                        </button>
                                        <button type="button" class="btn btn-sm border bg-light-danger">
                                            Decline
                                        </button>

                                        <form class="d-block w-100 mb-1" action="{{ route('guests.persist') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="nature" value="cancel-invite">
                                            <input type="hidden" name="guest" value="{{ $guest->id }}">
                                            <input type="hidden" name="event" value="{{ $event->id }}">
                                            <input type="submit" value="Cancel Invite" class="btn btn-sm border bg-light-secondary">
                                        </form>
                                    </div>
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    @endif



                    @auth
                    <!-- Edit | Delete | Invite -->
                    <div class="btn-group border-top d-flex" role="group">
                        <a href="{{ route('guests.edit', $guest->id) }}"
                            class="flex-fill btn text-primary rounded-0">
                            Edit
                        </a>
                        <form class="flex-fill border-start border-end"
                            action="{{ route('guests.destroy', $guest->id) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn text-primary w-100 rounded-0">
                        </form>
                        <a href="{{ route('guests.invite', $guest->id) }}"
                            class="flex-fill btn text-primary rounded-0">
                            Invite
                        </a>
                    </div>
                    @endauth

                </div>


            </div>
        @endforeach
    </div>

    <!-- View Guest Detail Modal -->
    <div class="modal fade" id="guestDetailModal" tabindex="-1" aria-labelledby="guestDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between mb-2">
                        <div id="guestName" class="col fs-5 fw-bold"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row border-bottom py-2">
                        <label for="guestRelation" class="col-md-4 fs-6 lead">Relation</label>
                        <div id="guestRelation" class="col-md-6"></div>
                    </div>
                    <div class="row border-bottom py-2">
                        <label for="guestMember" class="col-md-4 fs-6 lead">Members</label>
                        <div id="guestMember" class="col-md-6"></div>
                    </div>
                    <div class="row border-bottom py-2">
                        <label for="guestAddress" class="col-md-4 fs-6 lead">Address</label>
                        <div id="guestAddress" class="col-md-6"></div>
                    </div>
                    <div class="row border-bottom py-2">
                        <label for="guestNote" class="col-md-4 fs-6 lead">Additional Info</label>
                        <div id="guestNote" class="col-md-6"></div>
                    </div>
                    <div class="row border-bottom py-2">
                        <label for="guestTravelBy" class="col-md-4 fs-6 lead">TravelBy</label>
                        <div id="guestTravelBy" class="col-md-6"></div>
                    </div>
                    <div class="row border-bottom py-2">
                        <label for="guestContact" class="col-md-4 fs-6 lead">Contact Person</label>
                        <div id="guestContact" class="col-md-6"></div>
                    </div>
                    <div class="row border-bottom py-2">
                        <label for="guestNumber" class="col-md-4 fs-6 lead">Contact Number</label>
                        <div id="guestNumber" class="col-md-6"></div>
                    </div>
                    <div class="row pt-2">
                        <label for="guestSenior" class="col-md-4 fs-6 lead">Senior</label>
                        <div id="guestSenior" class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var guestDetailModal = document.getElementById('guestDetailModal');
            guestDetailModal.addEventListener('show.bs.modal', function (event) {

                // Extract data
                var guestName = guestDetailModal.querySelector('#guestName');
                var guestRelation = guestDetailModal.querySelector('#guestRelation');
                var guestMember = guestDetailModal.querySelector('#guestMember');
                var guestAddress = guestDetailModal.querySelector('#guestAddress');
                var guestNote = guestDetailModal.querySelector('#guestNote');
                var guestTravelBy = guestDetailModal.querySelector('#guestTravelBy');
                var guestContact = guestDetailModal.querySelector('#guestContact');
                var guestNumber = guestDetailModal.querySelector('#guestNumber');
                var guestSenior = guestDetailModal.querySelector('#guestSenior');

                // Set data value
                button = event.relatedTarget;
                guestName.innerHTML = button.getAttribute('data-bs-name');
                guestRelation.innerHTML = button.getAttribute('data-bs-name');
                guestMember.innerHTML = button.getAttribute('data-bs-member');
                guestAddress.innerHTML = button.getAttribute('data-bs-address');
                guestNote.innerHTML = button.getAttribute('data-bs-note');
                guestTravelBy.innerHTML = button.getAttribute('data-bs-travelby');
                guestContact.innerHTML = button.getAttribute('data-bs-contact');
                guestNumber.innerHTML = button.getAttribute('data-bs-number');
                guestSenior.innerHTML = button.getAttribute('data-bs-senior');

            })

        </script>
    </div>

@endif

@endsection
