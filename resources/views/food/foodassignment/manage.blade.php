<x-layout>
    @push("styles")
        @livewireStyles
    @endpush

    @push("footerScripts")
        @livewireScripts
    @endpush
    <livewire:administrator.food.food-assignment.manage />
</x-layout>