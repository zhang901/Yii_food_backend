<?php
/**
 * Created by Fruity Solution Co.Ltd.
 * User: Only Love
 * Date: 10/1/13 - 11:24 AM
 * 
 * Please keep copyright headers of source code files when use it.
 * Thank you!
 */

class FileUtils {
    const UPLOAD_DIR = 'uploads';

    const
        FILE_NAME = 'fileName',
        LOCATION_NAME = 'dir';

    public static function createInstance(){
        return new FileUtils();
    }

    /**
     * @param CUploadedFile $file the file will be uploaded
     * @param string $subPath the name of sub-folder in upload directory
     * @param string $oFile the name of old file
     * @return array include fileName and full directory to this file.
     */
    public function uploadYiiFile($file = null, $subPath = '', $oFile = ''){
        try{
            $uploadDir = Yii::getPathOfAlias(self::UPLOAD_DIR);
            if(!empty($subPath)){
                $uploadDir = $uploadDir . DIRECTORY_SEPARATOR . $subPath;
            }
            if(!file_exists($uploadDir)){
                mkdir($uploadDir, 0777, true);
            }
            // Create file name
            $fileName = time().'.'.$file->extensionName;
            if($file->saveAs($uploadDir.DIRECTORY_SEPARATOR.$fileName)){
                // Delete old image
                if(!empty($oFile) && file_exists($uploadDir.DIRECTORY_SEPARATOR.$oFile) && is_file($uploadDir.DIRECTORY_SEPARATOR.$oFile)){
                    unlink($uploadDir.DIRECTORY_SEPARATOR.$oFile);
                }
                return array(
                    self::FILE_NAME => $fileName,
                    self::LOCATION_NAME => $uploadDir.DIRECTORY_SEPARATOR.$fileName,
                );
            }
            return array();
        }catch (Exception $e){
            return array();
        }
    }
    public function downloadFile($fileName = '', $subPath = ''){
        $uploadDir = Yii::getPathOfAlias(self::UPLOAD_DIR);
        if(!empty($subPath)){
            $uploadDir = $uploadDir . DIRECTORY_SEPARATOR . $subPath;
        }
        if(file_exists($uploadDir.DIRECTORY_SEPARATOR.$fileName) && is_file($uploadDir.DIRECTORY_SEPARATOR.$fileName)){
            return Yii::app()->getRequest()->sendFile($fileName, @file_get_contents($uploadDir.DIRECTORY_SEPARATOR.$fileName));
        }else{
            return null;
        }
    }

    public static function resizeImage($file, $suffix = 'S', $size){
        $pathInfo = pathinfo($file);
        /*
         * Calculate size of new image
         *      max-width = 124
         *      max-height = 124
         */
        list($oriWith, $oriHeight) = getimagesize($file);
        $destWidth = $size['width'];
        $destHeight = $size['height'];
        if($oriWith>$destWidth && $oriHeight>$destHeight){
            if($oriWith/$oriHeight > $destWidth/$destHeight){
                $destHeight = $destWidth/$oriWith*$oriHeight;
            }else{
                $destWidth = $destHeight/$oriHeight*$oriWith;
            }
        }elseif($oriWith<$destWidth && $oriHeight<$destHeight){
            $destWidth = $oriWith;
            $destHeight = $oriHeight;
        }elseif($oriWith>$destWidth){
            $destHeight = $destWidth/$oriWith*$oriHeight;
        }elseif($oriHeight>$destHeight){
            $destWidth = $destHeight/$oriHeight*$oriWith;
        }

        /*
         * Save thumb image
         */
        $thumb = imagecreatetruecolor($destWidth,$destHeight);
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);
        $extension = strtolower($pathInfo['extension']);
        if($extension === "jpg" || $extension === "jpeg"){
            $source = @imagecreatefromjpeg("$file");
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $destWidth, $destHeight, $oriWith, $oriHeight);
            /* Thumbnail name */
            $destFile = $pathInfo['dirname'] . DIRECTORY_SEPARATOR . $suffix . $pathInfo['filename'] . '.' . $extension;
            @imagejpeg($thumb, $destFile);
            imagedestroy($thumb);
        }elseif($extension === "gif"){
            $source = @imagecreatefromgif("$file");
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $destWidth, $destHeight, $oriWith, $oriHeight);
            /* Thumbnail name */
            $destFile = $pathInfo['dirname'] . DIRECTORY_SEPARATOR . $suffix . $pathInfo['filename'] . '.' . $extension;
            @imagejpeg($thumb, $destFile);
            imagedestroy($thumb);
        }else{
            $source = @imagecreatefrompng("$file");
            $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
            imagefilledrectangle($thumb, 0, 0, $destWidth, $destHeight, $transparent);
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $destWidth, $destHeight, $oriWith, $oriHeight);
            /* Thumbnail name */
            $destFile = $pathInfo['dirname'] . DIRECTORY_SEPARATOR . $suffix . $pathInfo['filename'] . '.' . $extension;
            @imagepng($thumb, $destFile);
            imagedestroy($thumb);
        }
    }

    public static function moveFile($sour, $dest, $fileName){
        return rename($sour.DIRECTORY_SEPARATOR.$fileName, $dest.DIRECTORY_SEPARATOR.$fileName);
    }

    public function deleteDirectory($dir) {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir) || is_link($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!$this->deleteDirectory($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);
                if (!$this->deleteDirectory($dir . "/" . $item)) return false;
            };
        }
        return rmdir($dir);
    }

    public static function fileSize($file, $n){
        $size = filesize($file);
        if($size > 1024*1024*1024){
            return round($size/(1024*1024*1024), $n) . ' GB';
        }elseif($size > 1024*1024){
            return round($size/(1024*1024), $n) . ' MB';
        }elseif($size > 1024){
            return round($size/1024, $n) . ' KB';
        }else{
            return round($size, $n) . ' B';
        }
    }

    public static function removeDir($dir){
        if(file_exists($dir) && is_dir($dir)){
            // Normalise $path.
            $path = rtrim($dir, '/') . '/';

            // Remove all child files and directories.
            $items = glob($path . '*');

            foreach($items as $item) {
                is_dir($item) ? removeDir($item) : unlink($item);
            }

            // Remove directory.
            rmdir($path);
        }
    }
}