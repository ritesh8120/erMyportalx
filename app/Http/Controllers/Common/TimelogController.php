<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimeLogRequest;
use App\Http\Resources\TimeLogResource;
use App\Models\User;
use App\Repositories\TaskRepository;
use App\Repositories\TimelogRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelogController extends Controller
{    
    /**
     * Method __construct
     *
     * @param protected $timelogRepository [explicite description]
     *
     * @return void
     */
    public function __construct(protected TimelogRepository $timelogRepository, protected TaskRepository $taskRepository, protected UserRepository $userRepository)
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
            $post = $request->all();
            if(Auth::user()->role == User::EMPLOYEE){
                $post['user_id'] = Auth::user()->id;
            }
            return TimeLogResource::collection(
                $this->timelogRepository->getTimeLog($post)
            );
        }
        return view('common.timelog.index');
    }
        
    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        $user = Auth::user();
        $employees = $this->userRepository->getEmployee();
        $hoursArray = [];
        for ($hour = 0; $hour < 24; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 15) {
                $hoursArray[] = sprintf('%02d:%02d', $hour, $minute);
            }
        }
        return view('common.timelog.addEdit', compact('employees', 'user', 'hoursArray'));
    }

        
    /**
     * Method store
     *
     * @param TimeLogRequest $request [explicite description]
     *
     * @return void
     */
    public function store(TimeLogRequest $request)
    {
        try {
            $this->timelogRepository->addTimeLog($request->except(['_token', 'proengsoft_jsvalidation']));
            return $this->successResponse(['redirectUrl' => route('timelog.index'), 'message' => __('messages.log_time_created')]);
        } catch (\Exception $ex) {
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
    
    /**
     * Method addMore
     *
     * @return void
     */
    public function addMore(Request $request)
    {
        $count = $request->count;
        $hoursArray = [];
        for ($hour = 0; $hour < 24; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 15) {
                $hoursArray[] = sprintf('%02d:%02d', $hour, $minute);
            }
        }
        return view('common.timelog.model.addMore', compact('hoursArray', 'count'))->render();
    }
}
