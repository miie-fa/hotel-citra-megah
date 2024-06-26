<div>
    <header class="py-8 fi-simple-header">
        <h1 class="text-2xl font-bold tracking-tight fi-header-heading text-gray-950 dark:text-white sm:text-3xl">
            Fontee Notification Setting
        </h1>
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
