<?php

namespace App\Http\Livewire\Front\Partials;

use App\Models\Front\Catalog\Author;
use App\Models\Front\Catalog\Category;
use App\Models\Front\Catalog\Product;
use App\Models\Front\Catalog\Publisher;
use Livewire\Component;

class AuthorFilter extends Component
{

    public $group = null;

    public $category = null;

    public $categories = null;

    public $authors;
    public $author = null;

    public $publishers;
    public $publisher;

    protected $queryString = ['category', 'publisher'];


    public function mount()
    {
        //
        if ($this->author) {
            $this->setPublishers($this->author->products()->pluck('id'));
            $this->categories = $this->author->categories();
        }
    }


    public function changeSelected($slug)
    {
        //dd($slug);
        return request()->query->set('author', $slug);
    }


    public function updatingSelectedAuthor($slug)
    {
        //$this->queryString = ['author' => $slug];
        return request()->fullUrlWithQuery(['author' => $slug]);
    }


    public function render()
    {
        return view('livewire.front.partials.author-filter');
    }


    private function setAuthors($ids)
    {
        $author_ids = Product::whereIn('id', $ids)->pluck('author_id')->unique();
        $this->authors = Author::whereIn('id', $author_ids)->get();
    }


    private function setPublishers($ids)
    {
        $publisher_ids = Product::whereIn('id', $ids)->pluck('publisher_id')->unique();
        $this->publishers = Publisher::whereIn('id', $publisher_ids)->get();
    }
}
