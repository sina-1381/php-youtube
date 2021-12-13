<?php

namespace App\Http\Services\FileSaverService;

use App\Jobs\Videos\ConvertForStreamingJob;
use Illuminate\Support\Str;

class VideoSaverService implements FileService
{
    public function Save($file, $userID)
    {
        $destination_path = base_path(env('VIDEO_PATH')) . $userID;
        $original_filename = $file->getClientOriginalName();
        $original_filename_arr = explode(".", $original_filename);
        $file_ext = end($original_filename_arr);
        $video = Str::random(20) . '.' . $file_ext;
        $file->move($destination_path, $video);
        $path = $destination_path . "/" . $video;
        dispatch(new ConvertForStreamingJob($path, $userID));
    }
}

