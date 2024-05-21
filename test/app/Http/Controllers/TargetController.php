<?php

namespace App\Http\Controllers;

use App\Models\target;
use Illuminate\Http\Request;

class TargetController extends Controller
{
     // add value to target point
     public function target_value(Request $r){
        $v = $r->validate([
            'price' => 'required'
            ]);
        $target = new target;
        $target->price = $r->price;
        $target->save();
        return response()->json([
            'status' => 1 , 
            'message' => 'target value created'
        ]);
    }
}
