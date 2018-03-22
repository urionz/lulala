<?php
/**
 * Created by PhpStorm.
 * User: urionz
 * Date: 2017/1/6
 * Time: 14:18
 */

namespace App\Repositories;

use Auth;
use App\Models\Material;
use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Cache;


class TemplateRepository
{
    private $_template;
    private $_request;
    private $_templateId;

    const PUBLISH = 'publish';
    const SAVE = 'save';

    /**
     * @return \Illuminate\Support\Collection
     */
    public function edit()
    {
        $user = [
            'materials' => $this->byUserIdGet(Auth::user()->id, new Material()),
            'templates' => $this->byUserIdGet(Auth::user()->id, new Template())
        ];
        $common = [
            'materials' => $this->byUserIdGet(10000, new Material()),
            'templates' => $this->byUserIdGet(10000, new Template())
        ];

        return collect(['user' => $user , 'common' => $common]);
    }

    public function preview()
    {
        return $this->_template;
    }

    /**
     * @param $instance
     * @param $userId
     * @return mixed
     */
    public function byUserIdGet($userId, $instance = '')
    {
        $instance = $instance ? $instance : Template::latest();
        return $instance->ofOwn($userId)->get()->toArray();
    }

    /**
     * @param Request $request 保存/发布数据处理
     * @return $this
     */
    public function handleRequest(Request $request)
    {
        $this->_request = $request->get('widgets');
        $this->_templateId = isset($this->_request['id']) ? $this->_request['id'] : null;

        if($this->_request['thumbnail']){
            $thumbnailBase = '/uploads/thumbnail/' . str_random(32) . '.png';
            $thumbnailPath = public_path() . $thumbnailBase;
            $this->_request['thumbnail'] = str_replace('data:image/png;base64,', '', $this->_request['thumbnail']);
            $this->_request['thumbnail'] = str_replace(' ', '+', $this->_request['thumbnail']);
            if(env('FILE_DRIVER') == 'oss'){
                $saveResult = ossPut($thumbnailBase, base64_decode($this->_request['thumbnail']));
                $this->_template['thumbnail'] = $saveResult ? ossOutterGet($thumbnailBase) : null;
            }else{
                $saveResult = file_put_contents($thumbnailPath, base64_decode($this->_request['thumbnail']));
                $this->_template['thumbnail'] = $saveResult ? $thumbnailBase : null;
            }
        }

        $this->_template['title'] = $this->_request['title'];
        $this->_template['widgets'] = json_encode($this->_request['gridData']);
        $this->_template['background'] = isset($this->_request['background']) ? $this->_request['background'] : null;
        $this->_template['border'] = isset($this->_request['border']) ? json_encode($this->_request['border']) : null;
        return $this;
    }

    /**
     * 保存/发布
     * @param $type
     * @return array
     */
    public function save($type)
    {
        if($this->isOwnTemplate($this->_templateId)){
            switch($type){
                case static::PUBLISH:
                    $this->_template['status'] = 1;
                    $this->setTemplateStatusByScope([
                        'ofOwn' => Auth::user()->id
                    ], 0)->update($this->_template, Template::ofId($this->_templateId)) &&
                    $this->_template = Template::find($this->_templateId);
                    break;
                case static::SAVE:
                    if($this->update($this->_template, Template::ofId($this->_templateId)))
                        $this->_template = Template::find($this->_templateId);
                    break;
            }
        }else{
            switch($type){
                case static::PUBLISH:
                    $this->_template['status'] = 1;
                    $this->setTemplateStatusByScope([
                        'ofOwn' => Auth::user()->id
                    ], 0);
                    break;
                case static::SAVE:
                    $this->_template['status'] = 0;
                    break;
            }

            $this->_template = $this->store($this->_template, Auth::user()->templates());
        }

        return [
            'status' => 200,
            'message' => 'success',
            'result' => $this->_template->toArray(),
            'location' => $type === static::PUBLISH ? route('show', Auth::user()->id) : ''
        ];
    }

    /**
     * 是否是自己模板
     * @param $templateId
     * @return bool
     */
    public function isOwnTemplate($templateId)
    {
        $template = Template::find($templateId);
        return $template && $template->user_id == Auth::user()->id;
    }

    /**
     * 通过scope设置模板状态
     * @param array $scopeArr = [
     *      //scope => arribute
     *      'ofOwn' => userId
     * ]
     * @param int $status
     * @return $this
     */
    public function setTemplateStatusByScope(array $scopeArr, $status = 0)
    {
        foreach($scopeArr as $scope => $arribute){
            $this->update(['status' => $status], Template::$scope($arribute));
        }
        return $this;
    }

    /**
     * @param $instance
     * @param array $template
     * @return mixed
     */
    public function store(array $template, $instance = '')
    {
        $instance = $instance ? $instance : Template::latest();
        return $instance->create($template);
    }

    /**
     * @param $instance
     * @param array $template
     * @return mixed
     */
    public function update(array $template, $instance = '')
    {
        $instance = $instance ? $instance : Template::latest();
        return $instance->update($template);
    }

    public function remove(array $ids, $instance = '')
    {
        $instance = $instance ? $instance : Template::latest();
        return $instance->whereIn('id', $ids)->ofOwn(Auth()->user()->id)->delete();
    }
}