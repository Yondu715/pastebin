<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-6 col-md-offset-4 d-flex flex-column align-items-center">
            <h4>Авторизация</h4>
            <form style="width: 100%" class="d-flex flex-column" action="{{ route('auth.login') }}" method="POST">
                @csrf
                <x-session-alert name="success" type="success"/>
                <x-session-alert  name="error" type="danger"/>
                <div class="form-outline mb-4">
                    <x-label class="form-label" for="email" text="Email"/>
                    <x-input type="email" name="email" class="form-control" />
                    <x-error name="email"/>
                </div>

                <div class="form-outline mb-4">
                    <x-label class="form-label" for="password" text="Пароль"  />
                    <x-input type="password" name="password" class="form-control"/>
                    <x-error name="password"/>
                </div>
                <div class="row mb-4">
                    <div class="col d-flex justify-content-start">
                        <div class="form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input"
                                value="1">
                            <label class="form-check-label" for="remember">Запомнить меня</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">Войти</button>
            </form>
            <div class="text-center">
                <p>
                    Еще нет аккаунта?
                    <a href="{{ route('auth.register') }}">
                        Зарегистрироваться
                    </a>
                </p>
                <p>
                    или авторизоваться через:
                </p>
                <a href="{{ route('auth.login.google') }}" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-google" viewBox="0 0 16 16">
                        <path
                            d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                    </svg>
                    mail
                </a>
            </div>
        </div>
    </div>
</div>
