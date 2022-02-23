<div>
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        {{$errors->first()}}
    </div>
@endif

@if(Session::get('success'))
    <div class="alert alert-success" role="alert">
        Berhasil Import Data
    </div>
@endif

    <x-data-table :data="$data" :model="$reasonCodes">
        <x-slot name="buttons">
            <button class="ml-2 btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-download"></i>
                Import
            </button>
        </x-slot>

        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('name')" role="button" href="#">
                    Principal
                    @include('components.sort-icon', ['field' => 'principal.name'])
                </a></th>
                <th><a wire:click.prevent="sortBy('code')" role="button" href="#">
                    Code
                    @include('components.sort-icon', ['field' => 'code'])
                </a></th>
                <th><a wire:click.prevent="sortBy('name')" role="button" href="#">
                    Name
                    @include('components.sort-icon', ['field' => 'name'])
                </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Tanggal Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($reasonCodes as $reasonCode)
                <tr x-data="window.__controller.dataTableController({{ $reasonCode->id }})">
                    <td>{{ $reasonCode->id }}</td>
                    <td>{{ $reasonCode->principal->name }}</td>
                    <td>{{ $reasonCode->code }}</td>
                    <td>{{ $reasonCode->name }}</td>
                    <td>{{ $reasonCode->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/reason-code/edit/{{ $reasonCode->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6">Belum ada data</td>
                </tr>

            @endforelse
        </x-slot>
    </x-data-table>
</div>
