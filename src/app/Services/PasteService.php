<?php

namespace App\Services;

use App\Domain\DTO\CreatePasteDto;
use App\Domain\Enums\AccessRestriction\AccessRestrictionTypeId;
use App\Exceptions\PasteException;
use App\Models\ExpirationTime;
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
        /** @var ExpirationTime */
        $expirationTime = $this->expirationTimeRepository->find($createPasteDto->expirationTimeId);
        return $this->pasteRepository->createFromDto($createPasteDto, $expirationTime->minutes);
    }

    /**
     * Получение последних паст
     *
     * @return Collection<int,Paste>
     * 
     */
    public function getLatestPublicPastes(): Collection
    {
        return $this->pasteRepository
            ->available()
            ->where([
                'access_restriction_id' => AccessRestrictionTypeId::PUBLIC_ID
            ])
            ->withAllFields()
            ->getLatest(10);
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
        return $this->pasteRepository
            ->available()
            ->where([
                'author_id' => $authorId
            ])
            ->withAllFields()
            ->getLatest(10);
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
        return $this->pasteRepository
            ->available()
            ->where([
                'author_id' => $authorId
            ])
            ->withAllFields()
            ->paginate(10);
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
        /** @var Paste|null */
        $paste = $this->pasteRepository
            ->available()
            ->where([
                'hash' => $hash
            ])
            ->withAllFields()
            ->first();
        if (!$paste) {
            throw PasteException::notFound($hash);
        }
        return $paste;
    }
}
