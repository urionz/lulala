<?php
/**
 * Created by PhpStorm.
 * User: urionz
 * Date: 2017/1/6
 * Time: 20:05
 */

namespace App\Repositories;


use App\Models\Material;
use App\Models\Template;
use Auth;
use Illuminate\Support\Facades\Storage;

class MaterialRepository
{
    protected $cropperRepository;
    protected $requestFileInstance;
    protected $fileOriginName;
    protected $cropper;
    protected $path;

    public function __construct(CropperRepository $cropperRepository)
    {
        $this->cropperRepository = $cropperRepository;
    }
    
    public function remove(array $ids, $instance = '')
    {
        $instance = $instance ? $instance : Material::latest();
        return $instance->whereIn('id', $ids)->ofOwn(Auth()->user()->id)->delete();
    }

    public function fileRequestHandle($request, $path = 'material')
    {
        $this->requestFileInstance = $request->file('avatar_file');
        $this->path = '/uploads/' .$path. '/';
        $strPrefix = $this->path . str_random(32);
        $this->fileOriginName = $strPrefix . '.origin.' . $this->requestFileInstance->extension();
        $this->requestFileInstance->storeAs('', $this->fileOriginName, env('FILE_DRIVER'));
        $this->cropper = $this->cropperRepository
                              ->setSrc($this->requestFileInstance->path())
                              ->setDist(PUBLIC_PATH() . $strPrefix . '.' . $this->requestFileInstance->extension())
                              ->setData($request->get('avatar_data'))
                              ->crop()
                              ->getResult()['dist'];
        Storage::put($strPrefix . '.' . $this->requestFileInstance->extension(), file_get_contents($this->cropper));
        return $this;
    }

    public function store()
    {
        $materialArr = $this->getAddr();
        if(pornCheck((array)$materialArr['original'])){//检测为黄图
            Storage::delete([
                $this->path . basename($this->cropper),
                $this->fileOriginName
            ]);
            $response = array(
                'state' => 400,
                'result' => '您上传的图片被系统鉴定存在色情、暴力内容，已被清除!'
            );
            return $response;
        }
        $materials = new Material($materialArr);
        $result = Auth::user()->materials()->save($materials);
        $response = array(
            'state'  => 200,
            'result' => $result
        );
        return $response;
    }

    public function storeAvatar()
    {
        $materialArr = $this->getAddr();
        if(pornCheck((array)$materialArr['original'])){//检测为黄图
            Storage::delete([
                $this->path . basename($this->cropper),
                $this->fileOriginName
            ]);
            $response = array(
                'state' => 400,
                'result' => '您上传的图片被系统鉴定存在色情、暴力内容，已被清除!'
            );
            return $response;
        }
        $response = array(
            'state'  => 200,
            'result' => $materialArr
        );
        return $response;
    }

    public function getAddr()
    {
        if(env('FILE_DRIVER') == 'oss'){
            unlink($this->cropper);
            return [
                'material' => ossOutterGet($this->path . basename($this->cropper)),
                'original' => ossOutterGet($this->fileOriginName)
            ];
        }

        return [
            'material' => '/uploads/material/' . basename($this->cropper),
            'original' => $this->fileOriginName
        ];
    }

    public function borderUpload()
    {
        if(env('FILE_DRIVER') == 'oss'){
            unlink($this->cropper);
            return [
                'state' => 200,
                'result' => ossOutterGet($this->path . basename($this->cropper))
            ];
        }
        return [
            'state' => 200,
            'result' => $this->path . basename($this->cropper)
        ];
    }
}