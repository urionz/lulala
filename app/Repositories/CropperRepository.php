<?php
/**
 * Created by PhpStorm.
 * User: urionz
 * Date: 2017/1/6
 * Time: 20:05
 */

namespace App\Repositories;


class CropperRepository
{
    private $_src;
    private $_type;
    private $_extension;
    private $_data;
    private $_dist;
    private $msg;

    public function __construct()
    {
        
    }

    public function setSrc($src)
    {
        if (!empty($src)) {
            $type = exif_imagetype($src);
            if ($type) {
                $this->_src = $src;
                $this->_type = $type;
                $this->_extension = image_type_to_extension($type);
            }
        }

        return $this;
    }

    public function setData($data) {
        if (!empty($data)) {
            $this->_data = json_decode(stripslashes($data));
        }
        return $this;
    }

    public function setDist($data) {
        $this->_dist = $data;
        return $this;
    }

    public function crop() {
        if (!empty($this->_src) && !empty($this->_data)) {
            switch ($this -> _type) {
                case IMAGETYPE_GIF:
                    $src_img = imagecreatefromgif($this->_src);
                    break;

                case IMAGETYPE_JPEG:
                    $src_img = imagecreatefromjpeg($this->_src);
                    break;

                case IMAGETYPE_PNG:
                    $src_img = imagecreatefrompng($this->_src);
                    break;
            }

            if (!$src_img) {
                $this -> msg = "图片读取失败";
                return;
            }

            $size = getimagesize($this->_src);
            $size_w = $size[0]; // natural width
            $size_h = $size[1]; // natural height

            $src_img_w = $size_w;
            $src_img_h = $size_h;

            $degrees = $this->_data -> rotate;

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

            $tmp_img_w = $this->_data -> width;
            $tmp_img_h = $this->_data -> height;
            $dst_img_w = $this->_data -> width;
            $dst_img_h = $this->_data -> height;

            $src_x = $this->_data -> x;
            $src_y = $this->_data -> y;

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
                if (!imagepng($dst_img, $this->_dist)) {
                    $this -> msg = "保存裁剪文件失败！";
                }
            } else {
                $this -> msg = "图片裁剪失败！";
            }

            imagedestroy($src_img);
            imagedestroy($dst_img);
        }

        return $this;
    }

    public function getResult()
    {
        return [
            'dist' => $this->_dist,
            'message' => $this->msg
        ];
    }
}