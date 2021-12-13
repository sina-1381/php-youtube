<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Lumen\Http\Request;

class UploadFileRequest extends FromRequest
{
    public function rules()
    {
        $request = Request()->all();
        return [
            "file" => "required|mimes:jpeg,mp4",

           /* "title" => Rule::requiredIf(function () use ($request) {
                $mime="";
                if (isset($request["file"])){
                    $mime=$request["file"]->getMimeType();
                }

                if ($mime == "video/mp4"){
                    return true;
                }else {
                    return false;
                }
            }),
            "description" => Rule::requiredIf(function () use ($request) {
                $mime="";
                if (isset($request["file"])){
                    $mime=$request["file"]->getMimeType();
                }
                if ($mime == "video/mp4"){
                    return true;
                }else {
                    return false;
                }
            }),*/
        ];
    }
}
