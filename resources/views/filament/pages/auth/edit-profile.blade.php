<div>
    <header class="py-8 fi-simple-header">
        <h1 class="text-2xl font-bold tracking-tight fi-header-heading text-gray-950 dark:text-white sm:text-3xl">
            My Profile
        </h1>
        <p class="mt-2 text-sm text-left text-gray-500 dark:text-gray-400 fi-simple-header-subheader">
            Manage your user profile here
        </p>
    </header>

    <x-slot name="subheading">
        {{ $this->backAction }}
    </x-slot>

    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>
</div>
