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

    /**
     * Бан пользователя
     *
     * @param int $userId
     * 
     * @return User|null
     * 
     */
    public function banUser(int $userId): ?User
    {
        /** @var User|null */
        return $this->userRepository->update([
            'is_banned' => true
        ], $userId);
    }
}
