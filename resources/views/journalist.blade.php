@extends('layouts')

@section('title', 'Кабинет журналиста')

@section('content')
    <div class="card">
        <h1>Написать статью</h1>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
            </div>
        @endif

        <form action="{{ route('journalist') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Заголовок</label>
                <input type="text" name="heading" value="{{ old('heading') }}" required>
            </div>

            <div class="form-group">
                <label>Категория</label>
                <select name="category_id" required>
                    <option value="">— выбери —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('category_id') == $caЫt->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Текст статьи</label>
                <textarea name="text" rows="10" required>{{ old('text') }}</textarea>
            </div>

            <button class="btn btn-green" type="submit">Опубликовать</button>
        </form>
    </div>
@endsection