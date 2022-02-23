<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Chargeback') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Chargeback</a></div>
            <div class="breadcrumb-item"><a href="{{ route('chargeback') }}">Data chargeback</a></div>
        </div>
    </x-slot>

    <div>
        <div class="bg-white p-6 shadow-sm rounded mb-3">
            <form action="" method="GET">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-4">
                        <input type="text" class="form-control" name="ref_id" id="ref_id" placeholder="Ref Id">
                    </div>
                    <div class="col-span-4">
                        <input type="text" class="form-control" name="arn" id="arn" placeholder="ARN">
                    </div>
                    <div class="col-span-4">
                        <input type="text" class="form-control" name="card_number" id="card_number" placeholder="Nomor Kartu">
                    </div>
                    <div class="col-span-4">
                        <select name="principal_id" id="principal_id" class="form-select w-full">
                            <option value="">-- Principal --</option>
                            @foreach ($principals as $principal)
                                <option value="{{ $principal->id }}">{{ $principal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4">
                        <select name="level_id" id="level_id" class="form-select w-full">
                            <option value="">-- Level --</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4">
                        <select name="reason_code_id" id="reason_code_id" class="form-select w-full">
                            <option value="">-- Reason Code --</option>
                            @foreach ($reasonCodes as $reasonCode)
                                <option value="{{ $reasonCode->id }}">{{ $reasonCode->principal->name  }} - {{ $reasonCode->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4">
                        <select name="status" id="status" class="form-select w-full">
                            <option value="">-- Status --</option>
                            @foreach ($status as $stat)
                                    <option value="{{ $stat }}">{{ $stat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-4">
                        <a href="javascript:;" class="btn btn-primary daterange-btn icon-left btn-icon"><i class="fas fa-calendar"></i> Choose Date
                        </a>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary mt-3">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
            </form>
        </div>
        <livewire:table.main name="chargeback" :model="$chargeback" />
    </div>

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
        $(function() {
            console.log($(".daterangepicker"));
            $('.daterangepicker').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('.daterangepicker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('.daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });
        $('.daterange-btn').daterangepicker({
        ranges: {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
        }, function (start, end) {
        $('.daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        });

        </script>
    @endpush

    @push('styles')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endpush

    @push('modals')
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="{{ route('chargeback.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Chargeback</h5>
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
