<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data ReasonCode') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">ReasonCode</a></div>
            <div class="breadcrumb-item"><a href="{{ route('reason-code') }}">Data ReasonCode</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="reasonCode" :model="$reasonCode" />
    </div>

    @push('modals')
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="{{ route('reason-code.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Reason Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="file">File Excel</label>
                        <small><a href="#">Lihat template import file excel</a></small>
                        <input type="file" name="file" id="file" class="form-control" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    </div>
                  </div>
                  <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
            </form>
          </div>
        </div>
    </div>
    @endpush
</x-app-layout>
