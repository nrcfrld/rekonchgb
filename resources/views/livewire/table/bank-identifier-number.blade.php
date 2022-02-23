<div>
    <x-data-table :data="$data" :model="$bankIdentifierNumbers">
        <x-slot name="head">
            <tr>
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
            @forelse ($bankIdentifierNumbers as $bankIdentifierNumber)
                <tr x-data="window.__controller.dataTableController({{ $bankIdentifierNumber->code }})">
                    <td>{{ $bankIdentifierNumber->code }}</td>
                    <td>{{ $bankIdentifierNumber->name }}</td>
                    <td>{{ $bankIdentifierNumber->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/bank-identifier-numbers/edit/{{ $bankIdentifierNumber->code }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5">Belum ada data</td>
                </tr>

            @endforelse
        </x-slot>
    </x-data-table>
</div>
