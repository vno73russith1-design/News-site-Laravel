<header>
    <div class="header-content">
        <a href="{{ route('home') }}" class="logo">
            📰 Новости
        </a>
        <nav class="nav-links">
            <a href="{{ route('home') }}">Главная</a>
            
            <div class="dropdown">
                <a href="#" class="dropbtn">Категории ▾</a>
                <div class="dropdown-content">
                    @foreach(\App\Models\Category::all() as $cat)
                        <a href="{{ route('category', $cat->id) }}">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </div>

            @auth
                @if(auth()->user()->isJournalist())
                    <a href="{{ route('journalist') }}">Журналист</a>
                @endif
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin') }}">Админ</a>
                @endif
                
                <div class="user-info">
                    <span class="user-name">👤 {{ auth()->user()->login }} ({{ auth()->user()->role->name }})</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn-logout" type="submit">Выйти</button>
                    </form>
                </div>
            @else
                <div class="user-info">
                    <a href="{{ route('login') }}" class="btn-auth">Вход</a>
                    <a href="{{ route('register') }}" class="btn-auth">Регистрация</a>
                </div>
            @endauth
        </nav>
    </div>
</header>