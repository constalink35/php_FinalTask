<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Tag;
use Illuminate\Http\Request;


class FileController extends Controller
{


   public function getDir(){
        //проверяем есть ли папка tmp, если нет создаем
        $dir = '.' . DIRECTORY_SEPARATOR . 'img';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return $dir. DIRECTORY_SEPARATOR ;
    }

    public function save(Request $request)
    {
        $request->validate([
            'description' => 'max:140',
            'tags' => 'max:140',
            'fileUpload' => 'required|max:6',
            'fileUpload.*' => 'mimes:jpeg, jpg, png, |max:2048']);

        $description = $request->description;

        if ($request->hasFile('fileUpload')) {
            $files = $request->file('fileUpload');
            foreach ($files as $file) {

                $destinationPath = $this->getDir(); // upload path
                $profilefile = uniqid() . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $profilefile);

                $insert['bigpict'] = $destinationPath . $profilefile;
                if (self::resizePict($destinationPath . $profilefile, $destinationPath . 's_' . $profilefile)) {
                    $insert['smallpict'] = $destinationPath . 's_' . $profilefile;
                }
                $insert['smallpict'] = $destinationPath . 's_' . $profilefile;
                $insert['user_id'] = \Auth::user()->id;
                $insert['descript'] = $description;
                $insert['created_at'] = new \DateTime();

                $check = Picture::insertGetId($insert);
                $picture=Picture::find((int)$check);

                $tagIds =TagController::store($request->tags);
                $picture->tags()->sync($tagIds);
            }
        }


       return 'Файлы успешно загружены!';
    }

    public function resizePict($filename, $filename_dest)
    {


        // задание максимальной ширины и высоты
        $width = 1000;
        $height = 1000;


        list($width_orig, $height_orig) = getimagesize($filename);

        $ratio_orig = $width_orig / $height_orig;

        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }

        // ресэмплирование
        $image = imagecreatefromjpeg($filename); // ресурс из источника

        $image_p = imagecreatetruecolor($width, $height); //ресурс приемника
        imagefill($image_p, 0, 0, 0xffffff); //файл приемника

        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        return imagejpeg($image_p, $filename_dest);

    }
}
