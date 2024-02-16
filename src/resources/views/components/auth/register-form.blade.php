<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-6 col-md-offset-4 d-flex flex-column align-items-center">
            <h4>Регистрация</h4>
            <form style="width: 100%" class="d-flex flex-column" action="{{ route('auth.register') }}" method="POST">
                @csrf
                <x-session-alert name="success" type="success"/>
                <x-session-alert  name="error" type="danger"/>
                <div class="form-outline mb-4">
                    <x-label class="form-label" for="name" text="Имя"  />
                    <x-input type="text" name="name" class="form-control"/>
                    <x-error name="name"/>
                </div>
                <div class="form-outline mb-4">
                    <x-label class="form-label" for="email" text="Email"  />
                    <x-input type="email" name="email" class="form-control"/>
                    <x-error name="email"/>
                </div>
                <div class="form-outline mb-4">
                    <x-label class="form-label" for="password" text="Пароль"  />
                    <x-input type="password" name="password" class="form-control"/>
                    <x-error name="password"/>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">Зарегистрироваться</button>
            </form>
            <div class="text-center">
                <p>Уже есть аккаунт? <a href="{{ route('auth.login') }}">Авторизоваться</a></p>
            </div>
        </div>
    </div>
</div>
