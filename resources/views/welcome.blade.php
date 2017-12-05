<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Daily Todo List</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
      @php
        use Carbon\Carbon;
        $today = Carbon::today()->toFormattedDateString();
      @endphp
      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <span class="d-inline-block align-top"><i class="fa fa-2x fa-list-alt"></i></span>
          To-Do List {{ $today }}, Get to it!
        </a>
      </nav>
        <div id="app" class="container-fluid">
            <to-do></to-do>
        </div>

        <div class="text-center">
            <div class="content">
                <div class="title m-3">
                    <small>@copyright Amanda Montana Pearce 2017</small>
                </div>
            </div>
        </div>

        <!-- using email.js to email what will become non-loggedin to -->
        <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
