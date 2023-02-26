<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserRepository
     *
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     *
     */
    public function index()
    {
        return $this->userRepository->index();
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->userRepository->store($request->toArray());
    }
}
