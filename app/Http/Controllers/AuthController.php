<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Resources\TimeLogResource;
use App\Models\Role;
use App\Models\User;
use App\Repositories\TimelogRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Method __construct
     *
     * @param protected $userRepository [explicite description]
     *
     * @return void
     */
    public function __construct(protected UserRepository $userRepository, protected TimelogRepository $timelogRepository)
    {
    }

    /**
     * Method index
     *
     * @param loginRequest $request [explicite description]
     *
     * @return void
     */
    public function index(loginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return $this->successResponse(['redirectUrl' => route('dashboard'), 'message' => __('messages.login_success')]);
        } else {
            return $this->errorResponse(__('messages.invalid_login'));
        }
    }

    /**
     * Method dashboard
     *
     * @return void
     */
    public function dashboard()
    {
        return view('layout.dashboard');
    }

    public function timelog(Request $request)
    {
        try {
            $post = $request->all();
            if (Auth::user()->role == User::EMPLOYEE) {
                $post['user_id'] = Auth::user()->id;
            }
            $post['date'] = date('Y-m-d');
            return TimeLogResource::collection(
                $this->timelogRepository->getTimeLog($post)
            );
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
