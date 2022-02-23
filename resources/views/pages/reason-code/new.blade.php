<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat ReasonCode Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('reason-code') }}">ReasonCode</a></div>
            <div class="breadcrumb-item"><a href="{{ route('reason-code.new') }}">Buat ReasonCode Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-reason-code action="createReasonCode" />
    </div>
</x-app-layout>
