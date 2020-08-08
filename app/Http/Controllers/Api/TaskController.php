<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Task;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * create task
     *
     * @param Request $request
     * @param $id // searches for a user by id and creates a task for the user
     * @return JsonResponse
     */
    public function createTask(Request $request, $id){
        //find user
        $user = User::find($id);

        //requesting and setting task input
        $input = $request->all();

        $input['user_id'] = $user['id'];

        $task = Task::create($input);

        return response()->json(['message' => 'User Task Created Successful', 'task' => $task,], 200);
    }

    /**
     * user task update
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function updateTask(Request $request, $id){
        //find task by id
        $task = Task::find($id);

        //task update
        $task->update($request->all());

        //save updated task
        $task->save();

        return response()->json(['message' => 'Task Updated Successfully', 'task' => $task], 200);
    }

    /**
     * show task
     *
     * @param $id
     * @return JsonResponse
     */
    public function viewTask($id){
        $task = Task::find($id);

        return response()->json(['task' => $task,],200);
    }

    /**
     * user task delete
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function deleteTask(Request $request, $id){
        //task id
        $task = Task::find($id);

        if ($task == null){
            return response()->json(['message' => 'No task or content to delete  for this id'], 200);
        }

        //delete tasks from user task
        $task->delete($request->all());

        return response()->json(['message' => 'Task deleted successfully', 'task' => null,], 200);//204 ->request processed successfully but no content to return
    }

    /**
     * Get all tasks for a user
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id){
        $task = DB::table('tasks')->where('user_id', '=', $id)->get();

        return response()->json(['message' => 'Successful', 'tasks' => $task], 200);
    }

    /**
     * Get all tasks for a user with status
     *incoming or past as the option for the $status parameter
     *
     * @param $status
     * @return JsonResponse
     */
    public function taskStatus($status){
        $task = DB::table('tasks')->where('status', '=', $status)->get();

        return response()->json(['message' => 'Successful', 'tasks' => $task], 200);
    }

    /**
     * Search for a user task or appointment
     *
     * @param $query
     * @return JsonResponse
    */
    public function search($query){
        $columns = [ 'appointment', 'type', 'status',];

        foreach ($columns as $column){
            $task = DB::table('tasks')->where(''.$column, '=', $query )->get();

            return  response()->json(['task' => $task,], 200);
        }
    }
}
