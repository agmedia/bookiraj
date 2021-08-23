<?php

namespace App\Http\Livewire\Front;

use App\Models\Front\Catalog\Author;
use App\Models\Front\Catalog\Product;
use App\Models\Front\Catalog\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class ProductCategoryList
 * @package App\Http\Livewire\Front
 */
class ProductCategoryList extends Component
{
    use WithPagination;

    /**
     * @var null
     */
    public $ids = null;

    /**
     * @var null
     */
    public $group = null;

    /**
     * @var null
     */
    public $cat = null;

    /**
     * @var null
     */
    public $subcat = null;

    /**
     * @var
     */
    protected $authors;

    /**
     * @var
     */
    protected $publishers;

    /**
     * @var
     */
    protected $start;

    /**
     * @var
     */
    protected $end;

    /**
     * @var string[]
     */
    protected $listeners = ['idChanged'];


    /**
     * @param $data
     */
    public function idChanged($data)
    {
        $this->ids = collect($data['ids']);
        $this->authors = $data['author'];
        $this->publishers = $data['publisher'];
        $this->start = $data['start'];
        $this->end = $data['end'];

        $this->render();
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        if (\request()->has('autor')) {
            $aut = \request()->input('autor');

            if (strpos($aut, ',') !== false) {
                $arr = explode(',', $aut);

                foreach ($arr as $item) {
                    $_author = Author::where('slug', $item)->first();
                    $this->authors[] = $_author;
                }
            } else {
                $_author = Author::where('slug', $aut)->first();
                $this->authors[] = $_author;
            }
        }

        if (\request()->has('nakladnik')) {
            $nak = \request()->input('nakladnik');

            if (strpos($nak, ',') !== false) {
                $arr = explode(',', $nak);

                foreach ($arr as $item) {
                    $_publisher = Publisher::where('slug', $item)->first();
                    $this->publishers[] = $_publisher;
                }
            } else {
                $_publisher = Publisher::where('slug', $nak)->first();
                $this->publishers[] = $_publisher;
            }
        }

        if ( ! $this->start && \request()->has('start')) {
            $this->start = \request()->input('start');
        }

        if ( ! $this->end && \request()->has('end')) {
            $this->end = \request()->input('end');
        }

        $request_data = [];

        if ($this->authors) {
            $request_data['autor'] = $this->authors;
        }

        if ($this->publishers) {
            $request_data['nakladnik'] = $this->publishers;
        }

        if ($this->start && strlen($this->start) == 4) {
            $request_data['start'] = $this->start;
        }

        if ($this->end && strlen($this->end) == 4) {
            $request_data['end'] = $this->end;
        }

        $request = new Request($request_data);

        $products = (new Product())->filter($request, $this->ids)->paginate(config('settings.pagination.front'));

        return view('livewire.front.product-category-list', [
            'products' => $products
        ]);
    }


    /**
     * @return string
     */
    public function paginationView()
    {
        return 'vendor.pagination.bootstrap-livewire';
    }

}