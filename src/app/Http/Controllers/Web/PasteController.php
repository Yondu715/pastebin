<?php

namespace App\Http\Controllers\Web;

use App\Domain\DTO\CreatePasteDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePasteRequest;
use App\Models\User;
use App\Services\AccessRestrictionService;
use App\Services\ExpirationTimeService;
use App\Services\PasteService;
use App\Services\ProgrammingLanguageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class PasteController extends Controller
{
    public function __construct(
        private readonly PasteService $pasteService,
        private readonly AccessRestrictionService $accessRestrictionService,
        private readonly ProgrammingLanguageService $programmingLanguageService,
        private readonly ExpirationTimeService $expirationTimeService
    ) {
    }

    /**
     * Форма создания пасты
     *
     * @return View
     * 
     */
    public function create(): View
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

    /**
     * Создание пасты
     *
     * @param CreatePasteRequest $createPasteRequest
     * 
     * @return RedirectResponse
     * 
     */
    public function store(CreatePasteRequest $createPasteRequest): RedirectResponse
    {
        $createPasteDto = CreatePasteDto::fromRequest($createPasteRequest);
        $this->pasteService->createPaste($createPasteDto);
        return back()->with(["success" => "Паста успешно создана"]);
    }

    /**
     * Страница с последними пастами
     *
     * @return View
     * 
     */
    public function index(): View
    {
        /** @var User|null $user */
        $user = auth()->user();
        $pastes = $this->pasteService->getLatestPublicPastes();
        $privatePastes = $user ? $this->pasteService->getLatestPrivatePastes($user->id) : [];
        return view('pages.pastes.home')->with([
            'publicPastes' => $pastes,
            'privatePastes' => $privatePastes
        ]);
    }

    /**
     * Информация о пасте
     *
     * @param string $hash
     * 
     * @return View
     * 
     */
    public function show(string $hash): View
    {
        $paste = $this->pasteService->getPaste($hash);
        return view('pages.pastes.paste-info')->with(['paste' => $paste]);
    }

    /**
     * Страница с пастами авторизованного пользователя
     *
     * @return View
     * 
     */
    public function getPrivatePastes(): View
    {
        /** @var User $user */
        $user = auth()->user();
        $pastes = $this->pasteService->getPrivatePastes($user->id);
        return view('pages.pastes.private')->with(['pastes' => $pastes]);
    }
}
