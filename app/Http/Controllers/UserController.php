<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\UserRequest;

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
     * @param UserRequest $request
     */
    public function store(UserRequest $request)
    {
        $this->userRepository->store($request->toArray());
    }

    /**
     * @param UserRequest $request
     * @param int $id
     */
    public function update(UserRequest $request, int $id)
    {
        $this->userRepository->update($request->toArray(), $id);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->userRepository->destroy($id);
    }
}
