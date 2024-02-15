<?php

namespace App\Http\Controllers\Web;

use App\DTO\CreateComplaintDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateComplaintRequest;
use App\Services\ComplaintService;

class ComplaintController extends Controller
{

    public function __construct(
        private ComplaintService $complaintService
    ) {
    }

    public function getCreateForm(int $pasteId)
    {
        return view('pages.complaints.create')->with(['pasteId' => $pasteId]);
    }

    public function store(CreateComplaintRequest $createComplaintRequest)
    {
        $createComplaintDto = CreateComplaintDto::fromRequest($createComplaintRequest);
        $this->complaintService->createComplaint($createComplaintDto);
        return back()->with('success', 'Жалоба успешно создана');
    }
}
