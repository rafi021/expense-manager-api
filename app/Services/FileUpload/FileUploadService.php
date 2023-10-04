<?php

namespace App\Services\FileUpload;

use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function imageUpload($request, $model, $path='public/uploads')
    {
        if($request->image !=null){
            $uploaded_file = $request->image;
            /** check if old file exist */
            if($model->image !=null){
                Storage::delete($model->image);
            }
            $file_upload_url = Storage::putFileAs($path, $uploaded_file, $model->id.'-main.jpg', 'public');
            return Storage::url($file_upload_url);
        }
        return;
    }
}
