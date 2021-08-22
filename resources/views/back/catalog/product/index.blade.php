@extends('back.layouts.backend')
@push('css_before')

    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">


@endpush

@section('content')

    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Artikli</h1>
                <a class="btn btn-hero-success my-2" href="{{ route('products.create') }}">
                    <i class="far fa-fw fa-plus-square"></i><span class="d-none d-sm-inline ml-1"> Novi artikl</span>
                </a>
            </div>
        </div>
    </div>

    <div class="content">
        @include('back.layouts.partials.session')

       {{-- <div class="row row-deck">
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="{{ route('products') }}">
                    <div class="block-content py-5">
                        <div class="font-size-h3 font-w600 text-dark mb-1">{{ $counts['all'] }}</div>
                        <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                            Svi artikli
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" id="btn-inactive" href="{{ route('products', ['active' => 0]) }}">
                    <div class="block-content py-5">
                        <div class="font-size-h3 font-w600 text-danger mb-1">{{ $counts['inactive'] }}</div>
                        <p class="font-w600 font-size-sm text-danger text-uppercase mb-0">
                            Neaktivnih
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" id="btn-active" href="{{ route('products', ['active' => 1]) }}">
                    <div class="block-content py-5">
                        <div class="font-size-h3 font-w600 text-success mb-1">{{ $counts['active'] }}</div>
                        <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                            Aktivnih
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" id="btn-actions" href="{{ route('products', ['actions' => 1]) }}">
                    <div class="block-content py-5">
                        <div class="font-size-h3 font-w600 text-info mb-1">{{ $counts['actions'] }}</div>
                        <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                            Sa Akcijama
                        </p>
                    </div>
                </a>
            </div>
        </div>--}}
        <!-- All Products -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Svi artikli</h3>
                <div class="block-options">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary mr-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-filter"></i> Filter
                        </button>
<!--                        <button type="button" class="btn btn-outline-primary" id="dropdown-ecom-filters" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filtriraj <i class="fa fa-angle-down ml-1"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-ecom-filters">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                Aktivno
                                <span class="badge badge-success badge-pill">26000</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                Neaktivno
                                <span class="badge badge-danger badge-pill">10000</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                Svi artikli
                                <span class="badge badge-secondary badge-pill">36000</span>
                            </a>
                        </div>-->
                    </div>
                </div>
            </div>
            <div class="collapse show" id="collapseExample">
                <div class="block-content bg-body-dark">
                    <form action="{{ route('products') }}" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg py-3 text-center" name="search" id="search-input" value="{{ request()->input('search') }}" placeholder="Upiši pojam pretraživanja">
                        </div>
                        <div class="form-group row items-push mb-0">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="category-select" name="category" style="width: 100%;" data-placeholder="Odaberi kategoriju">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($categories as $group => $cats)
                                            @foreach ($cats as $id => $category)
                                                <option value="{{ $id }}" class="font-weight-bold small" {{ $id == request()->input('category') ? 'selected' : '' }}>{{ $group . ' >> ' . $category['title'] }}</option>
                                                @if ( ! empty($category['subs']))
                                                    @foreach ($category['subs'] as $sub_id => $subcategory)
                                                        <option value="{{ $sub_id }}" class="pl-3 text-sm" {{ $sub_id == request()->input('category') ? 'selected' : '' }}>{{ $subcategory['title'] }}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="author-select" name="author" style="width: 100%;" data-placeholder="Odaberi autora">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($authors as $id => $author)
                                            <option value="{{ $id }}" {{ $id == request()->input('author') ? 'selected' : '' }}>{{ $author }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="publisher-select" name="publisher" style="width: 100%;" data-placeholder="Odaberi izdavača">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($publishers as $id => $publisher)
                                            <option value="{{ $id }}" {{ $id == request()->input('publisher') ? 'selected' : '' }}>{{ $publisher }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="status-select" name="status" style="width: 100%;" data-placeholder="Odaberi Status">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <option value="all" {{ 'all' == request()->input('status') ? 'selected' : '' }}>Svi artikli</option>
                                        <option value="active" {{ 'active' == request()->input('status') ? 'selected' : '' }}>Aktivni</option>
                                        <option value="inactive" {{ 'inactive' == request()->input('status') ? 'selected' : '' }}>Neaktivni</option>
                                        <option value="with_action" {{ 'with_action' == request()->input('status') ? 'selected' : '' }}>Sa akcijama</option>
                                        <option value="without_action" {{ 'without_action' == request()->input('status') ? 'selected' : '' }}>Bez akcija</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="sort-select" name="sort" style="width: 100%;" data-placeholder="Sortiraj artikle">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <option value="new" {{ 'new' == request()->input('status') ? 'selected' : '' }}>Najnovije</option>
                                        <option value="old" {{ 'old' == request()->input('status') ? 'selected' : '' }}>Najstarije</option>
                                        <option value="price_up" {{ 'price_up' == request()->input('status') ? 'selected' : '' }}>Cijena od više</option>
                                        <option value="price_down" {{ 'price_down' == request()->input('status') ? 'selected' : '' }}>Cijena od manje</option>
                                        <option value="az" {{ 'az' == request()->input('status') ? 'selected' : '' }}>Od A do Ž</option>
                                        <option value="za" {{ 'za' == request()->input('status') ? 'selected' : '' }}>Od Ž do A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block" onclick="setURL('search', $('#search-input').val());"><i class="fa fa-search"></i> Pretraži</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-vcenter">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">Slika</th>
                            <th>Naziv</th>
                            <th>Šifra</th>
                            <th>Cijena</th>
                            <th>Dodano</th>
                            <th class="text-center font-size-sm">Status</th>
                            <th class="text-right" style="width: 100px;">Uredi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="text-center font-size-sm">
                                    <img src="{{ $product->image ? asset($product->image) : asset('media/avatars/avatar0.jpg') }}" height="80px"/>
                                </td>
                                <td class="font-size-sm">
                                    <a class="font-w600" href="{{ route('products.edit', ['product' => $product]) }}">{{ $product->name }}</a><br>
                                    @if ($product->categories)
                                        @foreach ($product->categories as $cat)
                                            <span class="badge badge-secondary">{{ $cat->title }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="font-size-sm">{{ $product->sku }}</td>
                                <td class="font-size-sm">
                                    @if ($product->special())
                                        <s>{{ number_format($product->price, 2) }}kn</s><br>
                                        <strong>{{ number_format($product->special(), 2) }}kn</strong>
                                    @else
                                        <strong>{{ number_format($product->price, 2) }}kn</strong>
                                    @endif
                                </td>
                                <td class="font-size-sm">{{ \Illuminate\Support\Carbon::make($product->created_at)->format('d.m.Y') }}</td>
                                <td class="text-center font-size-sm">
                                    @include('back.layouts.partials.status', ['status' => $product->status])
                                </td>
                                <td class="text-right font-size-sm">
                                    <a class="btn btn-sm btn-alt-secondary" href="{{ route('products.edit', ['product' => $product]) }}">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center font-size-sm" colspan="7">
                                    <label>Nema proizvoda...</label>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js_after')


    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(() => {
            $('#category-select').select2({
                placeholder: 'Odaberite kategoriju',
                allowClear: true
            });
            $('#author-select').select2({
                placeholder: 'Odaberite autora',
                allowClear: true
            });
            $('#publisher-select').select2({
                placeholder: 'Odaberite izdavača',
                allowClear: true
            });
            $('#status-select').select2({
                placeholder: 'Odaberite status',
                allowClear: true
            });
            $('#sort-select').select2({
                placeholder: 'Sortiraj artikle',
                allowClear: true
            });

            //
            $('#category-select').on('change', (e) => {
                setURL('category', e.currentTarget.selectedOptions[0]);
            });
            $('#author-select').on('change', (e) => {
                setURL('author', e.currentTarget.selectedOptions[0]);
            });
            $('#publisher-select').on('change', (e) => {
                setURL('publisher', e.currentTarget.selectedOptions[0]);
            });
            $('#status-select').on('change', (e) => {
                setURL('status', e.currentTarget.selectedOptions[0]);
            });
            $('#sort-select').on('change', (e) => {
                setURL('sort', e.currentTarget.selectedOptions[0]);
            });

            /*$('#btn-inactive').on('click', () => {
                setRegularURL('active', false);
            });
            $('#btn-today').on('click', () => {
                setRegularURL('today', true);
            });
            $('#btn-week').on('click', () => {
                setRegularURL('week', true);
            });*/
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
                if (params.has(value)) {
                    params.delete(value);
                }
            })

            if (search.value) {
                params.append(type, search.value);
            }

            url.search = params;
            location.href = url;
        }

        /**
         *
         * @param type
         * @param search
         */
        function setRegularURL(type, search) {
            let searches = ['active', 'today', 'week'];
            let url = new URL(location.href);
            let params = new URLSearchParams(url.search);
            let keys = [];

            for(var key of params.keys()) {
                if (key === type) {
                    keys.push(key);
                }
            }

            keys.forEach((value) => {
                if (params.has(value)) {
                    params.delete(value);
                }
            })

            params.append(type, search);

            url.search = params;
            location.href = url;
        }
    </script>

@endpush
