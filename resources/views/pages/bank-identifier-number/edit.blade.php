<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Principal') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Principal</a></div>
            <div class="breadcrumb-item"><a href="{{ route('principal') }}">Edit Principal</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-principal action="updatePrincipal" :principalId="request()->principalId" />
    </div>
</x-app-layout>
