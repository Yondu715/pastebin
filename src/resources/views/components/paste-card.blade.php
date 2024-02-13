<div class="card">
    <div class="card-header">
        {{ $paste->title }}
    </div>
    <div class="card-body">
        <p class="card-text">{{ $paste->text }}</p>
    </div>
    <div class="card-footer text-muted">
        Автор: {{ $paste->author->name }}
    </div>
</div>