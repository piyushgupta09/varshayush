@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <h4 class="text-secondary text-capitalize">edit event</h4>
</div>

<form class="row pb-2" action="{{ route('events.update', $event->id) }}" method="post">
    @csrf
    @method('PUT')

    <!-- Title Input -->
    <div class="row mb-3">
        <label for="title-input" class="col-md-4 lead mb-1">Event Title</label>
        <div class="col-md-8">
            <input type="text" name="title" id="title-input" class="form-control"
            required placeholder="Enter event title" value="{{ old('title') ?? $event->title }}">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Image Input -->
    <div class="row mb-3">
        <label for="cover-input" class="col-md-4 lead mb-1">Event Image</label>
        <div class="col-md-8">
            <input type="file" name="image" id="cover-input" class="form-control">
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Detail Input -->
    <div class="row mb-3">
        <label for="detail-input" class="col-md-4 lead mb-1">Event Description</label>
        <div class="col-md-8">
            <textarea name="detail" id="detail-input" class="form-control"
                placeholder="Enter detailed description"
                >{{ old('detail') ?? $event->detail }}
            </textarea>
            @error('detail')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Event Start Datetime -->
    <div class="row mb-3">
        <label for="start-input" class="col-md-4 lead mb-1">Date & Timings</label>
        <div class="col-md-4">
            <input type="datetime-local" name="start"
            required class="form-control" id="start-input"
            value="{{ old('start') ?? $event->startDate() }}">
            @error('start')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4">
            <input type="datetime-local" name="end"
            class="form-control" id="end-input"
            value="{{ old('end') ?? $event->endDate() }}">
            @error('end')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Venue Input -->
    <div class="row mb-3">
        <label class="col-md-4 lead mb-1" for="venue-input">Event Venue</label>
        <div class="col-md-8 d-flex">
            <select class="form-select" name="venue" id="venue-input"
                aria-label="Select venue info" required>
                <option selected>Select venue for event</option>
                @foreach($venues as $venue)
                    <option value="{{ $venue->id }}"
                        {{ ((old('venue') ?? $event->venue_id) == $venue->id) ? 'selected="selected"' : '' }}>
                        {{ $venue->name }}
                    </option>
                @endforeach
            </select>
            <button
            type="button" title="Add New Venue"
            class="btn btn-sm btn-light border-secondary ms-2"
            data-bs-toggle="modal" data-bs-target="#addVenueModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>
            </button>
            @error('venue')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Submit Button -->
    <div class="d-flex justify-content-between">
        <div>
            <input type="reset" value="Reset Form" class="btn btn-warning">
            <a href="{{ route('events.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
        <input type="submit" class="btn btn-success px-5" value="Submit">
    </div>

</form>

<div class="modal fade" id="addVenueModal" tabindex="-1" aria-labelledby="addVenueModalLabel" ` aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-success">
            <div class="modal-header text-white py-2 px-3">
                <h5 class="modal-title" id="addVenueModalLabel">Add New Venue</h5>
                <button type="button" class="btn-close btn btn-light" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form class="bg-white" action="{{ route('venues.store') }}" method="post">
                @csrf

                <div class="modal-body">

                    <!-- Name Input -->
                    <div class="mb-2">
                        <label for="name-input" class="lead mb-1">Name</label>
                        <input type="text" name="name" id="name-input" class="form-control"
                            placeholder="Enter venue name" value="{{ old('name') ?? '' }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <!-- Website Input -->
                     <div class="mb-2">
                        <label for="website-input" class="lead mb-1">Website</label>
                        <input type="text" name="website" id="website-input" class="form-control"
                            placeholder="Enter venue website url" value="{{ old('website') ?? '' }}">
                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <!-- Contact Input -->
                     <div class="mb-2 row">
                         <div class="col-6">
                            <label for="contact-input" class="lead mb-1">Contact</label>
                            <input type="text" name="contact" id="contact-input" class="form-control"
                                placeholder="Enter person name" value="{{ old('contact') ?? '' }}">
                            @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="number-input" class="lead mb-1">Number</label>
                            <input type="text" name="number" id="number-input" class="form-control"
                                placeholder="Enter person number" value="{{ old('number') ?? '' }}">
                            @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Address Input -->
                    <div class="mb-2">
                        <label for="address-input" class="lead mb-1">Address</label>
                        <input type="text" name="address" id="address-input" class="form-control"
                            placeholder="Enter postal address" value="{{ old('address') ?? '' }}">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="input-group mt-2 d-flex">
                           <input type="text" name="map" id="map-input" class="form-control"
                               aria-label="Google map link" aria-describedby="google-maps"
                               placeholder="Get google map share link" value="{{ old('map') ?? '' }}">
                           <span class="input-group-text" id="google-maps">
                               <a id="googleMapSearch" href="" target="_blank">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map" viewBox="0 0 16 16">
                                       <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                                       <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                                   </svg>
                               </a>
                           </span>
                           @error('map')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <p class="text-muted small ms-1">like this: https://goo.gl/maps/cqC1J12BGKtmZHYRA</p>

                    </div>

                    <div class="d-flex justify-content-end">
                        <input type="reset" value="Reset" class="btn btn-warning px-4 me-2">
                        <button type="submit" class="btn btn-success px-5">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
