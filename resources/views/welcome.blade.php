<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Passing user id for vue --}}
    @if (Auth::check())
        <meta name="user-id" content="{{ Auth::user()->id }}" />
    @endif
    <title>{{ env('app_name') }}</title>

    <!-- Vue -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    @if (Route::has('login'))
        @auth
            {{-- Authenticated user use vue calendar --}}
            <div id="root"></div>
        @else
            {{-- redirect to login --}}
            <script type="text/javascript">
                window.location.href = "{{ route('login') }}";
            </script>

        @endauth
        </div>
    @endif

</body>

</html>
