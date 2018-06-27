<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $valid =[
            'email'=> ['options' => ['regexp' => '/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z-]+\.[a-zA-Z]{2,3}$/']],
            'password'=> ['options' => ['regexp' => '/^[a-zA-Z0-9]\w{3,14}$/']],
        ];
        $inputs=[];
        foreach ($valid as $key =>$val)
        {
            $preparedValue = trim(htmlentities($request[$key]));
            $inputs[$key]=filter_var($preparedValue,FILTER_VALIDATE_REGEXP,array('options'=> $val['options']));
        }
        $errors=[];
        foreach ($inputs as $key=>$val)
        {
            if($val==null || $val==false)
            {
                array_push($errors,$key);
            }
        }
        if($errors==[])
        {
            $user = $request->only('email','password');
            $queryConditions=['email'=>$user['email'],'password'=>hash('md5',$user['password'])];
            try{

                if(User::where($queryConditions)->get()->count())
                {
                    return response()->json(['success'=>true],200);
                }
            }catch (\Exception $e)
            {
                return response()->json(['success'=>false], 500);
            }
        }
            return response()->json(['success'=>false], 401);

    }
    public function register(Request $request)
    {
        $valid =[
            'name' =>  ['options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
            'surname'=>  ['options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
            'address'=> ['options' => ['regexp' => '/^[A-ZŁŚĆŹŻÓŃ]{1}+[a-ząęółśżźćń]{1,25}+\\s+[0-9]{1,3}$/']],
            'flatNumber' =>['options' => ['regexp' => '/[0-9]{1,3}/']],
            'zipCode'=> ['options' => ['regexp' => '/^[0-9]{2}-[0-9]{3}$/']],
            'city'=> ['options' => ['regexp' => '/^[A-ZŁŚĆŹŻÓŃ]{1}+[a-ząęółśżźćń]{1,25}$/']],
            'email'=> ['options' => ['regexp' => '/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z-]+\.[a-zA-Z]{2,3}$/']],
            'phone'=> ['options' => ['regexp' => '/^[0-9]{9,11}$/']],
            'password'=> ['options' => ['regexp' => '/^[a-zA-Z0-9]\w{3,14}$/']],
        ];
        $inputs=[];
        foreach ($valid as $key =>$val)
        {
            $preparedValue = trim(htmlentities($request[$key]));
            $inputs[$key]=filter_var($preparedValue,FILTER_VALIDATE_REGEXP,array('options'=> $val['options']));
        }
        $errors=[];
        foreach ($inputs as $key=>$val)
        {
            if($val==null || $val==false)
            {
                if($key==='flatNumber')
                {
                    $val=NULL;
                    continue;
                }
                array_push($errors,$key);
            }
        }
        if($errors==[])
        {
            try{
                $inputs['password']=hash('md5',$inputs['password']);
                User::create($inputs);
                return response()->json(['success'=>true],200);
            }catch(\Exception $e)
            {
                return response()->json(['success'=>false,'errors'=>'Server error'], 500);
            }

        }
        return response()->json(['success'=>false,'errors'=>$errors],401);
    }
    public function updateUser(Request $request)
    {
        $valid =[
            'email'=> ['options' => ['regexp' => '/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z-]+\.[a-zA-Z]{2,3}$/']],
            'password'=> ['options' => ['regexp' => '/^[a-zA-Z0-9]\w{3,14}$/']],
        ];
        $inputs=[];
        foreach ($valid as $key =>$val)
        {
                $preparedValue = trim(htmlentities($request[$key]));
                $inputs[$key]=filter_var($preparedValue,FILTER_VALIDATE_REGEXP,$valid[$key]);
        }
        $errors=[];
        foreach ($inputs as $key=>$val)
        {
            if($val==null || $val==false)
            {
                array_push($errors,$key);
            }

        }
        if($errors==[])
        {
            try
            {
                $inputs['password']=hash('md5',$inputs['password']);
                User::where('email', $request['email'])
                    ->update($inputs);
                return response()->json(['success'=>true],200);
            }catch(\Exception $e)
            {
                return response()->json(['success'=>false], 500);
            }
        }
        return response()->json(['success'=>false],401);
    }
}
