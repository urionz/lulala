<?php

namespace App\Modules\File\Http\Controllers;

use App\Models\User;
use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Storage;

class FileController extends Controller
{
    protected $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->middleware('auth');
        $this->materialRepository = $materialRepository;
    }

    public function Crop(Request $request)
    {
        $crop = uploadImg($request, $_FILES['avatar_file'], '/uploads/material/');

        $material = $crop -> getResult();

        $original = $crop->getOriginal();

        $message = $crop -> getMsg();

        $materials = new Material(['material' => $material, 'original' => $original]);

        $result = Auth::user()->materials()->save($materials);

        $response = array(
            'state'  => 200,
            'message' => $message,
            'result' => $result
        );

        return Response()->json($response);
    }

    public function upload(Request $request)
    {
        $upload =  uploadImg($request, $_FILES['avatar_file'], '/uploads/material/');
        $response = array(
            'state'  => 200,
            'message' => $upload->getMsg(),
            'result' => $upload->getResult()
        );
        return Response()->json($response);
    }

    public function setAvatar(Request $request)
    {
        $response = $this->materialRepository->fileRequestHandle($request, 'avatar')->storeAvatar();
        !is_string($response['result']) && Auth()->user()->update(['avatar' => $response['result']['material']]);
        return response()->json($response);
    }
}
