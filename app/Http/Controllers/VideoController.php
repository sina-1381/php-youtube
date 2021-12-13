<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadVideosRequest;
use App\Jobs\Videos\ConvertForStreamingJob;
use App\Models\Videos;
use Illuminate\Http\JsonResponse;
use App\Models\Channels;
use Illuminate\Support\Facades\File;


class VideoController extends Controller
{
    public function Upload(UploadVideosRequest $request): JsonResponse
    {
       /* $input = new Videos($request->only(["title", "description", "video"]));
        $channel = new Channels();
        $userId = $request->user()->id;
        $video = (object)['video' => ""];

        $usersChannel = $channel->newQuery()->where("users_id", $userId)->first();
        $input["channels_id"] = $usersChannel["id"];

        if ($request->hasFile("video")) {
            $original_filename = $request->file("video")->getClientOriginalName();
            $original_filename_arr = explode(".", $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/video/' . $userId . '/';
            $image = 'Channel_ID:' . $usersChannel["id"] . '-User_ID:' . $userId . '-Title:' . $request["title"] . '.' . $file_ext;

            if ($request->file('video')->move($destination_path, $image)) {
                $video->video = '/upload/video/' . $userId . '/' . $input["title"] . '.m3u8';
            } else {
                return response()->json('Cannot upload file');
            }
        } else {
            return response()->json('File not found');
        }

        $path = $destination_path . $image;
        $this->dispatch(new ConvertForStreamingJob($path, $input["title"], $userId));
        $input["video"] = $video->video;
        $input->save();
        File::delete($path);*/
        return response()->json("input");
    }

    public function Views(): JsonResponse
    {
        return response()->json('Cannot upload file');
    }
}
