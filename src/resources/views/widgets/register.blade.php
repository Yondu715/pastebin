<div class="container" style="height: 100vh">
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-6 col-md-offset-4 d-flex flex-column align-items-center">
            <h4>Регистрация</h4>
            <hr />
            <form style="width: 100%" action="{{ route('auth.register') }}" method="POST">
                @csrf
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <div class="form-outline mb-4">
                    <x-input-field type="text" name="name" label="Имя" inputClass="form-control"
                        labelClass="form-label" />
                </div>

                <div class="form-outline mb-4">
                    <x-input-field type="email" name="email" label="Email" inputClass="form-control"
                        labelClass="form-label" />
                </div>

                <div class="form-outline mb-4">
                    <x-input-field type="password" name="password" label="Пароль" inputClass="form-control"
                        labelClass="form-label" />
                </div>

                <button type="submit" class="btn btn-primary btn-block mb-4">Зарегистрироваться</button>

            </form>
            <div class="text-center">
                <p>Уже есть аккаунт? <a href="{{ route('auth.login') }}">Авторизоваться</a></p>
            </div>
        </div>
    </div>
</div>
