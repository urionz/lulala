<?php
namespace App\Libraries;

use Illuminate\Support\Facades\Storage;

class CropAvatar{
    private $src;
    private $data;
    private $file;
    private $dst;
    private $orDst;
    private $type;
    private $extension;
    private $msg;
    private $original;
    private $path;

    function __construct($src, $data, $file, $path = '/uploads/material/') {
        $this -> setSrc($src);
        $this -> setData($data);

        $this -> setPath($path);

        $this -> setFile($file);

        $this -> crop($this -> src, $this -> dst, $this -> data);
    }

    private function setSrc($src) {
        if (!empty($src)) {
            $type = exif_imagetype($src);

            if ($type) {
                $this -> src = $src;
                $this -> type = $type;
                $this -> extension = image_type_to_extension($type);
                $this -> setDst();
            }
        }
    }

    private function setPath($path){
        $this->path = public_path() . $path;
        if(!is_dir($this->path)){
            if(!mkDirs(dirname($this->path))){
                return;
            }
            if(!mkdir($this->path, 0777)){
                return;
            }
        }
    }

    private function setData($data) {
        if (!empty($data)) {
            $this -> data = json_decode(stripslashes($data));
        }
    }

    private function setFile($file) {
        $errorCode = $file['error'];

        if ($errorCode === UPLOAD_ERR_OK) {
            $type = exif_imagetype($file['tmp_name']);

            if ($type) {
                $extension = image_type_to_extension($type);
                $name = date('YmdHis') . '.original' . $extension;
                $this->original = $this->path . $name;
                $this->orDst = 'material/' . $name;

                if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_JPEG || $type == IMAGETYPE_PNG) {

//                    if (file_exists($this->original)) {
//                        unlink($this->original);
//                    }
dd(Storage::get($file['tmp_name']));
                    $result = move_uploaded_file($file['tmp_name'], $this->original);

                    if ($result) {
                        $this -> src = $this->original;
                        $this -> type = $type;
                        $this -> extension = $extension;
                        $this -> setDst();
                    } else {
                        $this -> msg = '保存失败！';
                    }
                } else {
                    $this -> msg = '图片类型只允许: JPG, PNG, GIF';
                }
            } else {
                $this -> msg = '请上传图片文件！';
            }
        } else {
            $this -> msg = $this -> codeToMessage($errorCode);
        }
    }

    private function setDst() {
        $this -> dst = 'material/' . date('YmdHis') . '.png';
    }

    private function crop($src, $dst, $data) {
        if (!empty($src) && !empty($dst) && !empty($data)) {
            switch ($this -> type) {
                case IMAGETYPE_GIF:
                $src_img = imagecreatefromgif($src);
                break;

                case IMAGETYPE_JPEG:
                $src_img = imagecreatefromjpeg($src);
                break;

                case IMAGETYPE_PNG:
                $src_img = imagecreatefrompng($src);
                break;
            }

            if (!$src_img) {
                $this -> msg = "图片读取失败";
                return;
            }

            $size = getimagesize($src);
            $size_w = $size[0]; // natural width
            $size_h = $size[1]; // natural height

            $src_img_w = $size_w;
            $src_img_h = $size_h;

            $degrees = $data -> rotate;

            // Rotate the source image
            if (is_numeric($degrees) && $degrees != 0) {
                // PHP's degrees is opposite to CSS's degrees
                $new_img = imagerotate( $src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 0) );

                imagedestroy($src_img);
                $src_img = $new_img;

                $deg = abs($degrees) % 180;
                $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

                $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
                $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

                // Fix rotated image miss 1px issue when degrees < 0
                $src_img_w -= 1;
                $src_img_h -= 1;
            }

            $tmp_img_w = $data -> width;
            $tmp_img_h = $data -> height;
            $dst_img_w = $data -> width;
            $dst_img_h = $data -> height;

            $src_x = $data -> x;
            $src_y = $data -> y;

            if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
                $src_x = $src_w = $dst_x = $dst_w = 0;
            } else if ($src_x <= 0) {
                $dst_x = -$src_x;
                $src_x = 0;
                $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
            } else if ($src_x <= $src_img_w) {
                $dst_x = 0;
                $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
            }

            if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
                $src_y = $src_h = $dst_y = $dst_h = 0;
            } else if ($src_y <= 0) {
                $dst_y = -$src_y;
                $src_y = 0;
                $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
            } else if ($src_y <= $src_img_h) {
                $dst_y = 0;
                $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
            }

            // Scale to destination position and size
            $ratio = $tmp_img_w / $dst_img_w;
            $dst_x /= $ratio;
            $dst_y /= $ratio;
            $dst_w /= $ratio;
            $dst_h /= $ratio;

            $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

            // Add transparent background to destination image
            imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
            imagesavealpha($dst_img, true);

            $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

            if ($result) {
                if (!imagepng($dst_img, $dst)) {
                    $this -> msg = "保存裁剪文件失败！";
                }
            } else {
                $this -> msg = "图片裁剪失败！";
            }

            imagedestroy($src_img);
            imagedestroy($dst_img);
//            unlink($this->original);
        }
    }

    private function codeToMessage($code) {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
            $message = '图片大小超过最大限制2M';
            break;

            case UPLOAD_ERR_FORM_SIZE:
            $message = '图片大小超过最大限制2M';
            break;

            case UPLOAD_ERR_PARTIAL:
            $message = 'The uploaded file was only partially uploaded';
            break;

            case UPLOAD_ERR_NO_FILE:
            $message = '没有文件被上传';
            break;

            case UPLOAD_ERR_NO_TMP_DIR:
            $message = 'Missing a temporary folder';
            break;

            case UPLOAD_ERR_CANT_WRITE:
            $message = 'Failed to write file to disk';
            break;

            case UPLOAD_ERR_EXTENSION:
            $message = 'File upload stopped by extension';
            break;

            default:
            $message = '上传错误！';
        }

        return $message;
    }

    public function getResult() {
        return !empty($this -> data) ? '/' . $this -> dst : '/' . $this -> src;
    }

    public function getMsg() {
        return $this -> msg;
    }

    public function getOriginal()
    {
        return !empty($this -> data) ? '/' . $this -> orDst : '/' . $this -> src;
    }
}
?>
