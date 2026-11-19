@extends('layouts')

@section('title', 'Главная')

@section('content')
    <h1 style="margin-bottom: 25px;">Все новости</h1>

    @forelse($texts as $text)
        <div class="card">
            <h2>{{ $text->heading }}</h2>
            <div class="meta">
                <span>{{ $text->category->name }}</span>
                <span>Автор: {{ $text->author->login }}</span>
                <span>{{ $text->created_at->format('d.m.Y H:i') }}</span>
            </div>
            <p class="article-text">{{ Str::limit($text->text, 200) }}</p>
        </div>
    @empty
        <div class="card">
            <p>Пока статей нет. Войди как журналист и опубликуй первую!</p>
        </div>
    @endforelse

    <div>{{ $texts->links() }}</div>
@endsection