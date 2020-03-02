<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;

class ApiAuthController extends Controller
{
  private function generateToken($user = null)
  {
    $user = $user ?? auth()->user();
    return $user->createToken('authToken')->accessToken;
  }

  public function register(Request $request)
  {
    $input = $request->validate([
      'username' => 'required|string|min:2|max:60',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8|confirmed',
    ]);
    $user = User::create($input);
    $user->role()->attach(Role::whereName('basic')->get());
    return [
      'session' => ['login' => true, 'username' => $user->username, 'accessToken' => $this->generateToken($user)],
      'message' => 'Registration successful.'
    ];
  }

  public function login(Request $request)
  {
    $input = $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required'
    ]);
    // $client = new \GuzzleHttp\Client();
    // try {
    //     $response = $client->post(config('services.passport.token_url'), [
    //         'form_params'=> [
    //             'grant_type'=> 'password',
    //             'client_id'=> config('services.passport.client_id'),
    //             'client_secret'=> config('services.passport.client_secret'),
    //             'username'=> $request->email,
    //             'password'=> $request->password,
    //             'scope'=> ''
    //         ]
    //     ]);
    //     return $response->getBody();
    // } catch (\GuzzleHttp\Exception\RequestException $e) {
    //     $code = $e->getStatusCode();
    //     if ($code == 400) {
    //         return response()->json(['message'=> 'Invalid request. Enter email and password.'], $code);
    //     } else if ($code == 401) {
    //         return response()->json(['message'=> 'Invalid credentials. Try again.'], $code);
    //     }
    //     return response()->json(['message'=> 'Sorry. Something went wrong.'], $code);
    // }

    if (!auth()->attempt($input)) {
      return response()->json(['message' => 'Invalid credentials.'], 401);
    }
    return [
      'session' => ['login' => true, 'user' => auth()->user(), 'accessToken' => $this->generateToken()],
      'message' => 'Login successful.'
    ];
  }

  public function logout()
  {
    auth()->user()->token()->revoke();
    return ['login' => false, 'message' => 'Logged out.'];
  }
}
