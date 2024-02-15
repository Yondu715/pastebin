<?php

namespace App\Services;

use App\DTO\CreatePasteDto;
use App\Exceptions\PasteException;
use App\Models\Paste;
use App\Repositories\ExpirationTimeRepository;
use App\Repositories\PasteRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PasteService
{

    public function __construct(
        private ExpirationTimeRepository $expirationTimeRepository,
        private PasteRepository $pasteRepository
    ) {
    }

    /**
     * [Description for createPaste]
     *
     * @param CreatePasteDto $createPasteDto
     * 
     * @return Paste
     * 
     */
    public function createPaste(CreatePasteDto $createPasteDto): Paste
    {
        $expirationTime = $this->expirationTimeRepository->getById($createPasteDto->expirationTimeId);
        $paste = $this->pasteRepository->create($createPasteDto, $expirationTime->minutes);
        return $paste;
    }

    /**
     * [Description for getLatestPublicPastes]
     *
     * @return Collection<int,Paste>
     * 
     */
    public function getLatestPublicPastes(): Collection
    {
        $pastes = $this->pasteRepository->getLatestPublic();
        return $pastes;
    }

    /**
     * [Description for getLatestPrivatePastes]
     *
     * @param int $authorId
     * 
     * @return Collection<int,Paste>
     * 
     */
    public function getLatestPrivatePastes(int $authorId): Collection
    {
        $pastes = $this->pasteRepository->getLatestByAuthor($authorId);
        return $pastes;
    }


    /**
     * [Description for getPrivatePastes]
     *
     * @param int $authorId
     * 
     * @return LengthAwarePaginator
     * 
     */
    public function getPrivatePastes(int $authorId): LengthAwarePaginator
    {
        $pastes = $this->pasteRepository->getByAuthor($authorId);
        return $pastes;
    }

    /**
     * [Description for getPaste]
     * @throws PasteException
     * 
     * @param string $hash
     * 
     * @return Paste
     * 
     */
    public function getPaste(string $hash): Paste
    {
        $paste = $this->pasteRepository->getByHash($hash);
        if (!$paste) {
            throw PasteException::notFound($hash);
        }
        return $paste;
    }
}
