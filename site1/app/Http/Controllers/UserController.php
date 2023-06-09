<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Models\UserJob; 
use App\Models\User; 
use App\Traits\ApiResponser; 
use DB; 
use Illuminate\Http\Response;


Class UserController extends Controller {
    use ApiResponser;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // Get/show users
    public function getUsers()
    {
    
        $users = DB::connection('mysql')
        ->select("Select * from tbluser");

        return $this -> successResponse($users);
    }

    public function index(){
        $users = User::all();
        return $this -> successResponse($users);
    }
    
    // Add users
    public function addUser(Request $request){
        
        $rules = [
            'username' => 'required|max:50',
            'password' => 'required|max:50',
            'gender' => 'required|in:Male,Female',
            'jobid' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request,$rules);
        $userjob = UserJob::findOrFail($request->jobid);
        $users = User::create($request->all());
        return $this -> successResponse($users, Response::HTTP_CREATED);
    }

    // Get/show user
    public function show($id){

        $users = User::findOrFail($id);
        return $this -> successResponse($users);
        
    }

     // Update user
    public function updateUser(Request $request, $id)
    {
        $rules = [
            'username' => 'required|max:50',
            'password' => 'required|max:50',
            'gender' => 'required|in:Male,Female',
            'jobid' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request,$rules);
        $userjob = UserJob::findOrFail($request->jobid);
        $users = User::where('id', $id)->firstOrFail();
        $users->fill($request->all());
        

        if ($users->isClean()){
        return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $users->save();
        return $this -> successResponse($users);
    } 

    //  Delete user
    public function deleteUser($id) {
        $users = User::findOrFail($id);
        $users->delete();
        return $this -> successResponse('Deleted Successfully!');
    }
    
}


