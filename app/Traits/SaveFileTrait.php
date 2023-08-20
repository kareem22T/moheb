<?php
namespace App\Traits;
trait SaveFileTrait
{
   function saveFile($photo, $folder, $name)
   {
       $file_extension =
       $photo->getClientOriginalExtension();
       $file_name =  $name . '.' . $file_extension;
       $path = $folder;
       $photo->move($path, $file_name);
       return $file_name;
   }
}
