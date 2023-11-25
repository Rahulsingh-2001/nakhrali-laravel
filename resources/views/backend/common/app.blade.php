<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Nakhrali - Admin</title>

    @include('backend.common.common-head')


    @include('backend.common.header')

    @include('backend.common.side-nav')

    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">

                @section('content')

                @show()

            </div>
        </div>

    </div>
    @include('backend.common.footer')
    @include('backend.common.common-end')
