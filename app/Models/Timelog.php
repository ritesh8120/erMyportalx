<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timelog extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'task_id',
        'date',
        'working_hours',
        'description'
    ];
    
    /**
     * Method employee
     *
     * @return void
     */
    public function employee()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
