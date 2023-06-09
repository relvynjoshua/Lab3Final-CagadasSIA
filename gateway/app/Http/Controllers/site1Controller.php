<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\siteService;

class site1Controller extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @var siteService
     */

    public $siteService;

    public function __construct(siteService $siteService)
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

    public function index() 
    {
        return $this->successResponse($this->siteService->index());
    }

    public function show($id) 
    {
        return $this->successResponse($this->siteService->show($id));
    }
}