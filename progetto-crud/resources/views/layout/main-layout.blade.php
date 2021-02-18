<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{ ASSET('/css/app.css')}}">
    <script src="{{ asset('/js/app.js')}}" charset="utf-8"></script>
  </head>
  <body>

    <div id="app">

      <div class="container">
        <div class="row">
          @include('components.header')
        </div>
        <div class="row">

          @yield('section')

        </div>
        <div class="row">
          @include('components.footer')
        </div>
      </div>

    </div>

  </body>
</html>
