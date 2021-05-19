@extends('front.layouts.app')

@section('content')

    <!-- Hero section-->
    <section class="bg-accent bg-position-top-left bg-repeat-0 py-5" style="background-image: url('img/indexslika.jpg');-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
        <div class="pb-lg-5 mb-lg-3">
            <div class="container py-lg-4 my-lg-5">
                <div class="row mb-3 mb-sm-3">
                    <div class="col-lg-7 col-md-9  text-start">
                        <h1 class="text-white lh-base">Knjige, vedute & zemljovidi</h1>
                        <h2 class="h5 text-white fw-light">Dobrodošli na stranice Antikvarijata Biblos.</h2>
                    </div>
                </div>
                <div class="row pb-lg-5 mb-4 mb-sm-5">
                    <div class="col-lg-6 col-md-8">
                        <div class="input-group input-group-lg flex-nowrap">
                            <input class="form-control rounded-start" type="text" placeholder="Pretražite po nazivu ili autoru">

                            <button class="btn btn-primary btn-lg  fs-base" type="button" ><i class="ci-search "></i></button>

                        </div>

                        <div class="form-text text-white py-2"><span class="text-muted-light">*</span> Sve knjige na stranici su dostupne
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured products (Carousel)-->
    <section class="container position-relative pt-3 pt-lg-0 pb-5 mt-lg-n10" style="z-index: 10;">
        <div class="card px-lg-2 border-0 shadow-lg">
            <div class="card-body px-4 pt-5 pb-4">
                <h2 class="h3 text-center">Izdvojeno iz naše ponude</h2>
                <p class="text-muted-light text-center">Svakog tjedna ručno odabiremo neke od najatraktivnijih knjiga iz naše kolekcije</p>
                <!-- Carousel-->
                <div class="tns-carousel pt-4">
                    <div class="tns-carousel-inner" data-carousel-options='{"items": 2, "controls": false, "nav": true, "autoHeight": true, "responsive": {"0":{"items":1},"500":{"items":2, "gutter": 18},"768":{"items":3, "gutter": 20}, "1100":{"items":4, "gutter": 30}}}'>
                        <!-- Product-->
                        <div>
                            <div class="card product-card-alt">
                                <div class="product-thumb">
                                    <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                                    <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                        <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                                    </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga.jpg" alt="Product">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                        <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                                Wroblewski David </a></div>
                                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                        </div>
                                    </div>
                                    <h3 class="product-title fs-sm mb-2"><a href="product.html">Priča o Edgaru Sawtelleu</a></h3>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Književnost</span></div>
                                        <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">80.<small>00kn</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product-->
                        <div>
                            <div class="card product-card-alt">
                                <div class="product-thumb">
                                    <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                                    <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                        <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                                    </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga2.jpg" alt="Product">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                        <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                                Lynds Gayle </a></div>
                                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                        </div>
                                    </div>
                                    <h3 class="product-title fs-sm mb-2"><a href="product.html">Mozaik</a></h3>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Književnost</span></div>
                                        <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">80.<small>00kn</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product-->
                        <div>
                            <div class="card product-card-alt">
                                <div class="product-thumb">
                                    <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                                    <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                        <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                                    </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga3.jpg" alt="Product">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                        <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                                Gall Zlatko </a></div>
                                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                        </div>
                                    </div>
                                    <h3 class="product-title fs-sm mb-2"><a href="product.html">Velika svjetska rock enciklopedija</a></h3>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Glazba</span></div>
                                        <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">100.<small>00kn</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product-->
                        <div>
                            <div class="card product-card-alt">
                                <div class="product-thumb">
                                    <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                                    <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                        <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                                    </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga4.jpg" alt="Product">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                        <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                                Camus Albert </a></div>
                                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                        </div>
                                    </div>
                                    <h3 class="product-title fs-sm mb-2"><a href="product.html">Stranac</a></h3>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Književnost</span></div>
                                        <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">100.<small>00kn</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product-->
                        <div>
                            <div class="card product-card-alt">
                                <div class="product-thumb">
                                    <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                                    <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                        <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                                    </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga3.jpg" alt="Product">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                        <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                                Gall Zlatko </a></div>
                                        <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                        </div>
                                    </div>
                                    <h3 class="product-title fs-sm mb-2"><a href="product.html">Velika svjetska rock enciklopedija</a></h3>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Glazba</span></div>
                                        <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">100.<small>00kn</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent products grid-->
    <section class="container pb-4 mb-lg-3">
        <!-- Heading-->

        <h2 class="h3 text-center">Novo u ponudi</h2>
        <p class="text-muted-light text-center ">Svakodnevno nove knjige u ponudi</p>


        <!-- Grid-->
        <div class="tns-carousel pt-4">
            <div class="tns-carousel-inner" data-carousel-options='{"items": 2, "controls": false, "nav": true, "autoHeight": true, "responsive": {"0":{"items":1},"500":{"items":2, "gutter": 18},"768":{"items":3, "gutter": 20}, "1100":{"items":4, "gutter": 30}}}'>
                <!-- Product-->
                <div>
                    <div class="card product-card-alt">
                        <div class="product-thumb">
                            <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                            </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga.jpg" alt="Product">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                        Wroblewski David </a></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                            <h3 class="product-title fs-sm mb-2"><a href="product.html">Priča o Edgaru Sawtelleu</a></h3>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Književnost</span></div>
                                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">80.<small>00kn</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product-->
                <div>
                    <div class="card product-card-alt">
                        <div class="product-thumb">

                            <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                            </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga2.jpg" alt="Product">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                        Lynds Gayle </a></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                            <h3 class="product-title fs-sm mb-2"><a href="product.html">Mozaik</a></h3>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Književnost</span></div>
                                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">80.<small>00kn</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product-->
                <div>
                    <div class="card product-card-alt">
                        <div class="product-thumb">

                            <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                            </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga3.jpg" alt="Product">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                        Gall Zlatko </a></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                            <h3 class="product-title fs-sm mb-2"><a href="product.html">Velika svjetska rock enciklopedija</a></h3>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Glazba</span></div>
                                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">100.<small>00kn</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product-->
                <div>
                    <div class="card product-card-alt">
                        <div class="product-thumb">
                            <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                            <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                            </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga4.jpg" alt="Product">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                        Camus Albert </a></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                            <h3 class="product-title fs-sm mb-2"><a href="product.html">Stranac</a></h3>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Književnost</span></div>
                                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">100.<small>00kn</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product-->
                <div>
                    <div class="card product-card-alt">
                        <div class="product-thumb">
                            <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                            <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                            </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga3.jpg" alt="Product">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                        Gall Zlatko </a></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                            <h3 class="product-title fs-sm mb-2"><a href="product.html">Velika svjetska rock enciklopedija</a></h3>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Glazba</span></div>
                                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">100.<small>00kn</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- More button-->

    </section>

    <section class="container pb-3 mb-md-3">
        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="d-sm-flex justify-content-between align-items-center bg-third overflow-hidden rounded-3">
                    <div class="py-4 my-2 my-md-0 py-md-5 px-4 ms-md-3 text-center text-sm-start">

                        <h3 class="mb-4">Stare i rijetke knjige</h3><a class="btn btn-primary btn-shadow btn-sm" href="#">Pogledajte ponudu <i class="ci-arrow-right "></i></a>
                    </div><img class="d-block ms-auto" src="img/bannerstaro.jpg" alt="Stare i rijetke knjige">
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="d-flex flex-column h-100 justify-content-center bg-size-cover bg-position-center rounded-3" style="background-image: url('img/bannerkarte.jpg');">
                    <div class="py-4 my-2 px-4 text-center">
                        <div class="py-1">
                            <h3 class="mb-4 text-white">Vedute i karte</h3>
                            <a class="btn btn-primary btn-shadow btn-sm" href="#">Pogledajte ponudu <i class="ci-arrow-right "></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent products grid-->
    <section class="container pb-5 mb-lg-3">
        <!-- Heading-->

        <h2 class="h3 text-center">Knjige za djecu i mlade</h2>
        <p class="text-muted-light text-center ">Lektira i knjige za djecu i mlade</p>


        <!-- Grid-->
        <div class="tns-carousel pt-4">
            <div class="tns-carousel-inner" data-carousel-options='{"items": 2, "controls": false, "nav": true, "autoHeight": true, "responsive": {"0":{"items":1},"500":{"items":2, "gutter": 18},"768":{"items":3, "gutter": 20}, "1100":{"items":4, "gutter": 30}}}'>
                <!-- Product-->
                <div>
                    <div class="card product-card-alt">
                        <div class="product-thumb">
                            <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                            <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="#"><i class="ci-eye"></i></a>
                                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                            </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga.jpg" alt="Product">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                        Wroblewski David </a></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                            <h3 class="product-title fs-sm mb-2"><a href="product.html">Priča o Edgaru Sawtelleu</a></h3>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Književnost</span></div>
                                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">80.<small>00kn</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product-->
                <div>
                    <div class="card product-card-alt">
                        <div class="product-thumb">
                            <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                            <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                            </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga2.jpg" alt="Product">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                        Lynds Gayle </a></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                            <h3 class="product-title fs-sm mb-2"><a href="product.html">Mozaik</a></h3>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Književnost</span></div>
                                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">80.<small>00kn</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product-->
                <div>
                    <div class="card product-card-alt">
                        <div class="product-thumb">
                            <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                            <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                            </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga3.jpg" alt="Product">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                        Gall Zlatko </a></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                            <h3 class="product-title fs-sm mb-2"><a href="product.html">Velika svjetska rock enciklopedija</a></h3>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Glazba</span></div>
                                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">100.<small>00kn</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product-->
                <div>
                    <div class="card product-card-alt">
                        <div class="product-thumb">
                            <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                            <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                            </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga4.jpg" alt="Product">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                        Camus Albert </a></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                            <h3 class="product-title fs-sm mb-2"><a href="product.html">Stranac</a></h3>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Književnost</span></div>
                                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">100.<small>00kn</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product-->
                <div>
                    <div class="card product-card-alt">
                        <div class="product-thumb">
                            <button class="btn-wishlist btn-sm" type="button"><i class="ci-heart"></i></button>
                            <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="product.html"><i class="ci-eye"></i></a>
                                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"><i class="ci-cart"></i></button>
                            </div><a class="product-thumb-overlay" href="product.html"></a><img src="img/knjiga3.jpg" alt="Product">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                                <div class="text-muted fs-xs me-1"><a class="product-meta fw-medium" href="product.html">

                                        Gall Zlatko </a></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                            <h3 class="product-title fs-sm mb-2"><a href="product.html">Velika svjetska rock enciklopedija</a></h3>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fs-sm me-2"><i class="ci-book text-muted me-1"></i><span class="fs-xs ms-1">Glazba</span></div>
                                <div class="bg-faded-accent text-accent rounded-1 py-1 px-2">100.<small>00kn</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- More button-->

    </section>

    <!-- Blog posts carousel-->
    <section class=" border-top mb-0 pb-5 py-5" style="background-image: url('img/glag.png');-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
        <div class="container py-lg-3">
            <h2 class="h3 text-center">Iz medija</h2>
            <p class="text-muted-light text-center mb-3 pb-4">Medijske objave, članci i obavijesti</p>
            <div class="tns-carousel pb-5">
                <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;gutter&quot;: 15, &quot;controls&quot;: false, &quot;nav&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3}, &quot;992&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 30}}}">
                    <div>
                        <div class="card"><a class="blog-entry-thumb" href="#"><img class="card-img-top" src="img/novosti.jpg" alt="Post"></a>
                            <div class="card-body">
                                <h2 class="h6 blog-entry-title"><a href="product.html">Vlasnik Daniel: Trudim se naći najstarije primjerke naših djela</a></h2>
                                <p class="fs-sm">Bavimo se vraćanju hrvatske knjižne građe koja svjedoči našoj povijesti i običajima. Većina tih knjiga tiskana je vani te ih je teško naći...</p>
                                <div class="fs-xs text-nowrap"><a class="blog-entry-meta-link text-nowrap" href="#">23. Lip 2021</a><span class="blog-entry-meta-divider mx-2"></span> 24 sata</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card"><a class="blog-entry-thumb" href="#"><img class="card-img-top" src="img/novosti2.jpg" alt="Post"></a>
                            <div class="card-body">
                                <h2 class="h6 blog-entry-title"><a href="#">Dvostruki je užitak spasiti vrijednu staru knjigu i još zaraditi na tome</a></h2>
                                <p class="fs-sm">Zagrebački antikvarijat Biblos uspješno posluje već sedamnaest godina, što je za vrijeme u kojem su knjige sve manje na cijeni impresivan broj.</p>
                                <div class="fs-xs text-nowrap"><a class="blog-entry-meta-link text-nowrap" href="#">23. Lip 2021</a><span class="blog-entry-meta-divider mx-2"></span> Lider Media</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card"><a class="blog-entry-thumb" href="#"><img class="card-img-top" src="img/novosti3.jpg" alt="Post"></a>
                            <div class="card-body">
                                <h2 class="h6 blog-entry-title"><a href="#">Od štanda na Britancu do poznatog antikvarijata</a></h2>
                                <p class="fs-sm">Daniel Glavan o svom putu, opsesiji i rijetkim knjigama koje dovlači iz Europe. Neke spektakularne pronašao je i u zagrebačkim podrumima... </p>
                                <div class="fs-xs text-nowrap"><a class="blog-entry-meta-link text-nowrap" href="#">23. Lip 2021</a><span class="blog-entry-meta-divider mx-2"></span> Telegram</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>

    <section class="container-fluid pt-grid-gutter bg-third">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-grid-gutter"><a class="card h-100" href="#map" data-scroll="">
                        <div class="card-body text-center"><i class="ci-location h3 mt-2 mb-4 text-primary"></i>
                            <h3 class="h6 mb-2">Adresa</h3>
                            <p class="fs-sm text-muted">Palmotićeva 28, Zagreb</p>
                            <div class="fs-sm text-primary">Kliknite za mapu<i class="ci-arrow-right align-middle ms-1"></i></div>
                        </div></a></div>
                <div class="col-xl-3 col-sm-6 mb-grid-gutter">
                    <div class="card h-100">
                        <div class="card-body text-center"><i class="ci-time h3 mt-2 mb-4 text-primary"></i>
                            <h3 class="h6 mb-3">Radno vrijeme</h3>
                            <ul class="list-unstyled fs-sm text-muted mb-0">
                                <li>Pon - pet: 09 - 20h</li>
                                <li class="mb-0">Sub: 09 - 14h</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6  mb-grid-gutter">
                    <div class="card h-100">
                        <div class="card-body text-center"><i class="ci-phone h3 mt-2 mb-4 text-primary"></i>
                            <h3 class="h6 mb-3">Telefoni</h3>
                            <ul class="list-unstyled fs-sm mb-0">
                                <li><a class="nav-link-style text-primary" href="tel:+38514816574"> +385 1 48 16 574</a></li>
                                <li><a class="nav-link-style text-primary" href="tel:++385981629674"> +385 98 16 29 674</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-grid-gutter">
                    <div class="card h-100">
                        <div class="card-body text-center"><i class="ci-mail h3 mt-2 mb-4 text-primary"></i>
                            <h3 class="h6 mb-3">Email adresa</h3>
                            <ul class="list-unstyled fs-sm mb-0">
                                <li><a class="nav-link-style text-primary" href="mailto:info@antikvarijat-biblos.hr">info@antikvarijat-biblos.hr</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection