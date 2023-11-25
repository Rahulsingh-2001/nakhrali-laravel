<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nakhrali Trends | Most Fashinable Clothing brand in ahmedabad</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Nakhrali Trends">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/images/logo/favicon.ico') }}">
    <link rel="alternate" hreflang="en-gb" href="https://nakhralitrends.com/">
    <link rel="alternate" hreflang="en-us" href="https://nakhralitrends.com/">
    <link rel="alternate" hreflang="en" href="https://nakhralitrends.com/">
    <link rel="alternate" hreflang="de" href="https://nakhralitrends.com/">
    <link rel="alternate" hreflang="x-default" href="https://nakhralitrends.com/">

    @include('frontend.common.common-head')


    @include('frontend.common.header')

    @section('content')
    @show()

    @include('frontend.common.footer')
    @include('frontend.common.common-end')
