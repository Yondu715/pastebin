@php
    $authorId = auth()->check() ? auth()->user()->id : null;
@endphp
<div class="container" style="height: 100vh">
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-6 col-md-offset-4 d-flex flex-column align-items-center">
            <h4>Создание пасты</h4>
            <hr />
            <form style="width: 100%" class="d-flex flex-column" action="{{ route('pastes.store') }}" method="POST">
                @csrf
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <input type="hidden" name="authorId" value="{{ $authorId }}" />
                <div class="form-outline mb-4">
                    <x-input-field type="text" name="title" label="Заголовок" inputClass="form-control"
                        labelClass="form-label" />
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="code">Текст</label>
                    <textarea id="code" name="text" class="form-control" rows="10">

                    </textarea>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="access-restrictions">Тип доступа</label>
                    <br />
                    <select name="accessRestrictionId" id="access-restrictions">
                        @foreach ($accessRestrictions as $accessRestriction)
                            <option value="{{ $accessRestriction->id }}">
                                {{ $accessRestriction->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="programming-languages">Язык программирования</label>
                    <br />
                    <select name="programmingLanguageId" id="programming-languages">
                        @foreach ($programmingLanguages as $programmingLanguage)
                            <option value="{{ $programmingLanguage->id }}">
                                {{ $programmingLanguage->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="expiration-times">Ограничение по времени</label>
                    <br />
                    <select name="expirationTimeId" id="expiration-times">
                        @foreach ($expirationTimes as $expirationTime)
                            <option value="{{ $expirationTime->id }}">
                                {{ $expirationTime->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block mb-4 align-self-end">Создать</button>
            </form>
        </div>
    </div>
</div>
