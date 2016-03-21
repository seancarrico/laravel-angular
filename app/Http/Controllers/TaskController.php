<?php

namespace App\Http\Controllers;

use App\Task;
use App\Traits\Uuid;
use Illuminate\Http\Request;

use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $tasks = Task::where('user_id', $user->id) ->get();

        return $tasks;
    }

    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        return Task::create([
            'id' => Uuid::generate(),
            'description' => $request['description'],
            'user_id' => $user->id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $task = Task::where('user_id', $user->id)->where('id',$id)->first();
        if($task){
            $task->completed = $request['completed'];
            $task->save();
            return  response()->json($task);
        }else{
            return response('Unauthoraized',403);
        }
    }

    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $task = Task::where('user_id', $user->id)->where('id',$id)->first();

        if($task){
            Task::destroy($task->id);
            return  response()->json($task);
        }else{
            return response('Unauthoraized',403);
        }
    }

}
