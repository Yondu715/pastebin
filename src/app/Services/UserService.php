<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{

    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function banUser(int $userId): ?User
    {
        $user = $this->userRepository->updateBanStatus($userId, true);
        return $user;
    }
}
