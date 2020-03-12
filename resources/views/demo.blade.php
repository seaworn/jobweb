<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div id="app">
  <p>{{$perm->links()}}</p>
    {{-- <comp :updater="updateCounter"></comp> --}}
  </div>
  
  <script src="{{asset('js/app.js')}}"></script>

  <script> 
    new Vue({
      el: '#app',
      // components: {Comp},
      data: {
        count: 0
      },
      methods: {
        updateCounter(value) {
          this.count = value || 0;
        }
      }
    });
  </script>
</body>
</html>