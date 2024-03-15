<?php

namespace App\Domains\User\Services;

use App\Domains\User\Model\User;
use App\Domains\User\Repositories\UserRepository;
use Exception;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data): User
    {
        return $this->userRepository->createUser($data);
    }

    public function getUserByDocument(string $document): ?User
    {
        return $this->userRepository->getUserByDocument($document);
    }

    function getUserById($id): User
    {
        return $this->userRepository->getUserById($id);
    }

    public function validate(User $payer, float $amount)
    {
        
        if ($payer->type === "merchant") {
            throw new Exception("Usuário do tipo 'merchant' não pode enviar dinheiro.");
        }
        if ($payer->balance < $amount) {
            throw new Exception("Saldo insuficiente.");
        }
    }

    public function updateBalance(User $user , $amount){
        $this->userRepository->updateBalance($user , $amount);
    }
}