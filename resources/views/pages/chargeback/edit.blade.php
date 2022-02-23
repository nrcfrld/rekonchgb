<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Chargeback') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">chargeback</a></div>
            <div class="breadcrumb-item"><a href="{{ route('chargeback') }}">Edit chargeback</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-chargeback action="updateChargeback" :chargebackId="request()->chargebackId" />
    </div>
</x-app-layout>
