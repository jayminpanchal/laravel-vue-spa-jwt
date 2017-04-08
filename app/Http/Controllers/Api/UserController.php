<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    use ApiResponse;

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                $this->setMeta('status', 'fail');
                $this->setMeta('message', 'Invalid Login details');
                return response()->json($this->setResponse());
            }
        } catch (JWTException $e) {
            $this->setMeta('status', 'fail');
            $this->setMeta('message', 'Server Error. Retry.');
            return response()->json($this->setResponse());
        }
        $this->setMeta('status', 'ok');
        $this->setMeta('message', 'Logged in successfully.');
        $user = JWTAuth::toUser($token)->makeHidden(['created_at', 'updated_at', 'id']);
        $this->setData('token', $token);
        $this->setData('user', $user);
        return response()->json($this->setResponse());
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $this->setMeta('status', 'ok');
        $this->setMeta('message', 'Successfully Registered');
        // all good so return the token
        return response()->json($this->setResponse());
    }

    public function getUser()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            $this->setMeta('status', 'fail');
            return response()->json($this->setResponse());
        }
        $this->setMeta('status', 'ok');
        $this->setData('user', $user->makeHidden(['created_at', 'updated_at', 'id']));
        return response()->json($this->setResponse());
    }
}