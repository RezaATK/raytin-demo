<x-layout>
    @push("styles")
        @livewireStyles
    @endpush

    @push("footerScripts")
        @livewireScripts
    @endpush

    <livewire:administrator.store.stores.manage />
</x-layout>