<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\DTO\CreatePasteDto;
use App\Exceptions\PasteException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePasteRequest;
use App\Http\Resources\PasteResource;
use App\Models\User;
use App\Services\PasteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PasteController extends Controller
{

    public function __construct(
        private PasteService $pasteService
    ) {
    }

    public function store(CreatePasteRequest $createPasteRequest): PasteResource
    {
        $createPasteDto = CreatePasteDto::fromRequest($createPasteRequest);
        $paste = $this->pasteService->createPaste($createPasteDto);
        return PasteResource::make($paste);
    }

    public function getLatestPublicPastes(): AnonymousResourceCollection
    {
        $pastes = $this->pasteService->getLatestPublicPastes();
        return PasteResource::collection($pastes);
    }

    public function getLatestPrivatePastes(): AnonymousResourceCollection
    {
        /** @var User $user */
        $user = auth()->user();
        $pastes = $this->pasteService->getLatestPrivatePastes($user->id);
        return PasteResource::collection($pastes);
    }

    public function getPrivatePastes(): AnonymousResourceCollection
    {
        /** @var User $user */
        $user = auth()->user();
        $pastes = $this->pasteService->getPrivatePastes($user->id);
        return PasteResource::collection($pastes);
    }

    public function getPaste(string $hash): PasteResource|JsonResponse
    {
        try {
            $paste = $this->pasteService->getPaste($hash);
            return PasteResource::make($paste);
        } catch (PasteException $e) {
            return response()->json([
                'errors' => [
                    'message' => $e->getMessage()
                ]
            ], $e->getCode());
        }
    }
}
