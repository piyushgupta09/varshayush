@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <p class="text-secondary text-capitalize mb-0">
        <span class="h4 d-block">Settings</span>
        <span>Customize application interface</span>
    </p>
</div>

<form class="mb-5" action="{{ route('settings.store') }}" method="post">
    @csrf

    <!-- Title Input -->
    <div class="row mb-3">
        <label for="title-input" class="col-md-4 lead mb-1">Event Title</label>
        <div class="col-md-8">
            <input type="text" name="title" id="title-input" class="form-control"
            required placeholder="Enter event title" value={{ old('title') ?? '' }}>
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
                >{{ old('detail') ?? '' }}</textarea>
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
            <input type="datetime-local" name="start" id="start-input"
            required class="form-control" value={{ old('start') ?? '' }}>
            @error('start')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-4">
            <input type="datetime-local" name="end" id="end-input"
            class="form-control" value={{ old('end') ?? '' }}>
            @error('end')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Submit Button -->
    <div class="d-flex justify-content-end">
        <input type="reset" value="Reset Form" class="btn btn-warning">
        <input type="submit" class="btn btn-success px-5" value="Submit">
    </div>

</form>

@endsection
