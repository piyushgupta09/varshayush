<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
    <meta name="description" content="Create beautiful, modern and mobile-ready website, blog or online store in just 5 minutes. R2L is the world's easiest to use website builder.">

    <!-- Brand -->
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/icon/favicon.ico') }}">

    <!-- Head -->
    @yield('head')

</head>

<!-- Body -->
@yield('body')

</html>
