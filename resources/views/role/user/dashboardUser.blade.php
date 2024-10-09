<h1>user</h1>
<form method="POST" action="{{ route('logout') }}" class=" block px-4 py-2 text-sm cursor-pointer hover:bg-gray-200 onclick="this.closest('form').submit();">
    @csrf
    <div class="" onclick="this.closest('form').submit();">
        <li>
            Logout
        </li>
    </div>