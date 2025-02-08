<?php

/**
 * @author	 : Vishal Kumar Sinha <vishalsinhadev@gmail.com>
 */

namespace App\Helper;

class FileHelper
{

    static public function handleUploadFile($file, $destination = '', $old = null)
    {
        if ($file) {
            $filenameWithExt = preg_replace('/\s/', '_', $file->getClientOriginalName());
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $fileNameToStore = $filename . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = UPLOAD_PATH . $destination;
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 755);
            }
            $file->move($destinationPath, $fileNameToStore);
            if ($old !== null) {
                $oldPath = $destinationPath . $old;
                if (file_exists($oldPath))
                    @unlink($oldPath);
            }
            return $fileNameToStore;
        }
        return null;
    }

    static public function hasImage($fileName)
    {
        $filePath = UPLOAD_PATH . $fileName;

        return is_file($filePath) && true;
    }

    static public function getFile($fileName, $defaultImage = '/logo.png')
    {
        if (self::hasImage($fileName)) {
            return UPLOAD_PATH . $fileName;
        }
        return asset('/assets/img/') . $defaultImage;
    }

    static public function removeImage($fileName)
    {
        if (self::hasImage($fileName)) {
            return @unlink(UPLOAD_PATH . $fileName) && true;
        }
        return false;
    }
}
