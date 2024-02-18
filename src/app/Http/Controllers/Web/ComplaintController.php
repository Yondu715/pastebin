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
        private ComplaintService $complaintService
    ) {
    }

    public function create(int $pasteId): View
    {
        return view('pages.complaints.create')->with(['pasteId' => $pasteId]);
    }

    public function store(CreateComplaintRequest $createComplaintRequest): RedirectResponse
    {
        $createComplaintDto = CreateComplaintDto::fromRequest($createComplaintRequest);
        $this->complaintService->createComplaint($createComplaintDto);
        return back()->with('success', 'Жалоба успешно создана');
    }
}
