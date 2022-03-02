<div>
    <x-data-table :data="$data" :model="$principals">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
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
            @forelse ($principals as $principal)
                <tr x-data="window.__controller.dataTableController({{ $principal->id }})">
                    <td>{{ $principal->id }}</td>
                    <td>{{ $principal->name }}</td>
                    <td>{{ $principal->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('principal.edit', ['principalId' => $principal->id]) }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="4">Belum ada data</td>
                </tr>

            @endforelse
        </x-slot>
    </x-data-table>
</div>
