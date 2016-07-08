<?php
/**
 * Created by PhpStorm.
 * User: van
 * Date: 08/07/2016
 * Time: 10:06
 */
use App\Exceptions\InvalidParameterException;

function uploadImg($file)
{
    try {
        $extension = $file['image']->getClientOriginalExtension();
        $fileName = 'user_' . time() . $file['image']->getFilename() . '.' . $extension;

        Storage::disk('public_folder')->put($fileName, File::get($file['image']));
        return $fileName;

    } catch (Exception $e) {
        throw new InvalidParameterException();
    }
}
