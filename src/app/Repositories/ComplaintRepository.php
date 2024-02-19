<?php

namespace App\Repositories;

use App\Domain\DTO\CreateComplaintDto;
use App\Models\Complaint;
use Prettus\Repository\Eloquent\BaseRepository;

class ComplaintRepository extends BaseRepository
{

    /**
     *
     * @return string
     * 
     */
    public function model(): string
    {
        return Complaint::class;
    }

    /**
     *
     * @param CreateComplaintDto $createComplaintDto
     * 
     * @return Complaint
     * 
     */
    public function createFromDto(CreateComplaintDto $createComplaintDto): Complaint
    {
        /** @var Complaint */
        return $this->create([
            'title' => $createComplaintDto->title,
            'text' => $createComplaintDto->text,
            'author_id' => $createComplaintDto->authorId,
            'paste_id' => $createComplaintDto->pasteId
        ]);
    }
}
