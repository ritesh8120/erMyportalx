<?php

namespace App\Repositories;

use App\Models\Assign;

class AssignRepository extends BaseRepository
{        
    /**
     * model
     *
     * @var mixed
     */
    protected $model;
    
    /**
     * Method __construct
     *
     * @param Assign $model [explicite description]
     *
     * @return void
     */
    public function __construct(Assign $model)
    {
        parent::__construct($model);  
        $this->model = $model;   
    }

    public function AssignTask(array $request)
    {
        if (!empty($request['assigned_to'])) {
            foreach ($request['assigned_to'] as $key => $assigned) {
                $data['user_id'] = $assigned;
                $data['task_id'] = $request['task_id'];
                $this->model->create($data);
            }
        }
        return true;
    }
        
    /**
     * Method taskIds
     *
     * @param int $userId [explicite description]
     *
     * @return void
     */
    public function taskIds(int $userId)
    {
        $query = $this->model->select('task_id')->where(['user_id' => $userId])->get();
        return $query->pluck('task_id');
    }
}