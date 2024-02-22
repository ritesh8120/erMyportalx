<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Repositories\AssignRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    
    /**
     * Method __construct
     *
     * @param protected $userRepository [explicite description]
     * @param protected $taskRepository [explicite description]
     * @param protected $assignRepository [explicite description]
     *
     * @return void
     */
    public function __construct(protected UserRepository $userRepository, protected TaskRepository $taskRepository, protected AssignRepository $assignRepository)
    {
        
    }
        
    /**
     * Method index
     *
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return TaskResource::collection(
                $this->taskRepository->taskList($request->all())
            );
        }
        return view('admin.task.index');
    }
    
    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        $employees = $this->userRepository->getEmployee();
        return view('admin.task.addEdit', compact('employees'));
    }
    
    /**
     * Method store
     *
     * @param TaskRequest $request [explicite description]
     *
     * @return void
     */
    public function store(TaskRequest $request)
    {
        try {
            DB::beginTransaction();
            $task = $this->taskRepository->create($request->except(['_token', 'proengsoft_jsvalidation']));
            $request->merge(['task_id' => $task->id]);
            $this->assignRepository->AssignTask($request->all());
            return $this->successResponse(['redirectUrl' => route('task.index'), 'message' => __('messages.task_created')]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
