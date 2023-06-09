<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\site2Service;

class site2Controller extends Controller
{
     use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @var site2Service
     */

     public $siteService;

    public function __construct(site2Service $siteService)
    {
        $this->siteService = $siteService;
    }

    public function showUsers() 
    {
        return $this->successResponse($this->siteService->showall());
    }

    public function showUser($id) 
    {
        return $this->successResponse($this->siteService->showUser($id));
    }

    public function createUser(Request $request) {
        return $this->successResponse($this->siteService->addUser($request->all()));
    }
    
    public function deleteUser($id) {
        return $this->successResponse($this->siteService->deleteUser($id));
    }

    public function patchUser(Request $data, $id) {
        return $this->successResponse($this->siteService->updateUser($data->all(), $id));
    }
}
