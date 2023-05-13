<?php

namespace app\Services;

use App\Http\Requests\CreateAccountRequest;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
  public function login(LoginRequest $request)
  {

    $validated = $request->validated();

    try {
      $user = User::where('email', $validated['email'])->firstOrFail();
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    try {
      if (Hash::check($validated['password'], $user->getAuthPassword())) {
        $data = [
          'token' => $user->createToken(time())->plainTextToken,
          'user' => $user
        ];

        return response()->success(200, $data);
      } else {
        response()->error(401, 'Credentials do not match');
      }
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not login'));
    }
  }

  public function createAccount(CreateAccountRequest $request)
  {

    $validated = $request->validated();

    try {
      $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password'])
      ]);
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not create'));
    }

    return response()->success(201, $user);
  }
}
