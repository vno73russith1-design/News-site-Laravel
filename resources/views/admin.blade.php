@extends('layouts')

@section('title', 'Админ-панель')

@section('content')
    <h1>Админ-панель</h1>

    <div class="card">
        <h2>Статьи</h2>
        <table>
            <thead>
                <tr><th>ID</th><th>Заголовок</th><th>Категория</th><th>Автор</th><th>Статус</th><th>Действия</th></tr>
            </thead>
            <tbody>
                @foreach($texts as $text)
                    <tr>
                        <td>{{ $text->id }}</td>
                        <td>{{ $text->heading }}</td>
                        <td>{{ $text->category->name }}</td>
                        <td>{{ $text->author->login }}</td>
                        <td>{{ $text->is_blocked ? 'Заблокирована' : 'Активна' }}</td>
                        <td>
                            <form action="{{ route('admin.block', $text) }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <button class="btn btn-yellow">
                                    {{ $text->is_blocked ? 'Разблокировать' : 'Блокировать' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.destroy', $text) }}" method="POST" style="display:inline;" onsubmit="return confirm('Удалить?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-red">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card">
        <h2>Пользователи и роли</h2>
        <table>
            <thead>
                <tr><th>ID</th><th>Логин</th><th>Роль</th><th>Изменить роль</th></tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            <form action="{{ route('admin.role', $user) }}" method="POST" style="display:flex; gap:5px;">
                                @csrf @method('PATCH')
                                <select name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @selected($user->role_id == $role->id)>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn">Сохранить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection