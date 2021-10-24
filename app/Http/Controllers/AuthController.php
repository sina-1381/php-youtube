<?php

namespace App\Http\Controllers;

use App\Events\CreateChannelEvent;
use App\Events\EmailSenderEvent;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\VerifyEmailResetPasswordRequest;
use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected $jwt;

    public function Register(RegisterRequest $request): JsonResponse
    {
        $users = new Users($request->only(["username", "email", "password"]));
        $users->save();
        event(new CreateChannelEvent($users));
        return response()->json($users);
    }

    public function ChangePassword(ChangePasswordRequest $request): JsonResponse
    {
        if ($request["password"] == $request["new_password"]) return response()->json("you cant use the same password", 400);
        $username = $request->user()->username;
        $new_pass = new Users($request->only(["password", "new_password"]));
        $user = $new_pass->newQuery()->where("username", $username)->first();
        if (Hash::check($request["password"], $user["password"]) != true) {
            return response()->json("password is wrong", 400);
        }
        $user["password"] = $request["new_password"];
        $user->update();
        return response()->json("your new password has been updated to :" . $request["new_password"]);
    }

    public function ResetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $new_pass = new Users($request->only(["email"]));
        $user = $new_pass->newQuery()->where("email", $request["email"])->first();
        if ($user == null) {
            return response()->json("this email does not exist in our database");
        }
        $key = Str::random(32);
        Cache::add($key, $user["email"], 60);
        $data = array("name" => $user["username"], "key" => $key);
        event(new EmailSenderEvent($user, $data));
        return response()->json("check you email");
    }

    public function VerifyEmailResetPassword(VerifyEmailResetPasswordRequest $request): JsonResponse
    {
        $key = $request->header("key");
        if (Cache::has($key) == false) {
            return response()->json("email expired ... try again");
        }
        $email = Cache::get($key);
        $new_pass = new Users($request->only(["new_password"]));
        $user = $new_pass->newQuery()->where("email", $email)->first();
        $user["password"] = $request["new_password"];
        $user->update();
        return response()->json("Done");
    }
}
