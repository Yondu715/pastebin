<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(
        private UserService $userService
    ) {
    }

    public function ban(int $userId)
    {
        $this->userService->banUser($userId);
        return redirect()->back();
    }
}
