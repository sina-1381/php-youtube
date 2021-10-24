<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\Users;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    public function Subscribe(SubscribeRequest $request): JsonResponse
    {
        $userId = $request->user()->id;
        $user = Users::findOrFail($userId);
        $user->Users_Channels()->attach($request["channels_id"]);
        //  $user->Users_Channels()->detach($request["channels_id"]);
        return response()->json("done");
    }
}
