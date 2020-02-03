<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div id="demo-app">
    <p v-text="count"></p>
    <comp :updater="updateCounter"></comp>
  </div>

  <script src="{{asset('js/app.js')}}"></script>
  
@verbatim
  <script type="text/x-template" id="comp-template">
    <div>
      <input type="text" name="name" v-model="$v.name.$model" @input="updateCounter($event.target.value)">
      <span v-if="!$v.name.required">Required.</span>
      <span v-if="!$v.name.alpha">Only letters allowed.</span>
      <pre>{{`Name: ${name}`}}</pre>
      <pre>{{$v.name}}</pre>
    </div>
  </script>
  <script>
  const Comp = {
      props: {updater: Function},
      data() {
        return {
          name: ''
        }
      },
      validations: {
        name: {
          required: val.required,
          alpha: val.alpha
        }
      },
      template: '#comp-template'
    };
        
    new Vue({
      el: '#demo-app',
      components: {Comp},
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
@endverbatim
</body>
</html>