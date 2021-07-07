@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <p class="display-6 text-secondary text-capitalize">create venue</p>
</div>

<form action="{{ route('venues.store') }}" method="post">
    @csrf

    <!-- Name Input -->
    <div class="mb-2">
        <label for="name-input" class="lead mb-1">Name</label>
        <input type="text" name="name" id="name-input" class="form-control"
        required placeholder="Enter venue name" value="{{ old('name') ?? '' }}">
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
            placeholder="Enter venue website url"
            value="{{ old('website') ?? '' }}">
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
                placeholder="Enter person name"
                value="{{ old('contact') ?? '' }}">
            @error('contact')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-6">
            <label for="number-input" class="lead mb-1">Number</label>
            <input type="text" name="number" id="number-input" class="form-control"
                placeholder="Enter person number"
                value="{{ old('number') ?? '' }}">
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
        required placeholder="Enter postal address" value="{{ old('address') ?? '' }}">
        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="input-group mt-2 d-flex">
            <input type="text" name="map" id="map-input" class="form-control" aria-label="Google map link"
                aria-describedby="google-maps" placeholder="Get google map share link"
                value="{{ old('map') ?? '' }}">
            <span class="input-group-text" id="google-maps">
                <a id="googleMapSearch" href="" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pin-map" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z" />
                        <path fill-rule="evenodd"
                            d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
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

</form>

@endsection
