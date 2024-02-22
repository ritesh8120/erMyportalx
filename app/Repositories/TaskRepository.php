<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends BaseRepository
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
     * @param Task $model [explicite description]
     *
     * @return void
     */
    public function __construct(Task $model, protected AssignRepository $assignRepository)
    {
        parent::__construct($model);  
        $this->model = $model;
    }
    
    /**
     * Method taskList
     *
     * @param $data $data [explicite description]
     * @param $pagination $pagination [explicite description]
     *
     * @return void
     */
    public function taskList($data, $pagination = true)
    {
        $start = $data['start'] ?? 0;
        $length = $data['length'] ?? 10;
        $size = $data['size'] ?? 10;
        $sortColumn = $data['sortColumn'] ?? 'id';
        $sortDirection = $data['sortDirection'] ?? 'desc';
        $query = $this->model->limit($length);
        $query->offset($start);
        $query->orderBy($sortColumn, $sortDirection);
        return $query->paginate();
    }
    
    /**
     * Method getTask
     *
     * @param $userId $userId [explicite description]
     *
     * @return void
     */
    public function getTask($userId = '')
    {
        $query = $this->model
        ->when($userId, 
            function ($q) use ($userId) {
            $q->whereIn('id', $this->assignRepository->taskIds($userId));
        });
        return $query->get();
    }
}