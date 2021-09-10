<?php

namespace App\Http\Controllers\Back;

use App\Helpers\Chart;
use App\Helpers\Import;
use App\Helpers\ProductHelper;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Mail\OrderReceived;
use App\Mail\OrderSent;
use App\Models\Back\Catalog\Mjerilo;
use App\Models\Back\Catalog\Product\Product;
use App\Models\Back\Catalog\Product\ProductCategory;
use App\Models\Back\Catalog\Product\ProductImage;
use App\Models\Back\Orders\Order;
use App\Models\Back\Orders\OrderProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Bouncer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['today']      = Order::whereDate('created_at', Carbon::today())->count();
        $data['proccess']   = Order::whereIn('order_status_id', [1, 2, 3])->count();
        $data['finished']   = Order::whereIn('order_status_id', [4, 5, 6, 7])->count();
        $data['this_month'] = Order::whereMonth('created_at', '=', Carbon::now()->month)->count();

        $orders   = Order::last()->get();
        $products = OrderProduct::last()->get();

        $chart     = new Chart();
        $this_year = json_encode($chart->setDataByYear(
            Order::chartData($chart->setQueryParams())
        ));
        $last_year = json_encode($chart->setDataByYear(
            Order::chartData($chart->setQueryParams(true))
        ));

        return view('back.dashboard', compact('data', 'orders', 'products', 'this_year', 'last_year'));
    }


    /**
     * Import initialy from excel files.
     *
     * @param Request $request
     */
    public function import(Request $request)
    {
        $spread = IOFactory::load(public_path('assets/artikli.csv'));
        $sheet  = $spread->getActiveSheet();
        $list   = array(1, $sheet->toArray(null, true, true, true))[1];

        $import = new Import();
        $count  = 0;

        $unknown_author_id    = 6;
        $unknown_publisher_id = 2;

        for ($n = 0; $n < 9; $n++) {
            for ($i = 2; $i < count($list); $i++) {
                $attributes = $import->setAttributes($list[$i]);
                $author     = $import->resolveAuthor($attributes['author']);
                $publisher  = $import->resolvePublisher($attributes['publisher']);

                $name = $list[$i]['D'];
                $action = ($list[$i]['Z'] == $list[$i]['Y']) ? null : $list[$i]['Y'];

                $product_id = Product::insertGetId([
                    'author_id'        => $author ?: $unknown_author_id,
                    'publisher_id'     => $publisher ?: $unknown_publisher_id,
                    'action_id'        => 0,
                    'name'             => $name,
                    'sku'              => $list[$i]['C'] ?: '0',
                    'description'      => '<p>' . str_replace('\n', '<br>', $list[$i]['H']) . '</p>',
                    'slug'             => Str::slug($name),
                    'price'            => $list[$i]['Z'],
                    'quantity'         => $list[$i]['O'],
                    'tax_id'           => 1,
                    'special'          => $action,
                    'special_from'     => null,
                    'special_to'       => null,
                    'meta_title'       => $name,
                    'meta_description' => $name,
                    'pages'            => $attributes['pages'],
                    'dimensions'       => $attributes['dimensions'],
                    'origin'           => $attributes['origin'],
                    'letter'           => $attributes['letter'],
                    'condition'        => $attributes['condition'],
                    'binding'          => $attributes['binding'],
                    'year'             => $attributes['year'],
                    'viewed'           => 0,
                    'sort_order'       => 0,
                    'push'             => 0,
                    'status'           => $list[$i]['O'] ? 1 : 0,
                    'created_at'       => Carbon::now(),
                    'updated_at'       => Carbon::now()
                ]);

                if ($product_id) {
                    $images   = $import->resolveImages(explode(', ', $list[$i]['AD']), $name, $product_id);
                    $categories = $import->resolveCategories(explode(', ', $list[$i]['AA']));

                    if ($images) {
                        for ($k = 0; $k < count($images); $k++) {
                            if ($k == 0) {
                                Product::where('id', $product_id)->update([
                                    'image' => $images[$k]
                                ]);
                            } else {
                                ProductImage::insert([
                                    'product_id' => $product_id,
                                    'image'      => $images[$k],
                                    'alt'        => $name,
                                    'published'  => 1,
                                    'sort_order' => $k,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now()
                                ]);
                            }
                        }
                    }

                    if ($categories) {
                        foreach ($categories as $category) {
                            ProductCategory::insert([
                                'product_id'  => $product_id,
                                'category_id' => $category
                            ]);
                        }
                    }

                    $product = Product::find($product_id);

                    $product->update([
                        'url' => ProductHelper::url($product),
                        'category_string' => ProductHelper::categoryString($product)
                    ]);

                    $count++;
                }
            }
        }

        return redirect()->route('dashboard')->with(['success' => 'Import je uspješno obavljen..! ' . $count . ' proizvoda importano.']);
    }


    /**
     * Set up roles. Should be done once only.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setRoles()
    {
        if ( ! auth()->user()->can('*')) {
            abort(401);
        }

        $superadmin = Bouncer::role()->firstOrCreate([
            'name'  => 'superadmin',
            'title' => 'Super Administrator',
        ]);

        Bouncer::role()->firstOrCreate([
            'name'  => 'admin',
            'title' => 'Administrator',
        ]);

        Bouncer::role()->firstOrCreate([
            'name'  => 'editor',
            'title' => 'Editor',
        ]);

        Bouncer::role()->firstOrCreate([
            'name'  => 'customer',
            'title' => 'Customer',
        ]);

        Bouncer::allow($superadmin)->everything();

        Bouncer::ability()->firstOrCreate([
            'name'  => 'set-super',
            'title' => 'Postavi korisnika kao Superadmina.'
        ]);

        $users = User::whereIn('email', ['filip@agmedia.hr', 'tomislav@agmedia.hr'])->get();

        foreach ($users as $user) {
            $user->assign($superadmin);
        }

        return redirect()->route('dashboard');
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mailing(Request $request)
    {
        $order = Order::limit(1)->first();

        dispatch(function () use ($order) {
            Mail::to(config('mail.admin'))->send(new OrderReceived($order));
            Mail::to($order->payment_email)->send(new OrderSent($order));
        });

        return redirect()->route('dashboard');
    }
}
