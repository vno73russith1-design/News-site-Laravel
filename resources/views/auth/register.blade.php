@extends('layouts')

@section('title', 'Регистрация')

@section('content')
    <div class="card" style="max-width:400px; margin:auto;">
        <h1>Регистрация</h1>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label>Логин</label>
            <input type="text" name="login" value="{{ old('login') }}" required>

            <label>Пароль</label>
            <input type="password" name="password" required>

            <label>Подтверждение пароля</label>
            <input type="password" name="password_confirmation" required>

            <button class="btn btn-green" type="submit">Зарегистрироваться</button>
        </form>

        <p>Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
    </div>
@endsection