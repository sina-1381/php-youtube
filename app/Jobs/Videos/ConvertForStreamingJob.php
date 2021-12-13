<?php

namespace App\Jobs\Videos;

use App\Jobs\Job;
use App\Models\Channels;
use App\Models\Videos;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video;
use Illuminate\Support\Facades\File;

class ConvertForStreamingJob extends Job
{
    public $path;
    public $userID;

    public function __construct($path, $userID)
    {
        $this->path = $path;
        $this->userID = $userID;
    }

    public function handle(): void
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($this->path);
        $input = new Videos();
        $channel = new Channels();
        $usersChannel = $channel->newQuery()->where("users_id", $this->userID)->first();
        $input["channels_id"] = $usersChannel["id"];
        $input["video"] = "---";
        $input->save();
        $video->save(new Video\X264('aac'),
            base_path(env('VIDEO_PATH')) . $this->userID . '/' . $input["id"] . '.m3u8');
        File::delete($this->path);
    }
}
