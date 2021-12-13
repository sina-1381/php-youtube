<?php

namespace App\Http\Services\FileSaverService;

use App\Models\Channels;

class ImageSaverService implements FileService
{
    public function Save($file, $userID)
    {
        $destination_path = "./upload/user/";
        $image = "User-" . $userID . ".jpeg";
        $file->move($destination_path, $image);
        $channel = new Channels();
        $userChannel = $channel->newQuery()->where("users_id", $userID)->first();
        $userChannel["image"] = $destination_path . $image;
        $userChannel->update();
    }
}
