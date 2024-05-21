<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // create new employee
    public function create(Request $r){
        $validated = $r->validate([
            'name' => 'required',
            'id_num' => 'required|unique:employees',
            'home_num' => 'required',
            'phone_num' => 'required',
            'birth' => 'required|date',
            'join' => 'required|date',
            'edu' => 'required' ,
            'section' => 'required'
        ]);

        $employee = new Employee;
 
        $employee->name = $r->name;
        $employee->id_num = $r->id_num;
        $employee->home_num = $r->home_num;
        $employee->phone_num = $r->phone_num;
        $employee->birth = $r->birth;
        $employee->join = $r->join;
        $employee->edu = $r->edu;
        $employee->section = $r->section;
        $employee->status = true; 
        $employee->save();

        return response()->json([
            'status' => 1 ,
            'message' => 'employee enrolled successfully'
        ]);
    }
    //update employee details
    public function update(Request $r){
        $validated = $r->validate([
            'id' => 'required' ,
            'name' => 'required',
            'id_num' => 'required',
            'home_num' => 'required',
            'phone_num' => 'required',
            'birth' => 'required|date',
            'join' => 'required|date',
            'edu' => 'required' ,
            'section' => 'required' ,
            'status' => 'required|boolean'
        ]);
        $employee=Employee::where('id', $r->id)->select()->first();
        if(empty($employee)){
            return response()->json([
                'status' => 0 ,
                'message' => 'employee is not exsist'
            ]);
        }else{
            Employee::where('id', $r->id)->update([
            'name' => $r->name ,
            'id_num' => $r->id_num,
            'home_num' => $r->home_num ,
            'phone_num' => $r->phone_num ,
            'birth' => $r->birth ,
            'join' => $r->join ,
            'edu' => $r->edu ,
            'section' => $r->section ,
            'join' => $r->join ,
            'status' => $r->status
            ]);

            return response()->json([
                'status' => 1 ,
                'message' => 'employee updated successfully'
            ]);
        }
        
    }
    // update status
    public function update_status(Request $r){
        $validated = $r->validate([
            'id' => 'required' ,
            'status' => 'required'
        ]);
        if(empty(Employee::where('id', $r->id)->select()->first())){
            return response()->json([
                'status' => 0 ,
                'message' => 'employee is not exsist'
            ]);
        }else{
            Employee::where('id', $r->id)->update(['status' => $r->status]);
            return response()->json([
                'status' => 1 ,
                'message' => 'status updated successfully'
            ]);
        }
    }
    // delet employee
    public function delete(Request $r){
        $validated = $r->validate([
            'id' => 'required'
        ]);
        $employee = Employee::where('id', $r->id)->select()->first();
        if(empty($employee)){
            return response()->json([
                'status' => 0 ,
                'message' => 'employee is not exsist'
            ]);
        }else{
            $employee->delete();
            return response()->json([
                'status' => 1 ,
                'message' => 'employee deleted successfully'
            ]);
        }
    }
    // get employee details
    public function get(Request $r){
        $validated = $r->validate([
            'id' => 'required'
        ]);
        $employee = Employee::where('id', $r->id)->select()->first();
        if(empty($employee)){
            return response()->json([
                'status' => 0 ,
                'message' => 'employee is not exsist'
            ]);
        }else{
            return response()->json([
                'status' => 1 ,
                'message' => $employee
            ]);
        }
    }

}
