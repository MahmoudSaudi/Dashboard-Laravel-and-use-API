<?php

namespace App\Traits;

trait generalTrait{
    public function uploadPhoto($request,  $data, $folder){
        $photoname=time().'.'.$request->photo->extension();
        $request->photo->move(public_path('images\\'.$folder), $photoname);
        $data['photo']= $photoname;
        return $data;
    }

//response
// Data -->index, create, edit
// Message --> success, error update, delete, statuscode
    public function returnSuccessMessage($message="", $statusCode=200){
        return response()->json([
            'message'=>$message, 
            'error'=>(object)[],
            'data'=>(object)[]
        ],$statusCode);
    }
    public function returnErrorMessage($error = [], $message="", $statusCode=400){
        return response()->json([
            'message'=>$message, 
            'error'=>(object)$error,
            'data'=>(object)[]
        ],$statusCode);
    }
    public function returnData($data=[],$message="",$statusCode=200){
        return response()->json([
            'message'=>$message, 
            'error'=>(object)[],
            'data'=>(object)$data
        ],$statusCode);
    }


}