@extends('back.layouts.backend')
@push('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.umd.min.js"></script>
@endpush

@section('content')

    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Narudžba edit <small class="font-weight-light">#_</small><strong>{{ $order->id }}</strong></h1>
                <h4><span class="badge badge-pill badge-{{ $order->status->color }}">{{ $order->status->title->{current_locale()} }}</span></h4>
            </div>
        </div>
    </div>


    <!-- Page Content -->
    <div class="content">
        @include('back.layouts.partials.session')

        <form action="{{ isset($order) ? route('orders.update', ['order' => $order]) : route('orders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($order))
            {{ method_field('PATCH') }}
        @endif

        <!-- Products -->
            <div class="row">
                <div class="col-sm-7">
                    <div class="block block-rounded" id="ag-order-products-app">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Basic Order Info</h3>
                        </div>
                        <div class="block-content">
                            <div class="row justify-content-center push">
                                <div class="col-md-5">
                                    <img  class="img-thumbnail" src="{{ asset($order->apartment->image) }}" alt="">
                                </div>
                                <div class="col-md-7">
                                    <h3 class="mb-0">{{ $order->apartment->title }}</h3>
                                    <p>
                                        {{ $order->apartment->address }}, {{ $order->apartment->city }}
                                    </p>

                                    <table class="table-borderless" style="width: 100%;">
                                        <tr>
                                            <td class="font-weight-bold" style="width: 30%;">Korisnik:<br><br><br><br></td>
                                            <td>{{ $order->payment_fname }} {{ $order->payment_lname }}<br>
                                                {{ $order->payment_email }}<br>
                                                {{ $order->payment_phone }}<br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Osoba:</td>
                                            <td>{{ $order->checkout['adults'] }} Odraslih, {{ $order->checkout['children'] }} Djece</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Dani:<br><br></td>
                                            <td>{{ $order->checkout['regular_days'] }} Regularnih dana, {{ $order->checkout['weekends'] }} Vikenda<br><br></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Datum:<br><br></td>
                                            <td>{{ \Illuminate\Support\Carbon::make($order->date_from)->format('d.m.Y') }} – {{ \Illuminate\Support\Carbon::make($order->date_to)->format('d.m.Y') }}<br><br></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" colspan="2">Promijeni datum:<br>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                                                    <input class="form-control" id="checkindate" name="dates" placeholder="Check-in -> Checkout" type="text">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="block block-rounded" id="ag-order-products-app">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Order Items & Total</h3>
                        </div>
                        <div class="block-content">
                            <div class="row justify-content-center push">
                                <div class="col-md-12">
                                    <table class="table-borderless" style="width: 100%;">
                                        @foreach ($order->checkout['total']['items'] as $item)
                                            <!-- Items -->
                                            @if ($item['code'] != 'additional_person' && $item['code'] != 'additional_options')
                                                <tr style="height: 36px;">
                                                    <td style="width: 7%;"></td>
                                                    <td>{{ $item['price_text'] }} * {{ $item['count'] }} {{ $item['title'] }}</td>
                                                    <td>{{ $item['total_text'] }}</td>
                                                </tr>
                                            @endif
                                            @if ($item['code'] == 'additional_person')
                                                <tr style="height: 36px;">
                                                    <td>
                                                        <input type="checkbox" checked="checked" name="persons">
                                                    </td>
                                                    <td>{{ $item['price_text'] }} * {{ $item['count'] }} {{ $item['title'] }}</td>
                                                    <td>{{ $item['total_text'] }}</td>
                                                </tr>
                                            @endif
                                            @if ($item['code'] == 'additional_options')
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" checked="checked" name="options_{{ isset($item['id']) ? $item['id'] : '0' }}">
                                                    </td>
                                                    <td>{{ $item['price_text'] }} * {{ $item['count'] }} {{ $item['title'] }}</td>
                                                    <td>{{ $item['total_text'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <!-- Total -->
                                        @foreach ($order->checkout['total']['total'] as $item)
                                            <tr style="height: 36px;">
                                                <td colspan="2" class="text-right pr-3">{{ $item['title'] }}</td>
                                                <td>{{ $item['total_text'] }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer -->
            <div class="row">
                <div class="col-sm-7">
                    <!-- Billing Address -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Kupac</h3>
                            <div class="block-options">
                                @if (isset($order) && $order->user_id)
                                    <span class="small text-gray mr-3">Kupac je registriran</span><i class="fa fa-user text-success"></i>
                                @else
                                    <span class="small font-weight-light mr-3">Kupac nije registriran</span><i class="fa fa-user text-danger-light"></i>
                                @endif
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row justify-content-center push">
                                <div class="col-md-11">
                                    <div class="form-group row items-push">
                                        <div class="col-md-6">
                                            <label for="fname-input">Ime</label>
                                            <input type="text" class="form-control" id="fname-input" name="fname" placeholder="Upišite ime kupca" value="{{ isset($order) ? $order->payment_fname : old('fname') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lname-input">Prezime</label>
                                            <input type="text" class="form-control" id="lname-input" name="lname" placeholder="Upišite prezime kupca" value="{{ isset($order) ? $order->payment_lname : old('lname') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email-input">Email</label>
                                            <input type="text" class="form-control" id="email-input" name="email" placeholder="Upišite email kupca" value="{{ isset($order) ? $order->payment_email : old('email') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone-input">Phone</label>
                                            <input type="text" class="form-control" id="phone-input" name="phone" placeholder="Upišite telefon kupca" value="{{ isset($order) ? $order->payment_phone : old('phone') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Billing Address -->
                </div>
                <div class="col-sm-5">
                    <!-- Payments -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Način plaćanja</h3>
                        </div>
                        <div class="block-content">
                            <div class="row mb-4">
                                <div class="col-md-8">
                                    <label for="payment-select">Plaćanje</label>
                                    <select class="js-select2 form-control" id="payment-select" name="payment" style="width: 100%;" data-placeholder="Odaberite način plaćanja...">
                                        <option></option>
                                        @foreach ($payments as $payment)
                                           <option value="{{ $payment->code }}" {{ ((isset($order)) and ($order->payment_code == $payment->code)) ? 'selected' : '' }}>{{ $payment->title->{current_locale()} }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="payment-amount-input">Iznos</label>
                                    <input type="text" class="form-control" id="payment-amount-input" name="payment_amount" placeholder="Upišite iznos" value="{{ isset($order) ? $order->total : old('payment_amount') }}">
<!--                                    <input type="text" class="form-control" id="payment-amount-input" name="payment_amount" placeholder="Upišite iznos" value="{{ (isset($order) && $order->totals()->where('code', 'total')->first()) ? $order->totals()->where('code', 'total')->first()->value : old('payment_amount') }}">-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Messages -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Povijest narudžbe</h3>
                    <div class="block-options">
                        <div class="dropdown">
                            <button type="button" class="btn btn-alt-secondary" id="btn-add-comment">
                                Dodaj komentar
                            </button>
                            <button type="button" class="btn btn-light" id="dropdown-ecom-filters" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Promjeni status
                                <i class="fa fa-angle-down ml-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-ecom-filters">
                                @foreach ($statuses as $status)
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:setStatus({{ $status->id }});">
                                        <span class="badge badge-pill badge-{{ $status->color }}">{{ $status->title->{current_locale()} }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block-content">
                    <table class="table table-borderless table-striped table-vcenter font-size-sm">
                        <tbody>
                        @foreach ($order->history as $record)
                            <tr>
                                <td class="font-size-base">
                                    @if ($record->status)
                                        <span class="badge badge-pill badge-{{ $record->status->color }}">{{ $record->status->title->{current_locale()} }}</span>
                                    @else
                                        <small>Komentar</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="font-w600">{{ \Illuminate\Support\Carbon::make($record->created_at)->locale('hr_HR')->diffForHumans() }}</span> /
                                    <span class="font-weight-light">{{ \Illuminate\Support\Carbon::make($record->created_at)->format('d.m.Y - h:i') }}</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)">{{ $record->user ? $record->user->name : $record->order->payment_fname . ' ' . $record->order->payment_lname }}</a>
                                </td>
                                <td>{{ $record->comment }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="block">
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-hero-success mb-3">
                                <i class="fas fa-save mr-1"></i> Snimi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <!-- END Page Content -->

@endsection

@push('modals')
    <div class="modal fade" id="comment-modal" tabindex="-1" role="dialog" aria-labelledby="comment--modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content rounded">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Dodaj komentar</h3>
                        <div class="block-options">
                            <a class="text-muted font-size-h3" href="#" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-10">
                                <div class="form-group mb-4">
                                    <label for="status-select">Promjeni status</label>
                                    <select class="js-select2 form-control" id="status-select" name="status" style="width: 100%;" data-placeholder="Promjeni status narudžbe">
                                        <option value="0">Bez Promjene statusa...</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->title->{current_locale()} }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="comment-input">Komentar</label>
                                    <textarea class="form-control" name="comment" id="comment-input" rows="7"></textarea>
                                </div>

                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <a class="btn btn-sm btn-light" data-dismiss="modal" aria-label="Close">
                            Odustani <i class="fa fa-times ml-2"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-primary" onclick="event.preventDefault(); changeStatus();">
                            Snimi <i class="fa fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('js_after')
<!--    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/components/ag-order-products.js') }}"></script>-->

    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(() => {
            $('#payment-select').select2({});

            $('#status-select').select2({});

            $('#btn-add-comment').on('click', () => {
                $('#comment-modal').modal('show');
                $('#status-select').val(0);
                $('#status-select').trigger('change');
            });
        })

        /**
         *
         * @param status
         */
        function setStatus(status) {
            $('#comment-modal').modal('show');
            $('#status-select').val(status);
            $('#status-select').trigger('change');
        }

        /**
         *
         */
        function changeStatus() {
            let item = {
                order_id: {{ $order->id }},
                comment: $('#comment-input').val(),
                status: $('#status-select').val()
            };

            axios.post("{{ route('api.order.status.change') }}", item)
            .then(response => {
                console.log(response.data)
                if (response.data.message) {
                    $('#comment-modal').modal('hide');

                    successToast.fire({
                        timer: 1500,
                        text: response.data.message,
                    }).then(() => {
                        location.reload();
                    })

                } else {
                    return errorToast.fire(response.data.error);
                }
            });
        }
    </script>


    <script>
        const DateTime = easepick.DateTime;
        const bookedDates = {!! collect($order->apartment->dates())->toJson() !!}
        .map(d => {
            if (d instanceof Array) {
                const start = new DateTime(d[0], 'YYYY-MM-DD');
                const end = new DateTime(d[1], 'YYYY-MM-DD');

                return [start, end];
            }

            return new DateTime(d, 'YYYY-MM-DD');
        });
        const pickerres = new easepick.create({
            element: document.getElementById('checkindate'),
            css: [
                '{{ config('app.url') }}assets/css/reservation.css',
            ],
            grid: 1,
            calendars: 1,
            zIndex: 10,
            plugins: ['LockPlugin','RangePlugin'],
            RangePlugin: {
                tooltipNumber(num) {
                    return num - 1;
                },
                locale: {
                    one: 'night',
                    other: 'nights',
                },
            },
            LockPlugin: {
                minDate: new Date(),
                minDays: 2,
                inseparable: true,
                filter(date, picked) {
                    if (picked.length === 1) {
                        const incl = date.isBefore(picked[0]) ? '[)' : '(]';
                        return !picked[0].isSame(date, 'day') && date.inArray(bookedDates, incl);
                    }

                    return date.inArray(bookedDates, '[)');
                },
            }
        });
    </script>

@endpush
