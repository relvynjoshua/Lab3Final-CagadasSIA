<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

class userController extends Controller
{
    use ApiResponser;

    private $request;

    public $timestamps = false;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    

    public function showUsers() {
        return $this -> successResponse(User::all());
    }


    public function showUser($id) {

        try{
        $user = User::findOrFail($id);
        return $this->successResponse($user);
    } catch (\Exception $exception ) {
        return $this->errorNotFound($id, 'Not Found', 404);
    }

    }

    public function addUser(Request $request){
        $rules = [
            'username' => 'required | max:20 | alpha_num',
            'password' => 'required | max:20 | alpha_num',
            'gender' => 'required|in:Male,Female'
        ];

        $validate = $this->validate($request, $rules);
        

        if ($validate) {
            $user = User::create($request->all());

            return $this->successResponse($user, 201);
        }
        else {
            return $this->ErrorResponse("Operation Cannot be done", 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();
 
            return $this->successResponse("User has been deleted");
        }

    }

    public function updateUser(Request $request, $id) {
        $rules = [
            'username' => 'required | max:20 | alpha_num',
            'password' => 'required | max:20 | alpha_num',
        ];

        $validate = $this->validate($request, $rules);

        if ($validate) {
            $user = User::findOrFail($id);

            $user->fill($request->all());


            if ($user->isClean()) {
                return $this-> ErrorResponse("At least one value must
                change", Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                $user->save();
                return $this->successResponse($user);
            }
        } else {
            return $this->serverError("Operation Cannot be done.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }





    }
    
}
