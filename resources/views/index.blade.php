<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>JobWeb</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <style>
      #app {
        padding: 25px 0;
      }
    </style>
  </head>
  <body>
    <div id="app">
      <div class="container">
        <user-profile-form></user-profile-form>
      </div>
    </div>
    <!-- Scripts -->
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
  </body>
</html>
