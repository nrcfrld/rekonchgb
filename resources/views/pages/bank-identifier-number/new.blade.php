<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat BIN Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('principal') }}">BIN</a></div>
            <div class="breadcrumb-item"><a href="{{ route('principal.new') }}">Buat BIN Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-bank-identifier-number action="createBankIdentifierNumber" />
    </div>
</x-app-layout>
