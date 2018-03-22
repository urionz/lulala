<?php

namespace App\Modules\Template\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\Repositories\TemplateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cache;

class IndexController extends AuthController
{
    protected $templateRepository;

    public function __construct(TemplateRepository $templateRepository)
    {
        parent::__construct();
        $this->templateRepository = $templateRepository;
    }
    
    public function edit()
    {
        $collection = $this->templateRepository->edit();
        return view('template::edit', compact('collection'));
    }

    public function save(Request $request)
    {
        $response = $this->templateRepository->handleRequest($request)->save('save');
        return Response()->json($response);
    }

    public function publish(Request $request)
    {
        $response = $this->templateRepository->handleRequest($request)->save('publish');
        return Response()->json($response);
    }

    public function postPreview(Request $request)
    {
        $template = $this->templateRepository->handleRequest($request)->preview();
        $key = md5(serialize($template));
        if(!Cache::has($key)) Cache::forever($key, $template);
        $location = route('tpl.preview', $key);
        return response()->json(compact('location'));
    }

    public function preview($hash)
    {
        $template = Cache::get($hash);
        $template['widgets'] = json_decode($template['widgets']);
        $template['border'] = json_decode($template['border']);
        $template = json_encode($template);
        return view('template::preview', compact('template'));
    }

    public function delete(Request $request)
    {
        $response = $this->templateRepository->remove($request->get('ids'));
        return response()->json($response);
    }

    public function cors(Request $request)
    {
        $imageurl = $request->get('imageurl');
        if(Cache::has(base64_encode($imageurl))){
            $content = Cache::get(base64_encode($imageurl));
        }else{
            try{
                if(strpos($imageurl, 'http') === 0){//oss
                    $content = file_get_contents($imageurl);
                }else{//local
                    $content = Storage::disk('local')->has($imageurl) ? Storage::disk('local')->get($imageurl) : '';
                }
                Cache::forever(base64_encode($imageurl), $content);
            }catch (\Exception $e){

            }
        }
        return response($content, 200, ['Content-Type' => 'image/png']);
    }
}
