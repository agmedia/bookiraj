<!-- Toolbar for handheld devices (Marketplace)-->
<div class="handheld-toolbar">
    <div class="d-table table-layout-fixed w-100">
        @if (Request::is('knjige/*' ) || Request::is('knjige'))
            @if( ! isset($prod) && ! $prod)
                <a class="d-table-cell handheld-toolbar-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#shop-sidebar"><span class="handheld-toolbar-icon"><i class="ci-filter-alt"></i></span><span class="handheld-toolbar-label">Filtriraj</span></a>
            @endif
        @endif
        <a class="d-table-cell handheld-toolbar-item" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" onclick="window.scrollTo(0, 0)"><span class="handheld-toolbar-icon"><i class="ci-menu"></i></span><span class="handheld-toolbar-label">Menu</span></a>


            <cart-footer-icon carturl="{{ route('kosarica') }}"></cart-footer-icon>



    </div>
</div>
