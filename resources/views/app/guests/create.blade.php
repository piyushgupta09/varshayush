@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <h4 class="text-secondary text-capitalize">create new guest</h4>
    <div class="d-flex justify-content-center">
        <div class="btn-group" role="group">
            <a class="btn py-1 px-5 btn-light"
                href="{{ route('guests.index') }}">
                Back to guests
            </a>
        </div>
    </div>
</div>

<!-- Create Guest From -->
<form class="mb-5" action="{{ route('guests.store') }}" method="post">
    @csrf

    <!-- Name Input (Required) -->
    <div class="row mb-3">
        <label class="col-md-4 lead mb-1" for="name-input">Guest or Family Name</label>
        <div class="col-md-8">
            <input type="text" name="name" id="name-input" class="form-control"
            required placeholder="James Rodd / Olivia's family" value="{{ old('name') ?? '' }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Senior Member Input -->
    <div class="row mb-3">
        <label class="col-md-4 lead mb-1" for="senior-input">Senior Member Name</label>
        <div class="col-md-8">
            <input type="text" name="senior" id="senior-input" class="form-control"
                placeholder="Name on invitation card" value="{{ old('senior') ?? '' }}">
            @error('senior')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Members Count Input -->
    <div class="row mb-3">
        <label class="col-md-4 lead mb-1" for="adults-input">Members Count</label>
        <!-- Adults -->
        <div class="col-md-4">
            <input type="number" name="adults" id="adults-input" class="form-control"
                placeholder="Number of adult members" value="{{ old('adults') ?? '' }}">
            @error('adults')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- Kid -->
        <div class="col-md-4">
            <input type="number" name="kids" id="kids-input" class="form-control"
                placeholder="Kids (Age upto 10 years)" value="{{ old('kids') ?? '' }}">
            @error('kids')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- TravelBy Input (Required) -->
    <div class="row mb-3">
        <label class="col-md-4 lead mb-1" for="travelby-input">Travel to venue</label>
        <div class="col-md-8">
            <select class="form-select" name="travelby" id="travelby-input" aria-label="Select travelby info" required>
                <option value="self" {{ (old('travelby') == 'self') ? 'selected="selected"' : '' }}>Self Managed</option>
                <option value="car" {{ (old('travelby') == 'car') ? 'selected="selected"' : '' }}>Drive by car (Vallet Parking)</option>
                <option value="pick" {{ (old('travelby') == 'pick') ? 'selected="selected"' : '' }}>Pickup Required (Station or Airport)</option>
                <option value="back" {{ (old('travelby') == 'back') ? 'selected="selected"' : '' }}>Via Common Bus (Only form Venue to Groom's place)</option>
                <option value="both" {{ (old('travelby') == 'both') ? 'selected="selected"' : '' }}>Via Common Bus (Groom's Place to Venue and back)</option>
            </select>
            @error('travelby')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Relation Input -->
    <div class="row mb-3">
        <label class="col-md-4 lead mb-1" for="relation-input">Relation with guest</label>
        <div class="col-md-8">
            <input type="text" name="relation" id="relation-input" class="form-control"
                placeholder="Mousa-ji or Mothers > Sisters > Husband" value="{{ old('relation') ?? '' }}">
            @error('relation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Contact Person Input -->
    <div class="row mb-3">
        <label class="col-md-4 lead mb-1" for="contact-input">Person of Contact</label>
        <!-- Contact -->
        <div class="col-md-4">
            <input type="text" name="contact" id="contact-input" class="form-control"
                placeholder="Name of person" value="{{ old('contact') ?? '' }}">
            @error('contact')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- Number -->
        <div class="col-md-4">
            <input type="number" name="number" id="number-input" class="form-control"
                placeholder="Contact of person" value="{{ old('number') ?? '' }}">
            @error('number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Address Input -->
    <div class="row mb-3">
        <label class="col-md-4 lead mb-1" for="address-input">Postal Address</label>
        <div class="col-md-8">
            <textarea name="address" id="address-input" class="form-control" rows="1"
                placeholder="Postal Address">{{ old('name') ?? 'New Delhi' }}</textarea>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Note Input -->
    <div class="row mb-3">
        <label class="col-md-4 lead mb-1" for="note-input">Additional Information</label>
        <div class="col-md-8">
            <textarea name="note" id="note-input" class="form-control" rows="1"
                placeholder="Note relevant information about guest">{{ old('note') ?? '' }}</textarea>
            @error('note')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Image Input -->
    <div class="row mb-3">
        <label for="cover-input" class="col-md-4 lead mb-1">Guest Image</label>
        <div class="col-md-8">
            <input type="file" name="image" id="cover-input" class="form-control">
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Upcomming Events -->
    <div class="row mb-3">
        <label for="events-input" class="col-md-4 lead mb-1">Upcomming Events</label>
        <div class="col-md-8">
            <label class="lead fs-5 mb-2">Invite guest to the following events:</label>
            <input type="hidden" name="nature" value="make-invite">
            @foreach ($events as $event)
                <div class="mb-2">
                    <label for="event-{{ $event->id }}" class="sr-only">{{ $event->title }}</label>
                    <div class="form-check form-switch text-start">
                        <input class="form-check-input" type="checkbox" id="event-{{ $event->id }}" name="events[]" value="{{ $event->id }}">
                        <label class="form-check-label" for="event-{{ $event->id }}">{{ $event->title }}</label>
                    </div>
                </div>
            @endforeach
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Submit Button -->
    <div class="d-flex justify-content-end">
        <a href="{{ route('guests.index') }}" class="btn btn-secondary me-2 px-4">
            Cancel
        </a>
        <input type="reset" value="Reset Form" class="btn btn-warning me-2">
        <input type="submit" class="btn btn-success px-5" value="Submit">
    </div>

</form>

@endsection
