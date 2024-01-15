<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterAuthRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use generalTrait;

    public function register(RegisterAuthRequest $request){
        // return $request;
        // validation  hash password
        $data =$request->validated(); //request after validated
        $data['password'] = Hash::make($request->password);
        //insert db
      
        $user = User::create($data);
        $user ->token = 'Bearer '.$user->createToken($request->device_name);// 4|47jgR7Lt6zfFOKDLRzaaZh1DnjMGsVWjZuOTrQUL201bb5cb
        // return $user;
        return $this->returnData((object)['user'=>$user], "register completed", 201);//data with token
    }
    public function sendCode(Request $request){
        // user, token -->header
        $token = $request->header('Authorization');
        $authUser = Auth::guard('sanctum')->user();
        $code = rand(10000,99999);

        $user= User::find($authUser->id);
        $user->code = $code;
        $user->save();
        //send mail
        $user->token = $token;
        // data user +token
        return $this->returnData((object)['user'=>$user], "Code send", 200);//data with token
    }
    public function verifyCode(Request $request){
        // code ---> body --->validation
        $rules = [
            'code'=>['required', 'integer', 'digits:5', 'exists:users']
        ];
        $request->validate($rules);
        // get user from token header
        $authUser = Auth::guard('sanctum')->user();// mobile application
        $token = $request->header('Authorization');
        // get user db
        $user =User::find($authUser->id); // from db
        // check code 
        // email_verified_at
        if($request->code == $authUser->code){
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
            $user->token =$token;
            return $this->returnData((object)['user'=>$user], "Correct Code", 200);//data with token
        }else{
            $user->token =$token;
            return $this->returnData((object)['user'=>$user], "Wrong Code", 200);//data with token
        }

    }

    public function login(Request $request){
        // validation 
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/'],
        ];
        $request->validate($rules);
        $user = User::where('email','=',$request->email)->first(); //user from db
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = 'Bearer '. $user->createToken($request->device_name)->plainTextToken;
        $user->token = $token;
        if(! $user->email_verified_at){
            return $this->returnData((object)['user'=>$user], "Not Verified", 401);//data with token
        }
        return $this->returnData((object)['user'=>$user], "You are login", 401);//data with token
    }
    public function logout(){
        $authUser = Auth::guard('sanctum')->user();
        $authUser->currentAccessToken()->delete();
        return $this->returnSuccessMessage("You Have logout", 200);//data with token

    }
    

//    public function profile()
//    {
//        $authUser = Auth::guard('sanctum')->user();
//        return $this->returnData((object)['user'=>$authUser],"your profile",200);

//    }

//    public function verifyEmail(VerifyEmailAuthRequest $request)
//    {
//        $user = User::where('email',$request->email)->first();
//        $user->token = 'Bearer '.$user->createToken($request->device_name)->plainTextToken;
//        return $this->returnData((object)['user'=>$user],"Email Exists",200);
//    }

//    public function setNewPassword(SetNewPasswordAuthRequest $request)
//    {
//         $authUser = Auth::guard('sanctum')->user();
//         $user = User::find($authUser->id);
//         $user->password = Hash::make($request->password);
//         $user->save();
//         $user->token = $request->header('Authorization');
//         return $this->returnData((object)['user'=>$user],"Password Has Been Changed Successfully",200);

//    }

}
