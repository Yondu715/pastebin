<?php

namespace App\Repositories;

use App\DTO\CreateComplaintDto;
use App\Models\Complaint;

class ComplaintRepository
{
    public function create(CreateComplaintDto $createComplaintDto): Complaint
    {
        $complaint = new Complaint([
            'title' => $createComplaintDto->title,
            'text' => $createComplaintDto->text,
            'author_id' => $createComplaintDto->authorId,
            'paste_id' => $createComplaintDto->pasteId
        ]);
        $complaint->save();
        return $complaint;
    }
}
