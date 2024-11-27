<x-layout>
    @push("styles")
        @livewireStyles
    @endpush

    @push("footerScripts")
        @livewireScripts
    @endpush

    <livewire:frontend.club.clubs.my-reservations.table />
</x-layout>
