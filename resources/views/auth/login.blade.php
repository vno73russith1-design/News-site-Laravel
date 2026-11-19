@extends('layouts')

@section('title', 'Вход')

@section('content')
    <div class="card" style="max-width:400px; margin:auto;">
        <h1>Вход</h1>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>Логин</label>
            <input type="text" name="login" value="{{ old('login') }}" required>

            <label>Пароль</label>
            <input type="password" name="password" required>

            <button class="btn" type="submit">Войти</button>
        </form>

        <p>Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
    </div>
@endsection