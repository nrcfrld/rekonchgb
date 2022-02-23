<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat Chargeback Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('chargeback') }}">Chargeback</a></div>
            <div class="breadcrumb-item"><a href="{{ route('chargeback.new') }}">Buat Chargeback Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-chargeback action="createChargeback" />
    </div>
</x-app-layout>
