<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{

    public function __construct(
        private UserService $userService
    ) {
    }

    public function ban(int $userId): RedirectResponse
    {
        $this->userService->banUser($userId);
        return redirect()->back();
    }
}
