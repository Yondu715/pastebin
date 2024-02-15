<div class="card">
    <a href="{{ route('pastes.show', ['hash' => $paste->hash]) }}"
        class="link-offset-2 link-underline link-underline-opacity-0 text-dark">
        <div class="card-header">
            {{ $paste->title }}
        </div>
    </a>
    <div class="card-body">
        <p class="card-text">{{ $paste->text }}</p>
    </div>
    <div class="d-flex justify-content-between card-footer text-muted">
        Автор: {{ $paste->author->name }}
        @auth
            <a href="{{ route('pastes.complaint.create', ['pasteId' => $paste->id]) }}">
                Пожаловаться на пасту
            </a>
        @endauth

    </div>

</div>
