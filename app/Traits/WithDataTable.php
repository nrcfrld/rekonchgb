<?php

namespace App\Traits;


trait WithDataTable
{

    public function get_pagination_data()
    {
        switch ($this->name) {
            case 'user':
                $users = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.user',
                    "users" => $users,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('user.new'),
                            'create_new_text' => 'Buat User Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'principal':
                $principals = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.principal',
                    "principals" => $principals,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('principal.new'),
                            'create_new_text' => 'Buat Principal Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'reasonCode':
                $reasonCodes = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->with(['principal'])
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.reason-code',
                    "reasonCodes" => $reasonCodes,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('reason-code.new'),
                            'create_new_text' => 'Buat Reason Code Baru',
                            'export' => route('reason-code.export'),
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'bankIdentifierNumber':
                $data = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.bank-identifier-number',
                    "bankIdentifierNumbers" => $data,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('bank-identifier-number.new'),
                            'create_new_text' => 'Buat BIN Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'level':
                $data = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.level.index',
                    "levels" => $data,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('level.new'),
                            'create_new_text' => 'Buat Level Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'chargeback':
                $data = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->with(['principal', 'reasonCode', 'level'])
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.chargeback.index',
                    "chargebacks" => $data,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('chargeback.new'),
                            'create_new_text' => 'Buat Data Baru',
                            'export' => route('chargeback.export'),
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            default:
                # code...
                break;
        }
    }
}
