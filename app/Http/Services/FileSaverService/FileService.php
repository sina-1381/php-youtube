<?php

namespace App\Http\Services\FileSaverService;

interface FileService {
    public function Save($file, $userID);
}
