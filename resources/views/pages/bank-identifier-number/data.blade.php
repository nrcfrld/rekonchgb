<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data BIN') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Bank Identifier Number</a></div>
            <div class="breadcrumb-item"><a href="{{ route('principal') }}">Data Bank Identifier Number</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="bankIdentifierNumber" :model="$bankIdentifierNumber" />
    </div>
</x-app-layout>
