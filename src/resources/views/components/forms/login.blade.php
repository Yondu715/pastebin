<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-6 col-md-offset-4 d-flex flex-column align-items-center">
            <h4>Авторизация</h4>
            <hr />
            <form style="width: 100%" class="d-flex flex-column" action="{{ route('auth.login') }}" method="POST">
                @csrf
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <div class="form-outline mb-4">
                    <x-input-field type="email" name="email" label="Email" inputClass="form-control"
                        labelClass="form-label" />
                </div>

                <div class="form-outline mb-4">
                    <x-input-field type="password" name="password" label="Пароль" inputClass="form-control"
                        labelClass="form-label" />
                </div>
                <div class="row mb-4">
                    <div class="col d-flex justify-content-start">
                        <div class="form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input"
                                value="1">
                            <label class="form-check-label" for="remember"> Запомнить меня </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">Войти</button>
            </form>
            <div class="text-center">
                <p>Еще нет аккаунта? <a href="{{ route('auth.register') }}">Зарегистрироваться</a></p>
                <p>или авторизоваться через:</p>

                <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-google"></i>
                </button>
            </div>
        </div>
    </div>
</div>
