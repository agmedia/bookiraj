@extends('back.layouts.backend')
@push('css_before')

    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">


@endpush

@section('content')

    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Narudžbe</h1>
            </div>
        </div>
    </div>


    <!-- Page Content -->
    <div class="content">
    @include('back.layouts.partials.session')
        <!-- All Orders -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lista narudžbi</h3>
                <div class="block-options">
                    <div class="form-group mb-0 mr-2">
                        <select class="js-select2 form-control" id="status-select" name="status" style="width: 100%;" data-placeholder="Promjeni status narudžbe">
                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="block-options">
                    <div class="dropdown">
                        <button type="button" class="btn btn-light" id="dropdown-ecom-filters" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filtriraj
                            <i class="fa fa-angle-down ml-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-ecom-filters">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:setURL('status', 0)">
                                Sve narudžbe
                            </a>
                            @foreach ($statuses as $status)
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:setURL('status', {{ $status->id }})">
                                    <span class="badge badge-pill badge-{{ $status->color }}">{{ $status->title }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content bg-body-dark">
                <!-- Search Form -->
                <form action="be_pages_ecom_orders.html" method="POST" onsubmit="return false;">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-alt" id="dm-ecom-orders-search" name="dm-ecom-orders-search" placeholder="Pretraži narudžbe">
                    </div>
                </form>
                <!-- END Search Form -->
            </div>
            <div class="block-content">
                <!-- All Orders Table -->
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-vcenter font-size-sm">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 30px;">
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkAll" name="status">
                                    </div>
                                </div>
                            </th>
                            <th class="text-center" style="width: 36px;">Br.</th>
                            <th class="text-center">Datum</th>
                            <th>Status</th>
                            <th>Kupac</th>
                            <th class="text-center">Artikli</th>
                            <th class="text-right">Vrijednost</th>
                            <th class="text-right">Detalji</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($orders->sortByDesc('id') as $order)




                            <tr>
                                <td class="text-center">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $order->id }}" id="status[{{ $order->id }}]" name="status">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a class="font-w600" href="{{ route('orders.show', ['order' => $order]) }}">
                                        <strong>{{ $order->id }}</strong>
                                    </a>
                                </td>
                                <td class="text-center">{{ \Illuminate\Support\Carbon::make($order->created_at)->format('d.m.Y') }}</td>
                                <td class="font-size-base">
                                    <span class="badge badge-pill badge-{{ $order->status->color }}">{{ $order->status->title }}</span>
                                </td>
                                <td>
                                    <a class="font-w600" href="{{ route('orders.show', ['order' => $order]) }}">{{ $order->shipping_fname }} {{ $order->shipping_lname }}</a>
                                </td>
                                <td class="text-center">{{ $order->products->count() }}</td>
                                <td class="text-right">
                                    <strong>{{ number_format($order->total, 2, ',', '.') }} kn</strong>
                                </td>
                                <td class="text-right font-size-base">
                                    <a class="btn btn-sm btn-alt-secondary" href="{{ route('orders.show', ['order' => $order]) }}">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-alt-info" href="{{ route('orders.edit', ['order' => $order]) }}">
                                        <i class="fa fa-fw fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center font-size-sm" colspan="8">
                                    <label>Nema narudžbi...</label>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                {{ $orders->links() }}
            </div>
        </div>
        <!-- END All Orders -->
    </div>

@endsection

@push('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(() => {
            $('#status-select').select2({
                placeholder: 'Promjenite status'
            });

            $('#status-select').on('change', (e) => {
                let selected = e.currentTarget.selectedOptions[0].value;
                let orders = '[';
                var checkedBoxes = document.querySelectorAll('input[name=status]:checked');

                for (let i = 0; i < checkedBoxes.length; i++) {
                    if (checkedBoxes.length - 1 == i) {
                        orders += checkedBoxes[i].value + ']';
                    } else {
                        orders += checkedBoxes[i].value + ','
                    }
                }

                console.log('Selected ID: ' + selected);
                console.log('Orders ID: ' + orders);

                axios.get('{{ route('api.order.status.change') }}' + '?selected=' + selected + '&orders=' + orders)
                .then((r) => {
                    location.reload();
                })
                .catch((e) => {
                    console.log(e)
                })
            });
        });

        /**
         *
         * @param type
         * @param search
         */
        function setURL(type, search) {
            let url = new URL(location.href);
            let params = new URLSearchParams(url.search);
            let keys = [];

            for(var key of params.keys()) {
                if (key === type) {
                    keys.push(key);
                }
            }

            keys.forEach((value) => {
                if (params.has(value) || search == 0) {
                    params.delete(value);
                }
            })

            if (search) {
                params.append(type, search);
            }

            url.search = params;
            location.href = url;
        }
    </script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>

@endpush
