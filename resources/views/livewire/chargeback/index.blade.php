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

    {{-- @if ($)

    @endif --}}
    <x-data-table :data="$data" :model="$chargebacks">
        @if (!$urgentOnly)
        <x-slot name="buttons">
            <button class="ml-2 btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-download"></i>
                Import
            </button>
        </x-slot>
        @endif

        <x-slot name="head">
            <tr>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    Ref ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('name')" role="button" href="#">
                    ARN
                    @include('components.sort-icon', ['field' => 'name'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Principal
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Nomor Kartu
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Level
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('amount')" role="button" href="#">
                    Amount
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Approval Code
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Reason Code
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Merchant
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    MID
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    TID
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Open Case
                    @include('components.sort-icon', ['field' => 'opencase_date'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Expired At
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('days_to_act')" role="button" href="#">
                    Days To Act
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Status
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('date_on_book')" role="button" href="#">
                    Tanggal Dibuku
                    @include('components.sort-icon', ['field' => 'date_on_book'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Dibuat Oleh
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Diperbarui oleh
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Dibuat
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Diperbarui
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap">Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($chargebacks as $chargeback)
                <tr x-data="window.__controller.dataTableController({{ $chargeback->id }})">
                    <td>{{ $chargeback->ref_id }}</td>
                    <td>{{ $chargeback->arn }}</td>
                    <td>{{ $chargeback->principal->name }}</td>
                    <td>{{ $chargeback->card_number }}</td>
                    <td>{{ $chargeback->level->name }}</td>
                    <td>{{ number_format($chargeback->amount, 2) }}</td>
                    <td>{{ $chargeback->approval_code }}</td>
                    <td>{{ $chargeback->reasonCode->code }}</td>
                    <td>{{ $chargeback->merchant }}</td>
                    <td>{{ $chargeback->mid }}</td>
                    <td>{{ $chargeback->tid }}</td>
                    <td>{{ $chargeback->opencase_date }}</td>
                    <td>{{ $chargeback->expired_date }}</td>
                    <td>{{ $chargeback->days_to_act }}</td>
                    <td>{{ $chargeback->status }}</td>
                    <td>{{ $chargeback->date_on_book ?? '-' }}</td>
                    <td>{{ $chargeback->createdBy ? $chargeback->createdBy->name : '-'}}</td>
                    <td>{{ $chargeback->updatedBy ? $chargeback->updatedBy->name : '-' }}</td>
                    <td>{{ $chargeback->created_at }}</td>
                    <td>{{ $chargeback->updated_at }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('chargeback.edit', ['chargebackId' => $chargeback->id]) }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="15">Belum ada data</td>
                </tr>

            @endforelse
        </x-slot>
    </x-data-table>
</div>
