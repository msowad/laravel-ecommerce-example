<?php

namespace App\Http\Controllers;

use App\Models\Media;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;

class MediaController extends Controller
{
    public function __construct(
        public $modelType,
        public $file = null,
        public $path = null,
        public $folder = null,
        public $publicId = null,
    ) {
        //
    }

    public static function set($modelType, $file = null, $folder = null, $filename = null)
    {
        if ($file) {
            $name = $filename . '-' . time();
            // $name = $filename . '-' . time() . '.' . $file->extension();
            // $path = $file->storeAs($folder, $name, 'public');

            $result = $file->storeOnCloudinaryAs($folder, $name);

            $pid  = $result->getPublicId();
            $path = $result->getSecurePath();

            return new static($modelType, $file, $path, $folder, $pid);
        }
    }

    public function upload($modelId)
    {
        if ($this->file) {
            Media::create([
                'model_id'   => $modelId,
                'model_type' => $this->modelType,
                'url'        => $this->path,
                'public_id'  => $this->publicId,
            ]);
        }
    }

    public function replace($modelId)
    {
        if ($this->file) {
            $media = $this->delete($this->modelType, $modelId);

            if ($media) {
                $media->update([
                    'url'       => $this->path,
                    'public_id' => $this->publicId,
                ]);
            } else {
                $this->upload($modelId);
            }
        }
    }

    public static function delete($modelType, $modelId)
    {
        $media = Media::where('model_id', $modelId)
            ->where('model_type', $modelType)
            ->first();

        if ($media) {
            $ce = new CloudinaryEngine();
            $ce = $ce->destroy($media->public_id);
            // Storage::disk('public')->delete($media->photo_url);

            $media->delete();
        }
        return $media;
    }
}
