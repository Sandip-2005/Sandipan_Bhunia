<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageUploadService
{
    public static function upload(UploadedFile $file, string $directory = 'uploads'): string
    {
        // Create directory if it doesn't exist
        $uploadPath = public_path($directory);
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        // Generate unique filename
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        
        // Move file to public directory
        $file->move($uploadPath, $filename);
        
        return $filename;
    }

    public static function delete(string $filename, string $directory = 'uploads'): bool
    {
        $filePath = public_path($directory . '/' . $filename);
        
        if (File::exists($filePath)) {
            return File::delete($filePath);
        }
        
        return false;
    }

    public static function getUrl(string $filename, string $directory = 'uploads'): string
    {
        return asset($directory . '/' . $filename);
    }
}