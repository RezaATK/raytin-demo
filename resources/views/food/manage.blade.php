<x-layout>
    @push("styles")
        @livewireStyles
    @endpush

    @push("footerScripts")
        @livewireScripts
    @endpush
    <livewire:administrator.food.foods.manage />
</x-layout>