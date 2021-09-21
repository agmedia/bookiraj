<?php

namespace App\Http\Controllers\Back\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Back\Catalog\Author;
use App\Models\Back\Catalog\Category;
use App\Models\Back\Catalog\Product\Product;
use App\Models\Back\Catalog\Publisher;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        Log::info('Start time... $request...');
        Log::info($request);
        $time_start = microtime(true);

        $query = $product->filter($request);

        $time_end = microtime(true);
        Log::info(($time_end - $time_start)/60);
        $time_start = microtime(true);

        $products = $query->paginate(20);

        $time_end = microtime(true);
        Log::info(($time_end - $time_start)/60);
        $time_start = microtime(true);

        if ($request->status) {
            if ($request->input('status') == 'with_action' || $request->input('status') == 'without_action') {
                $products = collect();
                $temps = Product::all();

                if ($request->input('status') == 'with_action') {
                    foreach ($temps as $product) {
                        if ($product->special()) {
                            $products->push($product);
                        }
                    }
                }

                if ($request->input('status') == 'without_action') {
                    foreach ($temps as $product) {
                        if ( ! $product->special()) {
                            $products->push($product);
                        }
                    }
                }

                $products = $this->paginateColl($products);
            }
        }

        $time_end = microtime(true);
        Log::info(($time_end - $time_start)/60);
        $time_start = microtime(true);

        $categories = (new Category())->getList(false);
        $authors    = Author::all()->pluck('title', 'id');
        $publishers = Publisher::all()->pluck('title', 'id');
        $counts = Product::setCounts($query);

        $time_end = microtime(true);
        Log::info(($time_end - $time_start)/60);

        return view('back.catalog.product.index', compact('products', 'categories', 'authors', 'publishers', 'counts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();

        $data = $product->getRelationsData();

        return view('back.catalog.product.edit', compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $stored = $product->validateRequest($request)->create();

        if ($stored) {
            $product->checkSettings()
                    ->storeImages($stored);

            return redirect()->route('products.edit', ['product' => $stored])->with(['success' => 'Artikl je uspješno snimljen!']);
        }

        return redirect()->back()->with(['error' => 'Ops..! Greška prilikom snimanja.']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = $product->getRelationsData();

        return view('back.catalog.product.edit', compact('product', 'data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product                  $product
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $updated = $product->validateRequest($request)->edit();

        if ($updated) {
            $product->checkSettings()
                    ->storeImages($updated);

            return redirect()->route('products.edit', ['product' => $updated])->with(['success' => 'Artikl je uspješno snimljen!']);
        }

        return redirect()->back()->with(['error' => 'Ops..! Greška prilikom snimanja.']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $destroyed = Product::destroy($product->id);

        if ($destroyed) {
            return redirect()->route('products')->with(['success' => 'Artikl je uspješno snimljen!']);
        }

        return redirect()->back()->with(['error' => 'Ops..! Greška prilikom snimanja.']);
    }


    /**
     * @param       $items
     * @param int   $perPage
     * @param null  $page
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginateColl($items, $perPage = 20, $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
