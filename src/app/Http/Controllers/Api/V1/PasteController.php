<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\DTO\CreatePasteDto;
use App\Exceptions\PasteException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePasteRequest;
use App\Http\Resources\PasteResource;
use App\Models\User;
use App\Services\PasteService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PasteController extends Controller
{

    public function __construct(
        private readonly PasteService $pasteService
    ) {
    }

    /**
     * Создание пасты
     *
     * @param CreatePasteRequest $createPasteRequest
     * 
     * @return PasteResource
     * 
     */
    public function store(CreatePasteRequest $createPasteRequest): PasteResource
    {
        return PasteResource::make(
            $this->pasteService->createPaste(
                CreatePasteDto::fromRequest($createPasteRequest)
            )
        );
    }

    /**
     * Получение последних паст
     *
     * @return AnonymousResourceCollection
     * 
     */
    public function getLatestPublicPastes(): AnonymousResourceCollection
    {
        return PasteResource::collection(
            $this->pasteService->getLatestPublicPastes()
        );
    }

    /**
     * Получение последних паст авторизованного пользователя
     *
     * @return AnonymousResourceCollection
     * 
     */
    public function getLatestPrivatePastes(): AnonymousResourceCollection
    {
        /** @var User $user */
        $user = auth()->user();
        return PasteResource::collection(
            $this->pasteService->getLatestPrivatePastes($user->id)
        );
    }

    /**
     * Получение паст авторизованного пользователя
     *
     * @return AnonymousResourceCollection
     * 
     */
    public function getPrivatePastes(): AnonymousResourceCollection
    {
        /** @var User $user */
        $user = auth()->user();
        return PasteResource::collection(
            $this->pasteService->getPrivatePastes($user->id)
        );
    }

    /**
     * Получение информации о пасте по ее хэшу
     *
     * @param string $hash
     * 
     * @return PasteResource
     * 
     * @throws PasteException
     * 
     */
    public function getPaste(string $hash): PasteResource
    {
        return PasteResource::make(
            $this->pasteService->getPaste($hash)
        );
    }
}
