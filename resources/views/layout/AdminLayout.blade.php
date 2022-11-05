<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{env('APP_NAME')}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

{{--todo head links--}}
    <x-link.head-link></x-link.head-link>
{{--todo section style--}}
    @yield('styles')
</head>

<body>
{{--todo  nav bar--}}
<x-bar.nav-bar></x-bar.nav-bar>
{{--todo side bar--}}
<x-bar.side-bar :items="$sidebar"></x-bar.side-bar>


<main id="main" class="main">


    @yield('content')

</main>
{{--todo footer--}}
<x-bar.bottom-bar></x-bar.bottom-bar>


{{--todo script links--}}
<x-link.script-link></x-link.script-link>
{{--todo section scripts--}}
@yield('scripts')
</body>

</html>
