<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Http\Services\FileSaverService\FileSaverService;
use App\Http\Services\FileSaverService\ImageSaverService;
use App\Http\Services\FileSaverService\VideoSaverService;
use Illuminate\Http\JsonResponse;

class FileController extends Controller
{
    public function Upload(UploadFileRequest $request): JsonResponse
    {
        $userID = $request->user()->id;
        $original_filename = $request->file("file")->getMimeType();
        $file = $request["file"];
        $file = new FileSaverService($file, $userID);
        if ($original_filename == "image/jpeg") {
            $file->Process(new ImageSaverService);
        }
        if ($original_filename == "video/mp4") {
            $file->Process(new VideoSaverService);
        }

        return response()->json("Done");
    }
}
