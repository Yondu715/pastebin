<?php

namespace App\Services;

use App\Domain\DTO\CreateComplaintDto;
use App\Models\Complaint;
use App\Repositories\ComplaintRepository;

class ComplaintService
{

    public function __construct(
        private ComplaintRepository $complaintRepository
    ) {
    }

    public function createComplaint(CreateComplaintDto $createComplaintDto): Complaint
    {
        $complaint = $this->complaintRepository->create($createComplaintDto);
        return $complaint;
    }
}
