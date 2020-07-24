<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Task;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * create task
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function createTask(Request $request, $id){
        //find user
        $user = User::find($id);

        //requesting and setting task input
        $input = $request->all();

        $input['user_id'] = $user['id'];

        $task = Task::create($input);

        return response()->json(['message' => 'User Task Created Successful', 'user' => $task,], 200);
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
     * user task delete
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function viewTask(Request $request, $id){
        $tasks = $request->user()->tasks()->with('appointment: id,user_id');

        return response()->json([200]);
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

        //delete tasks from user task
        $task->delete($request->all());

        return response()->json(['message' => 'Task deleted successfully', 'task' => null,], 204);
    }
}
