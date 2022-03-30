<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Level') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('level') }}">Level</a></div>
            <div class="breadcrumb-item"><a href="#">Edit Level</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-level action="updateLevel" :levelId="request()->levelId" />
    </div>
</x-app-layout>
