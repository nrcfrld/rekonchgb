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
        <x-slot name="buttons">
            <button class="ml-2 btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-download"></i>
                Import
            </button>
        </x-slot>

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
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
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
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Expired At
                    @include('components.sort-icon', ['field' => 'created_at'])
                </a></th>
                <th class="text-nowrap"><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                    Status
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
                    <td>{{ $chargeback->amount }}</td>
                    <td>{{ $chargeback->approval_code }}</td>
                    <td>{{ $chargeback->reasonCode->code }}</td>
                    <td>{{ $chargeback->merchant }}</td>
                    <td>{{ $chargeback->mid }}</td>
                    <td>{{ $chargeback->tid }}</td>
                    <td>{{ $chargeback->opencase_date }}</td>
                    <td>{{ $chargeback->expired_date }}</td>
                    <td>{{ $chargeback->status }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/chargeback/edit/{{ $chargeback->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
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
