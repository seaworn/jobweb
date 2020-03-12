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
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top shadow">
      <div class="container">
        <router-link :to="{name: 'index'}" class="navbar-brand">
          {{ config('app.name', 'Laravel') }}
        </router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">

          </ul>
          <ul class="navbar-nav ml-auto" v-if="session.login === true">
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                @{{_.get(session, 'user.username')}}<span class="caret"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <router-link :to="{name: 'profile', params: {username: session.user.username}}" class="dropdown-item">
                  Profile</router-link>
                <router-link :to="{name: 'dashboard'}" v-if="_.get(session, 'user.givenRole.admin')"
                  class="dropdown-item">Dashboard</router-link>
                <a href="/logout" class="dropdown-item" @click.prevent="logout">Logout</a>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto" v-else>
            <li class="nav-item">
              <router-link :to="{name: 'login'}" class="nav-link">Login</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{name: 'register'}" class="nav-link">Register</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div id="notifications">
      <notifications />
    </div>
    <router-view />
  </div>
  <!-- Scripts -->
  <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script type="text/javascript">
    window.Laravel = {{
      !!
      json_encode([
        'csrf_token' => csrf_token(),
      ])
    }}
  </script>
</body>

</html>