@extends('back.layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">{{ __('back/layout.dashboard') }}</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">{{ __('back/layout.dashboard') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    {{--@if (auth()->user()->can('*'))
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <div class="content pt-0">
                    <a href="{{ route('roles.set') }}" class="btn btn-hero-sm btn-rounded btn-hero-info mb-3 mr-3">Set Roles</a>
                    <a href="{{ route('mailing.test') }}" class="btn btn-hero-sm btn-rounded btn-hero-info mb-3 mr-3">Mail Test</a>
                </div>
            </div>
        </div>
    @endif--}}

    <!-- Page Content -->
    <div class="content">
        <!-- Quick Overview -->
        <div class="row row-deck">
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="{{ route('orders') }}">
                    <div class="block-content py-5">
                        <div class="font-size-h3 font-w600 text-warning mb-1">{{ $data['proccess'] }}</div>
                        <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                            {{ __('back/dashboard.narudzba_obrada') }}
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="{{ route('orders') }}">
                    <div class="block-content py-5">
                        <div class="font-size-h3 font-w600 text-success mb-1">{{ $data['finished'] }}</div>
                        <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                            {{ __('back/dashboard.narudzba_gotovo') }}
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="{{ route('orders') }}">
                    <div class="block-content py-5">
                        <div class="font-size-h3 text-success font-w600 mb-1">{{ $data['today'] }}</div>
                        <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                            {{ __('back/dashboard.narudzba_danas') }}
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="{{ route('orders') }}">
                    <div class="block-content py-5">
                        <div class="font-size-h3 text-success font-w600 mb-1">{{ $data['this_month'] }}</div>
                        <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                            {{ __('back/dashboard.narudzba_mjesec') }}
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Quick Overview -->

        <!-- Orders Overview -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> {{ __('back/dashboard.mjesecni_pregled') }} </h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content block-content-full">
                {{--                Chart.js is initialized in js/pages/be_pages_ecom_dashboard.min.js which was auto compiled from _js/pages/be_pages_ecom_dashboard.js)--}}
                {{--                For more info and examples you can check out http://www.chartjs.org/docs/--}}
                <div style="height: 333px;">
                    <canvas class="js-chartjs-overview"></canvas>
                </div>
            </div>
        </div>


        <!-- Top Products and Latest Orders -->
        <div class="row mb-2">
            <div class="col-xl-6">
                <!-- Top Products -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">{{ __('back/dashboard.zadnje_dodani_apartmani') }} </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter font-size-sm">
                            <tbody>
                            @foreach ($apartments as $apartment)
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="font-w600" href="{{ route('apartments.edit', ['apartman' => $apartment]) }}">{{ $apartment->id }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('apartments.edit', ['apartman' => $apartment]) }}">{{ $apartment->title }}</a>
                                    </td>
                                    <td class="font-w600 text-right">{{ $apartment->price_text }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm text-right">
                        <a class="btn btn-sm btn-outline-secondary mr-2" href="{{ route('apartments.create') }}">Create New</a>
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('apartments') }}">View All</a>
                    </div>
                </div>
                <!-- END Top Products -->
            </div>
            <div class="col-xl-6">
                <!-- Latest Orders -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">{{ __('back/dashboard.zadnje_dodane_rezervacije') }}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter font-size-sm">
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="font-w600 text-center" style="width: 100px;">
                                        <a href="{{ route('orders.edit', ['order' => $order]) }}">{{ $order->id }}</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <a href="{{ route('orders.edit', ['order' => $order]) }}">{{ $order->payment_fname . ' ' . $order->payment_lname }}</a>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $order->status->color }}">{{ $order->status->title->{current_locale()} }}</span>
                                    </td>
                                    <td class="font-w600 text-right">{{ number_format($order->total, 2, ',', '.') }} ???</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm text-right">
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('orders') }}">View All</a>
                    </div>
                </div>
                <!-- END Latest Orders -->
            </div>
        </div>
        <!-- END Top Products and Latest Orders -->
    </div>
    <!-- END Page Content -->
@endsection

@push('js_after')

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/chart.js/Chart.bundle.min.js') }}"></script>

    <script>
        $(() => {
            let this_year = sort('{{ $this_year }}');
            let last_year = sort('{{ $last_year }}');

            if (this_year.top > 20000) {
                this_year.step = 5000;
            }
            if (this_year.top < 20000 && this_year.top > 4000) {
                this_year.step = 1000;
            }
            if (this_year.top < 4000 && this_year.top > 1000) {
                this_year.step = 500;
            }

            console.log(this_year.names, this_year.values, this_year.step, this_year.top)
            console.log(last_year.names, last_year.values, last_year.step, last_year.top)

            // Set Global Chart.js configuration
            Chart.defaults.global.defaultFontColor           = '#495057';
            Chart.defaults.scale.gridLines.color             = 'transparent';
            Chart.defaults.scale.gridLines.zeroLineColor     = 'transparent';
            Chart.defaults.scale.ticks.beginAtZero           = true;
            Chart.defaults.global.elements.line.borderWidth  = 0;
            Chart.defaults.global.elements.point.radius      = 0;
            Chart.defaults.global.elements.point.hoverRadius = 0;
            Chart.defaults.global.tooltips.cornerRadius      = 3;
            Chart.defaults.global.legend.labels.boxWidth     = 12;

            // Get Chart Container
            let chartOverviewCon = jQuery('.js-chartjs-overview');

            // Set Chart Variables
            let chartOverview, chartOverviewOptions, chartOverviewData;

            // Overview Chart Options
            chartOverviewOptions = {
                maintainAspectRatio: false,
                scales:              {
                    yAxes: [{
                        ticks: {
                            suggestedMax: this_year.top
                        }
                    }]
                },
                tooltips:            {
                    intersect: false,
                    callbacks: {
                        label: function (tooltipItems, data) {
                            return tooltipItems.yLabel + '???';
                        }
                    }
                }
            };

            // Overview Chart Data
            chartOverviewData = {
                labels:   this_year.names,
                datasets: [
                    {
                        label:                     '{{ __('back/dashboard.ova_godina') }}',
                        fill:                      true,
                        backgroundColor:           'rgba(6, 101, 208, .5)',
                        borderColor:               'transparent',
                        pointBackgroundColor:      'rgba(6, 101, 208, 1)',
                        pointBorderColor:          '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor:     'rgba(6, 101, 208, 1)',
                        data:                      this_year.values
                    },
                    {
                        label:                     '{{ __('back/dashboard.zadnja_godina') }}',
                        fill:                      true,
                        backgroundColor:           'rgba(6, 101, 208, .2)',
                        borderColor:               'transparent',
                        pointBackgroundColor:      'rgba(6, 101, 208, .2)',
                        pointBorderColor:          '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor:     'rgba(6, 101, 208, .2)',
                        data:                      last_year.values
                    }
                ]
            };

            // Init Overview Chart
            if (chartOverviewCon.length) {
                chartOverview = new Chart(chartOverviewCon, {
                    type:    'line',
                    data:    chartOverviewData,
                    options: chartOverviewOptions
                });
            }
        });


        function sort(data) {
            let data_data   = JSON.parse(data.replace(/&quot;/g, '"'));
            let data_names  = [];
            let data_values = [];
            let top         = 0;
            let step_size   = 100;

            for (let i = 0; i < data_data.length; i++) {
                data_names.push(data_data[i].title + '.');
                data_values.push(data_data[i].value);
            }

            for (let i = 0; i < data_values.length; i++) {
                if (data_values[i] > top) {
                    top = data_values[i];
                }
            }

            return {
                values: data_values,
                names:  data_names,
                top:    top,
                step:   step_size
            };
        }
    </script>

@endpush

