@extends('back.layouts.backend')

@push('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/slim/slim.css') }}">

    @stack('product_css')
@endpush

@section('content')

    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">
                    <a class="btn btn-light js-tooltip-enabled" style="margin-bottom: 5px;" href="{{ route('apartments') }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Top Tooltip">
                        <i class="fa fa-arrow-left mr-1"></i>
                    </a>
                    {{ __('back/apartment.edit') }}
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('apartments') }}">{{ __('back/apartment.titles') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('back/apartment.edit') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="content content-full">
        @include('back.layouts.partials.session')


        <form action="{{ isset($apartment) ? route('apartments.update', ['apartment' => $apartment]) : route('apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($apartment))
                {{ method_field('PATCH') }}
            @endif


            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('back/apartment.osnovneinformacije') }}</h3>
                </div>

                <div class="block-content block-content-full">
                    <div class="row justify-content-center push">
                        <div class="col-md-11">
                            <div class="form-group row items-push">
                                <div class="col-md-12 ">


                                    <div class="row">
                                        <div class="col-md-12 mt-3 mb-3">

                                            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#btabs-static-home">Home</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#btabs-static-profile">Profile</a>
                                                </li>
                                                <li class="nav-item ml-auto">
                                                    <a class="nav-link" href="#btabs-static-settings">
                                                        <i class="si si-settings"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="block-content tab-content">
                                                <div class="tab-pane active" id="btabs-static-home" role="tabpanel">
                                                    <h4 class="font-w400">Home Content</h4>
                                                    <p>...</p>
                                                </div>
                                                <div class="tab-pane" id="btabs-static-profile" role="tabpanel">
                                                    <h4 class="font-w400">Profile Content</h4>
                                                    <p>...</p>
                                                </div>
                                                <div class="tab-pane" id="btabs-static-settings" role="tabpanel">
                                                    <h4 class="font-w400">Settings Content</h4>
                                                    <p>...</p>
                                                </div>
                                            </div>



                                            <label for="dm-post-edit-title">{{ __('back/apartment.nazivapartmana') }}  <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="title-input" name="title" placeholder="" value="{{ isset($apartment) ? $product->title : old('title') }}">
                                            @error('name')
                                            <span class="text-danger font-italic">{{ __('back/apartment.nazivapartmana_error') }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="type-select">{{ __('back/apartment.tip') }} <span class="text-danger">*</span></label>
                                            <select class="js-select2 form-control" id="type-select" name="type_id" style="width: 100%;">
                                                <option></option>
                                                @foreach (config('settings.apartment_types') as $select_item)
                                                    <option value="{{ $select_item['id'] }}" {{ ((isset($apartment)) and ($select_item['id'] == $apartment->type_id)) ? 'selected' : (( ! isset($apartment) and ($select_item['default'] == 1)) ? 'selected' : '') }}>{{ $select_item['title'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="target-select">{{ __('back/apartment.namjena') }}<span class="text-danger">*</span></label>
                                            <select class="js-select2 form-control" id="target-select" name="target_id" style="width: 100%;">
                                                <option></option>
                                                @foreach (config('settings.apartment_targets') as $select_item)
                                                    <option value="{{ $select_item['id'] }}" {{ ((isset($apartment)) and ($select_item['id'] == $apartment->target_id)) ? 'selected' : (( ! isset($apartment) and ($select_item['default'] == 1)) ? 'selected' : '') }}>{{ $select_item['title'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="dm-post-edit-title">{{ __('back/apartment.sifra') }} <span class="text-danger"></span></label>
                                            <input type="text" class="form-control" id="sku-input" name=sku" placeholder="" value="{{ isset($apartment) ? $product->sku : old('sku') }}">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <h2 class="content-heading">{{ __('back/apartment.lokacija') }}</h2>

                            <div class="form-group row items-push">
                                <div class="col-md-12">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.ulica') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="" value="{{ isset($apartment) ? $product->address : old('addres') }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.grad') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="" value="{{ isset($apartment) ? $product->city : old('city') }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.zip') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="" value="{{ isset($apartment) ? $product->zip : old('zip') }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.drzava') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="country" name="country" placeholder="" value="{{ isset($apartment) ? $product->country : old('country') }}" readonly>
                                </div>

                                <div class="col-md-6 ">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.latitude') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtLat" name="txtLat" placeholder="" value="{{ isset($apartment) ? $product->txtLat : old('txtLat') }}" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.longitude') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="txtLng" name="txtLng" placeholder="" value="{{ isset($apartment) ? $product->txtLng : old('txtLng') }}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <div class="alert alert-info mb-0" role="alert">
                                        <i class="fa fa-info-circle"></i> {{ __('back/apartment.porukakarta') }}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <input
                                        id="pac-input"
                                        class="controls form-control "
                                        type="text"
                                        placeholder="{{ __('back/apartment.searchaddress') }}" style="height:42px;margin-top:9px;width:400px;border-radius:0"
                                    />
                                    <div id="map_canvas" style="width: auto; height: 500px;">
                                    </div>
                                </div>
                            </div>


                            <h2 class="content-heading">{{ __('back/apartment.cijenetitle') }}
                              <!--  <small class="text-gray-dark ml-3">{{ __('back/apartment.cijenetitle') }}Treba li možda više cijena. Kao pred/post sezonske cijene?...</small> -->
                            </h2>

                            <div class="form-group row items-push">
                                <div class="col-md-6">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.price') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="price-input" name="price" placeholder="" value="{{ isset($apartment) ? $product->price : old('price') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.priceprema') }} <span class="text-danger"></span></label>
                                    <select class="js-select2 form-control" id="price-by-select" name="price_by" style="width: 100%;">
                                        <option></option>
                                        @foreach (config('settings.apartment_price_by') as $key => $select_item)
                                            <option value="{{ $key }}" {{ ((isset($apartment)) and ($key == $apartment->price_per)) ? 'selected' : (( ! isset($apartment) and ($select_item['default'] == 1)) ? 'selected' : '') }}>{{ $select_item['title'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="price-input">{{ __('back/apartment.tax') }}</label>
                                    <select class="js-select2 form-control" id="tax-select" name="tax_id" style="width: 100%;" data-placeholder="{{ __('back/apartment.select') }}">
                                        <option></option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row items-push mb-3">
                                <div class="col-md-6">
                                    <label for="special-input">{{ __('back/apartment.cijanapopust') }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="special-input" name="special" placeholder="00.00" value="{{ isset($apartment) ? $apartment->special : old('special') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kn</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="special-from-input">{{ __('back/apartment.trajanjepopusta') }}</label>
                                    <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <input type="text" class="form-control" id="special-from-input" name="special_from" placeholder="{{ __('back/apartment.od') }}" value="{{ isset($apartment->special_from) ? \Carbon\Carbon::make($apartment->special_from)->format('d.m.Y') : '' }}" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text font-w600"><i class="fa fa-fw fa-arrow-right"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="special-to-input" name="special_to" placeholder="{{ __('back/apartment.do') }}" value="{{ isset($apartment->special_to) ? \Carbon\Carbon::make($apartment->special_to)->format('d.m.Y') : '' }}" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                    </div>
                                </div>
                            </div>


                            <h2 class="content-heading">{{ __('back/apartment.opis') }}</h2>

                            <div class="form-group row mb-4">
                                <div class="col-md-12">
                                    <textarea id="description-editor" name="description">{!! isset($apartment) ? $apartment->description : old('description') !!}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('back/apartment.amenities') }}</h3>
                </div>

                <div class="block-content block-content-full">
                    <div class="row justify-content-center push">
                        <div class="col-md-11">

                            <h2 class="content-heading">{{ __('back/apartment.amenities') }}</h2>

                            <div class="form-group row items-push">
                                @foreach (config('settings.apartment_details') as $detail)
                                    <div class="col-md-2">
                                        <div class="custom-control custom-switch custom-control-lg mb-2">
                                            <input type="checkbox" class="custom-control-input" id="example-sw-custom-lg1" name="example-sw-custom-lg1" {{ (isset($apartment->detail) and $apartment->detail) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="example-sw-custom-lg1">{{ $detail['title'] }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>




            </div>


            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('back/apartment.dodatneinformacije') }}</h3>
                </div>

                <div class="block-content block-content-full">
                    <div class="row justify-content-center push">
                        <div class="col-md-11">
                            <div class="form-group row items-push">
                                <div class="col-md-3">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.m2') }}</label>
                                    <input type="text" class="form-control" id="name-input" name="name" placeholder="" value="{{ isset($apartment) ? $apartment->title : old('title') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.brojsoba') }}</label>
                                    <input type="text" class="form-control" id="name-input" name="name" placeholder="" value="{{ isset($apartment) ? $apartment->title : old('title') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.brojkreveta') }}</label>
                                    <input type="text" class="form-control" id="name-input" name="name" placeholder="" value="{{ isset($apartment) ? $apartment->title : old('title') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.brojkupaonica') }}</label>
                                    <input type="text" class="form-control" id="name-input" name="name" placeholder="" value="{{ isset($apartment) ? $apartment->title : old('title') }}">
                                </div>
                            </div>



                            <h2 class="content-heading">{{ __('back/apartment.unosinfo') }}</h2>

                            <div class="form-group row items-push">

                                    <div class=" col-md-12 ">

                                        <div class="bg-gray-light text-gray-darker p-3 pt-0 pb-0">
                                        <div class="row ">

                                                <div class="col-md-8 mt-3">
                                                    <p>{{ __('back/apartment.odaberiteinfo') }}<br>
                                                        <small>{{ __('back/apartment.odaberiteinfotext') }}</small>
                                                    </p>
                                                </div>
                                                <div class="col-md-4 mt-4">
                                                    <select class="js-select2 form-control" id="favorite-select" name="favorite_id" style="width: 100%;" data-placeholder="{{ __('back/apartment.select') }}">
                                                        <option></option>
                                                        <option value="1">Favorit bazen</option>
                                                        <option value="2">Favorit parking</option>
                                                        <option value="3">Favorit roštilj</option>
                                                    </select>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                <div class="col-md-8">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.titleinfo') }}</label>
                                    <input type="text" class="form-control" id="name-input" name="name" placeholder="" value="{{ isset($apartment) ? $apartment->title : old('title') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.value') }}</label>
                                    <input type="text" class="form-control" id="name-input" name="name" placeholder="" value="{{ isset($apartment) ? $apartment->title : old('title') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="dm-post-edit-title">{{ __('back/apartment.kratkiopisinfo') }}</label>
                                    <textarea class="form-control" id="name-input" name="name" placeholder="{{ __('back/apartment.opisinfo') }}" rows="4">{{ isset($apartment) ? $apartment->title : old('title') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="dm-post-edit-title">{{ __('back/apartment.ikona') }}</label>
                                            <select class="js-select2 form-control" id="icon-select" name="icon_id" style="width: 100%;" data-placeholder="{{ __('back/apartment.odaberiteikonu') }}">
                                                <option></option>
                                                <option value="1">Ikona bazen</option>
                                                <option value="2">Ikona parking</option>
                                                <option value="3">Ikona roštilj</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dm-post-edit-title">{{ __('back/apartment.galerijainfo') }}</label>
                                            <select class="js-select2 form-control" id="gallery-select" name="gallery_id" style="width: 100%;" data-placeholder="{{ __('back/apartment.galerijainfotext') }}">
                                                <option></option>
                                                <option value="1">Galerija Bazen mali</option>
                                                <option value="2">Galerija Bazen veliki</option>
                                                <option value="3">Galerija Parking Vila Ante 1</option>
                                                <option value="3">Galerija Parking Vila Mila 1</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mt-4">
                                            <button type="submit" class="btn btn-outline-info btn-block my-2">{{ __('back/apartment.btnnovagalerija') }}</button>
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <button type="submit" class="btn btn-outline-info btn-block my-2">{{ __('back/apartment.btnfavoriti') }}</button>
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <button type="submit" class="btn btn-success btn-block my-2">
                                                <i class="fas fa-save mr-1"></i> {{ __('back/apartment.btnsnimi') }}
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <h2 class="content-heading">{{ __('back/apartment.listaunesenihnaslov') }}</h2>

                            <div class="form-group row items-push">
                                <div class="col-md-12">

                                    <table class="table table-vcenter">
                                        <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">#</th>
                                            <th>{{ __('back/apartment.titleinfo') }}</th>
                                            <th class="d-none d-sm-table-cell" style="width: 25%;">{{ __('back/apartment.value') }}</th>
                                            <th class="text-center" style="width: 100px;">{{ __('back/apartment.action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th class="text-center" scope="row">1</th>
                                            <td class="font-w600">
                                                <a href="be_pages_generic_profile.html">Blizina bolnice</a>
                                                <p class="small text-gray-dark mb-0">Neki kratki opis informacije za bolnicu i zašto je super što je 450m.</p>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                450m
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center" scope="row">2</th>
                                            <td class="font-w600">
                                                <a href="be_pages_generic_profile.html">VIP Organizirani izlet</a>
                                                <p class="small text-gray-dark mb-0">Neki kratki tekst o izletu. Može biti i prazno.</p>
                                            </td>
                                            <td class="d-none d-sm-table-cell">
                                                Besplatno
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __('back/apartment.galerijainfo') }}</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row justify-content-center">
                        <div class="col-md-11">

                        </div>
                    </div>
                </div>
            </div>


        </form>

        {{--@if (isset($product))
            <form id="delete-product-form{{ $product->id }}" action="{{ route('products.destroy', ['product' => $product]) }}" method="POST" style="display: none;">
                @csrf
                {{ method_field('DELETE') }}
            </form>
        @endif--}}
    </div>
@endsection

@push('modals')

    <div class="modal fade" id="images-modal" tabindex="-1" role="dialog" aria-labelledby="images-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout modal-xl" role="document">
            <div class="modal-content rounded">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{ __('back/apartment.slike') }}</h3>
                        <div class="block-options">
                            <a class="text-muted font-size-h3" href="#" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-10">

                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <a class="btn btn-sm btn-light" data-dismiss="modal" aria-label="Close">
                            {{ __('back/apartment.btnodustani') }} <i class="fa fa-times ml-2"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" onclick="event.preventDefault(); confirmDelete();">
                            {{ __('back/apartment.btnsnimi') }} <i class="fa fa-save ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ckeditor5-classic/build/ckeditor.js') }}"></script>
    <script src="{{ asset('js/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('js/plugins/slim/slim.kickstart.js') }}"></script>

    <!-- Page JS Helpers (CKEditor 5 plugins) -->
    <script>jQuery(function(){Dashmix.helpers(['datepicker']);});</script>

    <script>
        $(() => {
            ClassicEditor
            .create(document.querySelector('#description-editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

            $('#tax-select').select2({ minimumResultsForSearch: Infinity });
            $('#favorite-select').select2({ minimumResultsForSearch: Infinity });
            $('#icon-select').select2({ minimumResultsForSearch: Infinity });
            $('#gallery-select').select2({ minimumResultsForSearch: Infinity });

            $('#type-select').select2({ minimumResultsForSearch: Infinity });
            $('#target-select').select2({ minimumResultsForSearch: Infinity });
            $('#price-by-select').select2({ minimumResultsForSearch: Infinity });


          /*  Livewire.on('success_alert', () => {

            });

            Livewire.on('error_alert', (e) => {

            });*/
        })
    </script>

    <script>
        function SetSEOPreview() {
            let title = $('#name-input').val();
            $('#slug-input').val(slugify(title));
        }


        /**
         *
         * @param item
         * @param type
         */
        function openModal(item = {}) {
            //console.log(item);

            $('#images-modal').modal('show');
            //editStatus(item);
        }
    </script>

    @stack('product_scripts')

@endpush
