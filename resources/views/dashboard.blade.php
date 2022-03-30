<x-app-layout>
    <x-slot name="header_content">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Layout</a></div>
            <div class="breadcrumb-item">Default Layout</div>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <x-jet-welcome />
        <div class="p-4">
            {!! $chart->container() !!}
        </div>

        <div class="p-4 mt-4">
            {!! $statusChart->container() !!}
        </div>

        <div class="p-4 m-4">
            <h3 class="mb-4">Total Incoming Chargeback {{ Request::get('year') ? Request::get('year') : date('Y') }}</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Card Type / Principal</td>
                        <td>Total</td>
                        <td>Total Amount</td>
                    </tr>
                </thead>
                @foreach ($totals as $total)
                <tr>
                    <td>{{ $total->name }}</td>
                    <td>{{ $total->count }}</td>
                    <td>{{ number_format($total->total_amount, 2) }}</td>
                </tr>
                @endforeach
            </table>
        </div>


        <div class="mt-4">
            <h4 class="px-3">Chargeback Open yang SLA <7 Hari lagi </h4>
            <livewire:table.chargeback-table name="chargeback" :model="$urgentChargebacks" :urgentOnly="true" />
        </div>
    </div>

    <x-slot name="script">
        <script src="{{ $chart->cdn() }}"></script>
        <script src="{{ $statusChart->cdn() }}"></script>

        {{ $chart->script() }}
        {{ $statusChart->script() }}
    </x-slot>
</x-app-layout>
