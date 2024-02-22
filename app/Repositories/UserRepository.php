<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
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
     * @param User $model [explicite description]
     *
     * @return void
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model = $model; 
    }
    
    /**
     * Method whereWith
     *
     * @param $where $where [explicite description]
     * @param $with=[] $with [explicite description]
     *
     * @return void
     */
    public function whereWith($where, $with=[])
    {
        return $this->model->with($with)->where($where)->first();
    }
    
    /**
     * Method addEmployee
     *
     * @param array $data [explicite description]
     *
     * @return void
     */
    public function addEmployee(array $data)
    {
        $requestData = $data;
        $requestData['role'] = User::EMPLOYEE;
        $requestData['password'] = Hash::make('123456');
        return $this->model->create($requestData);
    }
    
    /**
     * Method employeeList
     *
     * @param $data $data [explicite description]
     * @param $pagination $pagination [explicite description]
     *
     * @return void
     */
    public function employeeList($data, $pagination = true) 
    {
        $start = $data['start'] ?? 0;
        $length = $data['length'] ?? 10;
        $size = $data['size'] ?? 10;
        $sortColumn = $data['sortColumn'] ?? 'id';
        $sortDirection = $data['sortDirection'] ?? 'desc';
        $query = $this->model->limit($length);
        $query->offset($start);
        $query->where('role', User::EMPLOYEE);
        $query->orderBy($sortColumn, $sortDirection);
        return $query->paginate();
    }
    
    /**
     * Method getEmployee
     *
     * @return void
     */
    public function getEmployee()
    {
        return $this->model->where('role', User::EMPLOYEE)->get();
    }
}
