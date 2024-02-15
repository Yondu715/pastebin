<?php

namespace App\Http\Controllers\Web;

use App\DTO\CreatePasteDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePasteRequest;
use App\Models\User;
use App\Services\AccessRestrictionService;
use App\Services\ExpirationTimeService;
use App\Services\PasteService;
use App\Services\ProgrammingLanguageService;

class PasteController extends Controller
{
    public function __construct(
        private PasteService $pasteService,
        private AccessRestrictionService $accessRestrictionService,
        private ProgrammingLanguageService $programmingLanguageService,
        private ExpirationTimeService $expirationTimeService
    ) {
    }

    public function getCreateForm()
    {
        $accessRestrictions = $this->accessRestrictionService->getAll();
        $programmingLanguages = $this->programmingLanguageService->getAll();
        $expirationTimes = $this->expirationTimeService->getAll();
        return view('pages.pastes.create')->with([
            'accessRestrictions' => $accessRestrictions,
            'programmingLanguages' => $programmingLanguages,
            'expirationTimes' => $expirationTimes
        ]);
    }

    public function store(CreatePasteRequest $createPasteRequest)
    {
        $createPasteDto = CreatePasteDto::fromRequest($createPasteRequest);
        $this->pasteService->createPaste($createPasteDto);
        return back()->with(["success" => "Паста успешно создана"]);
    }

    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $pastes = $this->pasteService->getLatestPublicPastes();
        $privatePastes = $user ? $this->pasteService->getLatestPrivatePastes($user->id) : [];
        return view('pages.pastes.home')->with([
            'publicPastes' => $pastes,
            'privatePastes' => $privatePastes
        ]);
    }

    public function show(string $hash)
    {
        $paste = $this->pasteService->getPaste($hash);
        return view('pages.pastes.paste-info')->with(['paste' => $paste]);
    }

    public function getPrivatePastes()
    {
        /** @var User $user */
        $user = auth()->user();
        $pastes = $this->pasteService->getPrivatePastes($user->id);
        return view('pages.pastes.private')->with(['pastes' => $pastes]);
    }
}
