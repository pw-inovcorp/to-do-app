<div class="h-screen flex flex-col p-4">

    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            <span class="text-xl font-abril text-gray-800 dark:text-gray-200">TO-DO APP</span>
        </a>
    </div>

    <nav class="flex-1">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-sm font-medium">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{route('tasks.index')}}"
                   class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-sm font-medium">
                    Todas as Tarefas
                </a>
            </li>
        </ul>
    </nav>

    <!-- User Section -->
    <div class="mt-auto pt-4 border-t border-gray-200">
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                    class="w-full flex items-center px-3 py-2 text-left text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                {{ Auth::user()->name }}
                <svg class="ml-auto h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <div x-show="open" @click.away="open = false"
                 class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-md shadow-lg border border-gray-200">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
