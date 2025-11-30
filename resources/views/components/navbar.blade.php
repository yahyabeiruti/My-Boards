<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class=" flex flex-wrap items-center justify-between p-4">
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="{{ asset('images/to-do-list.png') }}" class="h-8" alt="To Do Logo">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">My Boards</span>
    </a>
    
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

      @guest
        <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>
        <x-navbar-link href="/login" :active="request()->is('login')">Login</x-navbar-link>
        <x-navbar-link href="/register" :active="request()->is('register')">Register</x-navbar-link>
      @endguest
      @auth
        
        <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>
        <x-navbar-link href="/editprofile" :active="request()->is('editprofile')">Edit Profile</x-navbar-link>
        <x-navbar-link>
          <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button class="btn">Logout</button>
          </form>
        </x-navbar-link>
      @endauth
      </ul>
    </div>
  </div>
</nav>