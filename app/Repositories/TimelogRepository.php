<?php

namespace App\Repositories;

use App\Models\Timelog;

class TimelogRepository extends BaseRepository
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
     * @param Timelog $model [explicite description]
     *
     * @return void
     */
    public function __construct(Timelog $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function getTimeLog($data, $pagination = true)
    {
        $start = $data['start'] ?? 0;
        $length = $data['length'] ?? 10;
        $size = $data['size'] ?? 10;
        $sortColumn = $data['sortColumn'] ?? 'id';
        $sortDirection = $data['sortDirection'] ?? 'desc';
        $userId = $data['user_id'] ?? '';
        $date = $data['date'] ?? '';

        $query = $this->model
        ->when(
            $userId,
            function ($q) use ($userId) {
                $q->where('user_id', $userId);
        })
        ->when(
            $date,
            function ($q) use ($date) {
                $q->where('date', $date);
        })
        ->limit($length)
        ->offset($start)
        ->with(['employee', 'task'])
        ->orderBy($sortColumn, $sortDirection);
        return $query->paginate();
    }
    
    /**
     * Method addTimeLog
     *
     * @param $data $data [explicite description]
     *
     * @return void
     */
    public function addTimeLog($data)
    {
        if(isset($data['working_hours']) && count($data['working_hours']) > 0)
        {
            foreach ($data['working_hours'] as $key => $working_hours) {
                $postData['user_id'] = $data['user_id'];
                $postData['date'] = $data['date'];
                $postData['working_hours'] = $working_hours;
                $postData['description'] = $data['description'][$key];
                $this->create($postData);
            }
        }
    }
}
