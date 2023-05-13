<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
  public function __construct(
    protected AuthService $auth
  ) {
  }

  public function login(LoginRequest $request)
  {
    return $this->auth->login($request);
  }

  public function createAccount(CreateAccountRequest $request)
  {
    return $this->auth->createAccount($request);
  }

  public function profile()
  {
    return response()->success(200, [
      'user' => auth()->user()
    ]);
  }

  public function logout()
  {
    auth()->user()->currentAccessToken()->delete();
    return response()->success(200, 'Logged out successfully');
  }
}
