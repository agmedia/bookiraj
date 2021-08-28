<aside class="col-lg-4">
    <!-- Sidebar-->
    <div class="offcanvas offcanvas-collapse bg-white w-100 rounded-3 shadow-lg py-1" id="shop-sidebar" style="max-width: 22rem;">
        <div class="offcanvas-cap align-items-center shadow-sm">
            <h2 class="h5 mb-0">Filtriraj</h2>
            <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body py-grid-gutter px-lg-grid-gutter">
            <!-- Categories-->
            @if ($categories)
                <div class="widget widget-categories mb-4 pb-4 border-bottom">
                    @if (! $subcategory)
                        <h3 class="widget-title">Kategorije</h3>
                    @else
                        <h3 class="widget-title">Podkategorije</h3>
                    @endif
                    <div class="accordion mt-n1" id="shop-categories">
                        @foreach ($categories as $category)
                            <div class="accordion-item @if( ! $loop->last) border-bottom @endif">
                                @if ($category->subcategories->count())
                                    <h3 class="accordion-header">
                                        <a href="{{ route('catalog.route', ['group' => \Illuminate\Support\Str::lower($category->group), 'cat' => $category]) }}" class="accordion-button py-2 none collapsed" role="link">
                                            {{ $category->title }} <span class="badge bg-secondary ms-2 position-absolute end-0">{{ $category->products()->count() }}</span>
                                        </a>
                                    </h3>
                                @else

                                    @if ($category->parent()->first())
                                        <h3 class="accordion-header">
                                            <a href="{{ route('catalog.route', ['group' => \Illuminate\Support\Str::lower($category->group), 'cat' => $category->parent()->first(), 'subcat' => $category]) }}" class="accordion-button py-2 none collapsed" role="link">
                                                {{ $category->title }} <span class="badge bg-secondary ms-2 position-absolute end-0">{{ $category->products()->count() }}</span>
                                            </a>
                                        </h3>
                                    @else
                                        <h3 class="accordion-header">
                                            <a href="{{ route('catalog.route', ['group' => \Illuminate\Support\Str::lower($category->group), 'cat' => $category]) }}" class="accordion-button py-2 none collapsed" role="link">
                                                {{ $category->title }} <span class="badge bg-secondary ms-2 position-absolute end-0">{{ $category->products()->count() }}</span>
                                            </a>
                                        </h3>
                                    @endif

                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif


            <!-- Filter by Brand-->
            @if ($authors)
                <div class="widget widget-filter mb-4 pb-4 border-bottom">
                    <h3 class="widget-title">Autor</h3>
                    <div class="input-group input-group-sm mb-2">
                        <input class="widget-filter-search form-control rounded-end pe-5" type="text" placeholder="Pretraži autora"><i class="ci-search position-absolute top-50 end-0 translate-middle-y fs-sm me-3"></i>
                    </div>
                    <ul class="widget-list widget-filter-list list-unstyled pt-1" style="max-height: 11rem;" data-simplebar data-simplebar-auto-hide="false" wire:ignore>
                        @foreach ($authors as $author)
                            <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="author.{{ $author->id }}" value="{{ $author->slug }}" id="author_{{ $author->id }}">
                                    <label class="form-check-label widget-filter-item-text" for="author_{{ $author->id }}">{{ $author->title }}</label>
                                </div><span class="fs-xs text-muted">{{ $author->broj }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- Filter by NAkladnik-->
            @if ($publishers)
                <div class="widget widget-filter mb-4 pb-4 border-bottom">
                    <h3 class="widget-title">Nakladnici</h3>
                    <div class="input-group input-group-sm mb-2">
                        <input class="widget-filter-search form-control rounded-end pe-5" type="text" placeholder="Pretraži nakladnika"><i class="ci-search position-absolute top-50 end-0 translate-middle-y fs-sm me-3"></i>
                    </div>
                    <ul class="widget-list widget-filter-list list-unstyled pt-1" style="max-height: 11rem;" data-simplebar data-simplebar-auto-hide="false">
                        @foreach ($publishers as $publisher)
                            <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="publisher.{{ $publisher->id }}" value="{{ $publisher->slug }}" id="publisher_{{ $publisher->id }}">
                                    <label class="form-check-label widget-filter-item-text" for="publisher_{{ $publisher->id }}">{{ $publisher->title }}</label>
                                </div><span class="fs-xs text-muted">{{ $publisher->broj }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Price range-->
            <div class="widget mb-4 pb-4 border-bottom">
                <h3 class="widget-title">Godina izdanja</h3>
                <div class="range-slider" data-start-min="1898" data-start-max="2020" data-min="1624" data-max="2021" data-step="1">
                    <div class="range-slider-ui"></div>
                    <div class="d-flex pb-1">
                        <div class="w-50 pe-2 me-2">
                            <div class="input-group input-group-sm">
                                <input class="form-control range-slider-value-min" placeholder="Od" type="text" wire:model="start">
                                <span class="input-group-text">g</span>
                            </div>
                        </div>
                        <div class="w-50 ps-2">
                            <div class="input-group input-group-sm">
                                <input class="form-control range-slider-value-max" placeholder="Do" type="text" wire:model="end">
                                <span class="input-group-text">g</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</aside>
