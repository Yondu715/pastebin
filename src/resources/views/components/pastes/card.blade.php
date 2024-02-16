<div class="card">
    <div class="card-header d-flex flex-column">
        <h5 class="card-title font-weight-bold mb-2">
            {{ $paste->title }}
        </h5>
        <div class="d-flex flex-row align-items-center" style="height: 20px">
            @if ($paste->author)
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-person" viewBox="0 0 15 15" class="d-flex justify-content-center align-items-center">
                    <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                <span class="card-text ms-1">
                    {{ $paste->author?->name }}
                </span>
            @endif
        </div>
    </div>
    <div class="card-body">
        <pre><code class="language-{{ $paste->programmingLanguage->name }}">{{ $paste->text }}</code></pre>
        <div class="d-flex justify-content-between">
            <a class="btn btn-link p-md-1 my-1" href="{{ route('pastes.show', ['hash' => $paste->hash]) }}"
                aria-controls="collapseContent">
                Подробнее
            </a>
            @if (Auth::check() && $paste->author?->id !== Auth::user()->id)
                <a class="btn btn-link link-danger p-md-1 my-1"
                    href="{{ route('pastes.complaint.create', ['pasteId' => $paste->id]) }}">
                    Пожаловаться
                </a>
            @endif
        </div>
    </div>
</div>
