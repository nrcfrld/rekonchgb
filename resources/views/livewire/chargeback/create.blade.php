<div id="form-create">
    <div class="mt-5 md:mt-0 md:col-span-2 mb-4">
        <form wire:submit.prevent="{{ $action }}">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-12 gap-6">

                        <div class="form-group col-span-6">
                            <x-jet-label for="ref_id" value="{{ __('Ref Id') }}" />
                            <small>Id referensi unik untuk tiap case (ex: ARN/Ref Number)</small>
                            <x-jet-input id="ref_id" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.ref_id" />
                            <x-jet-input-error for="chargeback.ref_id" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="arn" value="{{ __('ARN') }}" />
                            <small>Acquirer Reference Number (Isi dengan No Kartu jika tidak ada)</small>
                            <x-jet-input id="arn" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.arn" />
                            <x-jet-input-error for="chargeback.arn" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="card_number" value="{{ __('Nomor Kartu') }}" />
                            <x-jet-input id="card_number" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.card_number" />
                            <x-jet-input-error for="chargeback.card_number" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="approval_code" value="{{ __('Approval Code') }}" />
                            <x-jet-input id="approval_code" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.approval_code" />
                            <x-jet-input-error for="chargeback.approval_code" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="principal_id" value="{{ __('Principal') }}" />
                            <select id="principal_id" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.principal_id">
                                <option value="" selected>--Pilih Principal--</option>
                                @foreach ($principals as $principal)
                                    <option value="{{ $principal->id }}">{{ $principal->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="chargeback.principal_id" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="level_id" value="{{ __('Level') }}" />
                            <select id="level_id" type="text" class="mt-1 w-full form-control shadow-none" wire:model.defer="chargeback.level_id">
                                <option value="" selected>--Pilih Level--</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="chargeback.level_id" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="reason_code_id" value="{{ __('Reason Code') }}" />
                            <select id="reason_code_id" type="text" class="mt-1 w-full form-control shadow-none" wire:model.defer="chargeback.reason_code_id">
                                <option value="" selected>--Pilih Reason Code--</option>
                                @foreach ($reasonCodes as $reasonCode)
                                    <option value="{{ $reasonCode->id }}">{{ $reasonCode->code }} - {{ $reasonCode->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="chargeback.reason_code_id" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="opencase_date" value="{{ __('Open Case') }}" />
                            <x-jet-input id="opencase_date" type="date" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.opencase_date" />
                            <x-jet-input-error for="chargeback.opencase_date" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="expired_date" value="{{ __('Tanggal Expired') }}" />
                            <x-jet-input id="expired_date" type="date" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.expired_date" />
                            <x-jet-input-error for="chargeback.expired_date" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="transaction_date" value="{{ __('Tanggal Transaksi') }}" />
                            <x-jet-input id="transaction_date" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.transaction_date" />
                            <x-jet-input-error for="chargeback.transaction_date" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="merchant" value="{{ __('Merchant') }}" />
                            <x-jet-input id="merchant" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.merchant" />
                            <x-jet-input-error for="chargeback.merchant" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="mid" value="{{ __('MID') }}" />
                            <x-jet-input id="mid" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.mid" />
                            <x-jet-input-error for="chargeback.mid" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="tid" value="{{ __('TID') }}" />
                            <x-jet-input id="tid" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.tid" />
                            <x-jet-input-error for="chargeback.tid" class="mt-2" />
                        </div>


                        <div class="form-group col-span-6">
                            <x-jet-label for="amount" value="{{ __('Amount') }}" />
                            <x-jet-input id="amount" type="number" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.amount" />
                            <x-jet-input-error for="chargeback.amount" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="status" value="{{ __('Status') }}" />
                            <select id="status" type="text" class="mt-1 w-full form-control shadow-none" wire:model.defer="chargeback.status">
                                <option value="" selected>--Status--</option>
                                @foreach ($status as $stat)
                                    <option value="{{ $stat }}">{{ $stat }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="chargeback.status" class="mt-2" />
                        </div>

                        <div class="form-group col-span-6">
                            <x-jet-label for="date_on_book" value="{{ __('Tanggal Buku') }}" />
                            <x-jet-input id="date_on_book" type="date" class="mt-1 block w-full form-control shadow-none" wire:model.defer="chargeback.date_on_book" />
                            <x-jet-input-error for="chargeback.date_on_book" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <x-jet-action-message class="mr-3" on="saved">
                        {{ __($button['submit_response']) }}
                    </x-jet-action-message>

                    <x-jet-button>
                        {{ __($button['submit_text']) }}
                    </x-jet-button>
                </div>
            </div>
        </form>
    </div>

    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>
