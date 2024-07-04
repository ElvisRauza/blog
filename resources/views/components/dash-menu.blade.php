<nav>
    <ul>
        <li>
            <a href="{{route('post.index')}}">Manage blog posts</a>
        </li>
        <li>
            <a href="{{ route('profile.edit') }}">Edit account</a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button>Log out</button>
            </form>
        </li>
    </ul>
</nav>
