<?php
use App\Libraries\CropAvatar;

if (! function_exists('uploadImg')) {
    /**
     * @param $data
     * @param $file
     * @param $path
     * @return CropAvatar
     */
    function uploadImg($data, $file, $path)
    {
        return new CropAvatar($data->avatar_src, $data->avatar_data, $file, $path);
    }
}

if (! function_exists('ossPut')) {

    function ossPut($file = '', $contents)
    {
        Storage::put($file, $contents);
        return true;
    }
}


if (! function_exists('ossGet')) {
    /**
     * @param string $file
     * @param string $folder
     * @return mixed
     */
    function ossInnerGet($file = '', $folder = 'material')
    {
        header('Content-Type:image/png');
        $file = $folder . '/' . $file;
        return Storage::get($file);
    }
}

if (! function_exists('ossOutterGet')) {

    function ossOutterGet($path = '')
    {
        return env('OSS_CDN_BASE') . $path;
    }
}

if (! function_exists('pornCheck')) {

    function pornCheck(array $images)
    {
        $pornCheckRepository = new \App\Repositories\PornCheckRepository();
        if(env('PORN_SWITCH', false)){
            return $pornCheckRepository->addImageDetection($images , 'false');
        }
        return false;
    }
}


if (! function_exists('getTemplateCacheKeyBy')) {

    function getTemplateCacheKeyBy($user)
    {
        return (int)$user . '-template';
    }
}


if (! function_exists('getResourcedByCdn')) {

    function getResourcedByCdn($resource)
    {
        return env('OSS_CDN_BASE') . $resource;
    }
}