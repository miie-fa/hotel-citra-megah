<div>
    <header class="py-8 fi-simple-header">
        <h1 class="text-2xl font-bold tracking-tight fi-header-heading text-gray-950 dark:text-white sm:text-3xl">
            Edit About Page
        </h1>
        <p class="mt-2 text-sm text-left text-gray-500 dark:text-gray-400 fi-simple-header-subheader">
            Manage your front end pages
        </p>
    </header>


    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

    </x-filament-panels::form>
</div>
