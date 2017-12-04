<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Daily Todo List</title>

        <!-- Icons -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <span class="d-inline-block align-top"><i class="fa fa-2x fa-list-alt"></i></span>
          To-Do List, get to it!
        </a>
            <a href="#addToTask">
            <span class="float-right">
              <i class="fa fa-2x fa-plus"></i>
            </span>
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
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
