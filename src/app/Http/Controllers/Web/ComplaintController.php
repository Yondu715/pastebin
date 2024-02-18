<?php

namespace App\Http\Controllers\Web;

use App\Domain\DTO\CreateComplaintDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateComplaintRequest;
use App\Services\ComplaintService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ComplaintController extends Controller
{

    public function __construct(
        private readonly ComplaintService $complaintService
    ) {
    }

    /**
     * Форма создания жалобы
     *
     * @param int $pasteId
     * 
     * @return View
     * 
     */
    public function create(int $pasteId): View
    {
        return view('pages.complaints.create')->with(['pasteId' => $pasteId]);
    }

    /**
     * Создание жалобы
     *
     * @param CreateComplaintRequest $createComplaintRequest
     * 
     * @return RedirectResponse
     * 
     */
    public function store(CreateComplaintRequest $createComplaintRequest): RedirectResponse
    {
        $this->complaintService->createComplaint(
            CreateComplaintDto::fromRequest($createComplaintRequest)
        );
        return back()->with('success', 'Жалоба успешно создана');
    }
}
