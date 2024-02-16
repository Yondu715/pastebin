<div class="container" style="height: 100vh">
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-6 col-md-offset-4 d-flex flex-column align-items-center">
            <h4>Создание жалобы</h4>
            <hr />
            <form style="width: 100%" class="d-flex flex-column" action="{{ route('pastes.complaint.store', ['pasteId' => $pasteId]) }}" method="POST">
                @csrf
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <input type="hidden" name="authorId" value="{{ auth()->user()->id }}" />
                <input type="hidden" name="pasteId" value="{{ $pasteId }}" />
                <div class="form-outline mb-4">
                    <x-label class="form-label" for="title" text="Заголовок"  />
                    <x-input type="text" name="title" class="form-control"/>
                    <x-error name="title"/>
                </div>
                <div class="form-outline mb-4">
                    <x-label class="form-label" for="code" text="Текст"/>
                    <textarea id="code" name="text" class="form-control" rows="10"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block mb-4 align-self-end">Создать</button>
            </form>
        </div>
    </div>
</div>
