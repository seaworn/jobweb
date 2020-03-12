<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\User::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = collect($request->validate([
            'username'=> '',
            'email'=> '',
            'password'=> '',
            'role'=> ''
        ]));
        $user = User::create($input->only(['username', 'email', 'password'])->all());
        $user->assignRole($input->get('role'));
        return ['user'=> $user, 'message'=> 'User created successfully.'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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
        $user->roles()->attach(Role::whereName('basic')->get());
        return [
            'session' => ['login' => true, 'user' => $user, 'accessToken' => $this->generateToken($user)],
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
