@extends('front.layouts.app')

@push('css_after')

@endpush

@section('content')

    <div class="page-banner full-row bg-white py-5">
        <div class="container">
            <div class="row row-cols-md-2 row-cols-1 g-3">
                <div class="col">
                    <h3 class="page-name text-secondary m-0"> <a href="javascript:history.back()"><i class="fas fa-angle-left me-5"></i></a> Confirm and pay</h3>
                </div>

            </div>
        </div>
    </div>
    <!--============== Banner Section End ==============-->

    <!--============== Get In Touch Section Start ==============-->
    <div class="full-row bg-white pt-0">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 offset-lg-1 order-lg-2 content">
                    <div class="sidebar">
                        <div class="mt-lg-4 p-4 mb-4 shadow-one reservationbox ">
                            <div class="img-80 float-start me-3 mb-4 rounded-circle"><img src="assets/images/apartmani/4.jpeg" alt=""></div>
                            <h5 class="mt-2 mb-0 text-primary">{{ $checkout->apartment->title }}</h5>
                            <p class="mb-0">Entire rental unit</p>
                            <div class="clearfix"></div>
                            <div class="row row-cols-1 ">
                                <div class="col mt-0">
                                    <h4 class="mt-0 mb-2 text-primary">Price details</h4>
                                    <ul class="list-group mb-3">
                                            @foreach ($total['items'] as  $item)
                                                <li class="list-group-item d-flex justify-content-between py-3 lh-sm">
                                                    <div>
                                                        <h6 class="my-0">{{  $item['amount'] }} {{ $checkout->main_currency->symbol_right  }} x {{ $item['count'] }} {{ $item['title'] }} </h6>
                                                    </div>
                                                    <span class="text-muted">{{ $item['total'] }}  {{ $checkout->main_currency->symbol_right  }}</span>
                                                </li>
                                            @endforeach
                                             @foreach ($total['total'] as  $item)
                                                <li class="list-group-item d-flex justify-content-between bg-light">
                                                    <h5 class="my-0">{{ $item['title'] }} </h5>
                                                    <strong> {{ $checkout->main_currency->symbol_left  }} {{ $item['total'] }} {{ $checkout->main_currency->symbol_right  }}</strong>
                                                </li>
                                            @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7  order-lg-1 mt-0">
                    <form id="checkout-view-form" class="" action="{{ route('checkout.view') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="apartment_id" value="{{ $checkout->apartment->id }}">
                        <input type="hidden" name="from" value="{{ $checkout->apartment->from }}">
                        <input type="hidden" name="to" value="{{ $checkout->apartment->to }}">
                        <input type="hidden" name="adults" value="{{ $checkout->apartment->adults }}">
                        <input type="hidden" name="children" value="{{ $checkout->apartment->children }}">

                        <div class="row mb-4">
                            <div class="col-12">
                                <h4 class="text-secondary my-4 mt-0">Your reservation</h4>
                                <div class="overflow-x-scroll pb-3">
                                    <table class="tab-table w-100 text-secondary">
                                        <tbody>
                                        <tr>
                                            <td ><strong>Dates</strong></td>
                                            <td>{{ $checkout->from->format('d.m.Y') }} – {{ $checkout->to->format('d.m.Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Guests</strong></td>
                                            <td>{{ $checkout->adults + $checkout->children }} guests</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-12">
                                <h4 class="text-secondary my-4 mt-4">Personal Info</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" id="name" name="firstname" class="form-control bg-gray mb-3" placeholder="Name*">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="lastname" name="lastname" class="form-control bg-gray mb-3" placeholder="Surname*">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="phone" name="phone" class="form-control bg-gray mb-3" placeholder="Mobile number*">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="email" name="email" class="form-control bg-gray mb-3" placeholder="Email Address*">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h4 class="text-secondary my-4 mt-4">Pay with</h4>
                                <ul class="list-group mb-4">

                                    @foreach ($payment_methods['items'] as  $item)


                                        <li class="list-group-item p-3">
                                            <label>
                                                <input class="form-check-input me-1 mt-2" type="radio" name="paymenttype" value="paypal" aria-label="...">
                                                {{ $item['title'] }}
                                            </label>
                                            <div class="payments-card ms-4" >
                                                <img class="ccard"  src="assets/images/cards/paypal.svg">
                                            </div>
                                        </li>


                                    @endforeach




                                </ul>
                            </div>

                            <div class="col-12">
                                <h4 class="text-secondary my-4 mt-4">Additional Comments</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <textarea id="message" name="message" class="form-control bg-gray mb-3" rows="5" placeholder="Type Comments..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="alert alert-secondary" role="alert">
                                    By selecting the button below, I agree to the <a href="#" class="alert-link">updated Terms of Service, Payments Terms of Service, and I acknowledge the Privacy Policy.</a>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" id="send" value="send message" class="btn btn-lg btn-primary">Confirm and Pay</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js_after')

@endpush
