<form action="">
    @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    <div>
        <div class="relative w-full hover:shadow-md">
            <input type="text" name="search" value="{{ request('search') }}" class="z-20 block w-full p-3 text-sm text-gray-900 bg-gray-100 border border-gray-300 focus:ring-sky-950" placeholder="Search..." autocomplete="off">
            <button type="submit" title="Telusuri" class="absolute top-0 right-0 h-full p-3 text-sm font-medium text-white border border-0 bg-footer hover:bg-sky-950 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>
