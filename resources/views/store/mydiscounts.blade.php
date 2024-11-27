<x-layout>
    @push("styles")
        @livewireStyles
    @endpush

    @push("footerScripts")
        @livewireScripts
    @endpush

    <livewire:frontend.store.stores.my-discounts.table />
</x-layout>
