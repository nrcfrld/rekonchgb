<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Principal') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Principal</a></div>
            <div class="breadcrumb-item"><a href="{{ route('principal') }}">Data Principal</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="principal" :model="$principal" />
    </div>
</x-app-layout>
