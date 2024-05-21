<?php

namespace App\Http\Controllers;

use App\Models\Maneger;
use App\Models\target;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ManegerController extends Controller
{
    // login
    public function login(Request $r){
        $v = $r->validate([
        'username' => 'required' ,
        'password' => 'required'
        ]);
        $maneger = Maneger::where('username', $r->username)->select()->first();
        if(empty($maneger)){
            return response()->json([
                'status' => 0,
                'message' => 'the username is not regestered'
            ]);
        }else{
            if($maneger->password == $r->password){
                Maneger::where('username', $r->username)->update(['status' => 1]);
                return response()->json([
                    'status' => 1 ,
                    'message' => 'logged in successfully'
                ]);
            }else{
                return response()->json([
                    'status' => 0 , 
                    'message' => 'invaild'
                ]);
            }
        }
    }
    //log out 
    public function out(){
        $id=1;
        $maneger = Maneger::where('id', $id)->select()->first();
        Maneger::where('id' , $id)->update(['status' => 0]);
        return response()->json([
            'status' => 1 , 
            'message' => 'logged out successfully'
            ]);
    }
    // change password
    public function password_change(Request $r){
        $v = $r->validate([
            'old' => 'required' ,
            'new' => 'required'
            ]);
        $id = 1;
        $maneger = Maneger::where('id', $id)->select()->first();
        if(empty($maneger)){
            return response()->json([
                'status' => 0,
                'message' => 'the username is not regestered'
            ]);
        }else{
            if($maneger->password == $r->old){
                Maneger::where('id', $id)->update(['password' => $r->new]);
                return response()->json([
                    'status' => 1 , 
                    'message' => 'password updated successfully'
                ]);
            }
            else{
                return response()->json([
                    'status' => 0 , 
                    'message' => 'old password is not correct'
                ]);
            }
        }
    }
   
    
}
