<?php

namespace App\Http\Services\FileSaverService;

class FileSaverService
{
    public $file;
    public $userID;

    public function __construct($file, $userID)
    {
        $this->file = $file;
        $this->userID = $userID;
    }

    public function Process(FileService $type)
    {
        return $type->Save($this->file, $this->userID);
    }
}
