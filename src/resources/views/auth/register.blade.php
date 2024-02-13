<!DOCTYPE html>
<html lang="ru-RU">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastebin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
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
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name') }}" required />
                        <label class="form-label" for="name">Имя</label>
                        <br />
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email') }}" required />
                        <label class="form-label" for="email">Email</label>
                        <br />
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="password" class="form-control"
                            value="{{ old('password') }}" required />
                        <label class="form-label" for="password">Пароль</label>
                        <br />
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mb-4">Зарегистрироваться</button>

                </form>
                <div class="text-center">
                    <p>Уже есть аккаунт? <a href="{{ route('auth.login') }}">Авторизоваться</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</html>
