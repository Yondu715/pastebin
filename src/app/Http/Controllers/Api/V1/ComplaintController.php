<?php

namespace App\Http\Controllers\Api\V1;

use App\Dto\CreateComplaintDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateComplaintRequest;
use App\Http\Resources\ComplaintResource;
use App\Services\ComplaintService;

class ComplaintController extends Controller
{

    public function __construct(
        private ComplaintService $complaintService
    ) {
    }

    public function store(CreateComplaintRequest $createComplaintRequest): ComplaintResource
    {
        $createComplaintDto = CreateComplaintDto::fromRequest($createComplaintRequest);
        $complaint = $this->complaintService->createComplaint($createComplaintDto);
        return ComplaintResource::make($complaint);
    }
}
