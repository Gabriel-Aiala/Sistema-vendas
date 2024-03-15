<?php

namespace App\Domains\User\Repositories;

use App\Domains\User\Model\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUsers(): Collection
    {
        return $this->user->all();
    }

    public function getUserByDocument(string $document): ?User
    {
        return $this->user->where('document', $document)->first();
    }

    function getUserById(int $id): User
    {
        return $this->user->find($id);
    }

    public function createUser(array $data): User
    {
        return $this->user->create($data);
    }

    public function updateUser(string $document, array $data): ?User
    {
        $user = $this->getUserByDocument($document);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function deleteUser(string $document): bool
    {
        $user = $this->getUserByDocument($document);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }

    public function getBalance(User $user): float
    {
        return $user->balance;
    }public function updateBalance(User $user,float $amount): float
    {
        $user->balance += $amount;
        $user->save();
        return $user->balance;
    }

}