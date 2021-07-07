@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <h4 class="text-secondary text-capitalize">edit guest</h4>
</div>

<!-- Create Guest From -->
<form action="{{ route('guests.update', $guest->id) }}" method="post">
    @csrf
    @method('PUT')

    <div class="row">

        <!-- Name Input (Required) -->
        <div class="col-md-6 mb-3">
            <label class="lead mb-1" for="name-input">Guest or Family Name</label>
            <input type="text" name="name" id="name-input" class="form-control"
            required placeholder="James Rodd / Olivia's family"
            value="{{ old('name') ?? $guest->name }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Senior Member Input -->
        <div class="col-6 mb-3">
            <label class="lead mb-1" for="senior-input">Senior Member Name</label>
            <input type="text" name="senior" id="senior-input" class="form-control"
                placeholder="Name on invitation card"
                value="{{ old('senior') ?? $guest->senior }}">
            @error('senior')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Adult Members Input -->
        <div class="col-md-6 mb-3">
            <label class="lead mb-1" for="adults-input">Adult Members</label>
            <input type="number" name="adults" id="adults-input" class="form-control"
                placeholder="Number of adult members"
                value="{{ old('adults') ?? $guest->adults }}">
            @error('adults')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Kid Members Input -->
        <div class="col-md-6 mb-3">
            <label class="lead mb-1" for="kids-input">Kids <i>(Age upto 10 years)</i></label>
            <input type="number" name="kids" id="kids-input" class="form-control"
                placeholder="Number of kids"
                value="{{ old('kids') ?? $guest->kids }}">
            @error('kids')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- TravelBy Input (Required) -->
        <div class="col-6 mb-3">
            <label class="lead mb-1" for="travelby-input">Travel to venue</label>
            <select class="form-select" name="travelby" id="travelby-input" aria-label="Select travelby info" required>
                <option
                    value="self"
                    {{ ((old('travelby') ?? $guest->travelby) == 'self') ? 'selected="selected"' : '' }}>
                    Self Managed
                </option>
                <option
                    value="car"
                    {{ ((old('travelby') ?? $guest->travelby) == 'car') ? 'selected="selected"' : '' }}>
                    Drive by car (Vallet Parking)
                </option>
                <option
                    value="pick"
                    {{ ((old('travelby') ?? $guest->travelby) == 'pick') ? 'selected="selected"' : '' }}>
                    Pickup Required (Station or Airport)
                </option>
                <option
                    value="back"
                    {{ ((old('travelby') ?? $guest->travelby) == 'back') ? 'selected="selected"' : '' }}>
                    Via Common Bus (Only form Venue to Groom's place)
                </option>
                <option
                    value="both"
                    {{ ((old('travelby') ?? $guest->travelby) == 'both') ? 'selected="selected"' : '' }}>
                    Via Common Bus (Groom's Place to Venue and back)
                </option>
            </select>
            @error('travelby')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Relation Input -->
        <div class="col-md-6 mb-3">
            <label class="lead mb-1" for="relation-input">Relation with guest</label>
            <input type="text" name="relation" id="relation-input" class="form-control"
                placeholder="Mousa-ji or Mothers > Sisters > Husband"
                value="{{ old('relation') ?? $guest->relation }}">
            @error('relation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Contact Name Input -->
        <div class="col-6 mb-3">
            <label class="lead mb-1" for="contact-input">Person of Contact</label>
            <input type="text" name="contact" id="contact-input" class="form-control"
                placeholder="Name of person who can be called"
                value="{{ old('contact') ?? $guest->contact }}">
            @error('contact')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Contact Number Input -->
        <div class="col-6 mb-3">
            <label class="lead mb-1" for="number-input">Contact Number</label>
            <input type="number" name="number" id="number-input" class="form-control"
                placeholder="Mobile no. of contact person"
                value="{{ old('number') ?? $guest->number }}">
            @error('number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <!-- Address Input -->
    <div class="col-12 mb-3">
        <label class="lead mb-1" for="address-input">Postal Address</label>
        <textarea name="address" id="address-input" class="form-control" rows="1"
            placeholder="Postal Address">{{ old('name') ?? $guest->address }}</textarea>
        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Note Input -->
    <div class="col-12 mb-3">
        <label class="lead mb-1" for="note-input">Additional Information</label>
        <textarea name="note" id="note-input" class="form-control"
            placeholder="Note relevant information about guest"
            rows="1">{{ old('note') ?? $guest->note }}</textarea>
        @error('note')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Image Input -->
    <div class="col-12 mb-3">
        <label for="cover-input" class="lead mb-1">Guest Image</label>
        <input type="file" name="image" id="cover-input" class="form-control">
        @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="d-flex justify-content-between">
        <div>
            <a href="{{ route('guests.edit', $guest->id) }}" class="btn btn-warning">
                Reset Form
            </a>
            <a href="{{ route('guests.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
        <input type="submit" class="btn btn-success px-5" value="Submit">
    </div>

</form>

@endsection
