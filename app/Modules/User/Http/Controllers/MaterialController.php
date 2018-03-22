<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\Repositories\CropperRepository;
use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class MaterialController extends AuthController
{
    protected  $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        parent::__construct();
        $this->materialRepository = $materialRepository;
    }
    
    public function delete(Request $request)
    {
        $response = $this->materialRepository->remove($request->get('ids'));
        return response()->json($response);
    }

    public function upload(Request $request)
    {
        $response = $this->materialRepository->fileRequestHandle($request)->store();
        return response()->json($response);
    }

    public function borderUpload(Request $request)
    {
        $response = $this->materialRepository->fileRequestHandle($request)->borderUpload();
        return response()->json($response);
    }
}
