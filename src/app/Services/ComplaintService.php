<?php

namespace App\Services;

use App\Domain\DTO\CreateComplaintDto;
use App\Models\Complaint;
use App\Repositories\ComplaintRepository;

class ComplaintService
{

    public function __construct(
        private readonly ComplaintRepository $complaintRepository
    ) {
    }

    /**
     * Создание жалобы
     *
     * @param CreateComplaintDto $createComplaintDto
     * 
     * @return Complaint
     * 
     */
    public function createComplaint(CreateComplaintDto $createComplaintDto): Complaint
    {
        return $this->complaintRepository->create($createComplaintDto);
    }
}
