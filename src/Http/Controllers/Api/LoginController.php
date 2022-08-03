<?php

namespace Ogilo\AdminMd\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ogilo\AdminMd\Http\Resources\AdminResource;
use Ogilo\ApiResponseHelpers;

class LoginController extends Controller
{
    use ApiResponseHelpers;

    function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if (Auth::guard('admin')->check()) {
            $user = $request->user('admin');
            $token = $user->createToken('token');

            return $this->authSuccess($token->plainTextToken, new AdminResource($user));
        }

        return $this->respondWithError('Authentication failed', 401);
    }
}
