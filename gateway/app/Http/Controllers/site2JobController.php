<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\site2Service;

class site2JobController extends Controller
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
    
    public function index() 
    {
        return $this->successResponse($this->siteService->index());
    }

    public function show($id) 
    {
        return $this->successResponse($this->siteService->show($id));
    }
}