<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat Principal Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('principal') }}">Principal</a></div>
            <div class="breadcrumb-item"><a href="{{ route('principal.new') }}">Buat Principal Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-principal action="createPrincipal" />
    </div>
</x-app-layout>
