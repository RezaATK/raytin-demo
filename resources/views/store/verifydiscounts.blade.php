<x-layout>
    @push("styles")
        @livewireStyles
    @endpush

    @push("footerScripts")
        @livewireScripts
    @endpush

    <livewire:administrator.store.verify-discounts.manage />
</x-layout>
