<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     *
     */
    public function index()
    {
        return $this->user->get();
    }

    /**
     * @param array $data
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
                $user = new User;
                $user->fill([
                    "name" => $data['name'],
                    "email" => $data['email'],
                    "password" => Hash::make($data['password'])
                ])->save();
            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollback();
        }
    }

    /**
     * @param $id
     */
    public function findById(int $id)
    {
        return $this->user->find($id);
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function update(array $data, int $id)
    {
        // dd($data['password']);
        try {
            DB::beginTransaction();
            $this->findById($id)
                ->fill([
                    "name" => $data['name'],
                    "email" => $data['email'],
                    "password" => Hash::make($data['password'])
                ])
                ->save();
            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
        }
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            $this->findById($id)
                ->delete();
            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollback();
        }
    }
}
