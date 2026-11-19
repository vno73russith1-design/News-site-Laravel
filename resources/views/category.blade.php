@extends('layouts')

@section('title', 'Категория: ' . $category->name)

@section('content')
    <h1>Категория: {{ $category->name }}</h1>

    @forelse($texts as $text)
        <div class="card">
            <h2>{{ $text->heading }}</h2>
            <div class="meta">
                Автор: {{ $text->author->login }} | {{ $text->created_at->format('d.m.Y H:i') }}
            </div>
            <p>{{ Str::limit($text->text, 200) }}</p>
        </div>
    @empty
        <p>В этой категории статей пока нет.</p>
    @endforelse

    <div>{{ $texts->links() }}</div>
@endsection