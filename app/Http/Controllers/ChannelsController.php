<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;

class ChannelsController extends Controller
{
    public function UpdateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $channel = new \App\Models\Channels($request->only(["name", "description", "image"]));
        $username = $request->user()->username;
        $userId = $request->user()->id;
        $user = (object)['image' => ""];
        $userChannel = $channel->newQuery()->where("users_id", $userId)->first();
        $userChannel["name"] = $request["name"];
        $userChannel["description"] = $request["description"];
        if ($request->hasFile("image")) {
            $original_filename = $request->file("image")->getClientOriginalName();
            $original_filename_arr = explode(".", $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = "./upload/user/";
            $image = 'User-' . $username . '.' . $file_ext;

            if ($request->file('image')->move($destination_path, $image)) {
                $user->image = '/upload/user/' . $image;
            } else {
                return response()->json('Cannot upload file');
            }
        } else {
            return response()->json('File not found');
        }
        $userChannel["image"] = $user->image;
        $userChannel->update();
        return response()->json($userChannel);
    }
}
