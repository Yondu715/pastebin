<?php

namespace App\Services;

use App\Domain\DTO\CreatePasteDto;
use App\Exceptions\PasteException;
use App\Models\Paste;
use App\Repositories\ExpirationTimeRepository;
use App\Repositories\PasteRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PasteService
{

    public function __construct(
        private readonly ExpirationTimeRepository $expirationTimeRepository,
        private readonly PasteRepository $pasteRepository
    ) {
    }

    /**
     * Создание пасты
     *
     * @param CreatePasteDto $createPasteDto
     * 
     * @return Paste
     * 
     */
    public function createPaste(CreatePasteDto $createPasteDto): Paste
    {
        $expirationTime = $this->expirationTimeRepository->getById($createPasteDto->expirationTimeId);
        return $this->pasteRepository->create($createPasteDto, $expirationTime->minutes);
    }

    /**
     * Получение последних паст
     *
     * @return Collection<int,Paste>
     * 
     */
    public function getLatestPublicPastes(): Collection
    {
        return $this->pasteRepository->getLatestPublic();
    }

    /**
     * Получение последних паст авторизованного пользователя
     *
     * @param int $authorId
     * 
     * @return Collection<int,Paste>
     * 
     */
    public function getLatestPrivatePastes(int $authorId): Collection
    {
        return $this->pasteRepository->getLatestByAuthor($authorId);
    }


    /**
     * Получение паст авторизованного пользователя
     *
     * @param int $authorId
     * 
     * @return LengthAwarePaginator
     * 
     */
    public function getPrivatePastes(int $authorId): LengthAwarePaginator
    {
        return $this->pasteRepository->getByAuthor($authorId);
    }

    /**
     * Получение информации о пасте по ее хэшу
     * 
     * @param string $hash
     * 
     * @return Paste
     * 
     * @throws PasteException
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
