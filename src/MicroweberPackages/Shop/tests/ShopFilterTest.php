<?php
namespace MicroweberPackages\Shop\tests;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use MicroweberPackages\Content\Content;
use MicroweberPackages\Core\tests\TestCase;
use MicroweberPackages\Page\Models\Page;
use MicroweberPackages\Product\Models\Product;
use MicroweberPackages\Shop\Http\Controllers\ShopController;

class ShopFilterTest extends TestCase
{
    public function testGetProducts()
    {
        $newPage = new Page();
        $newPage->title = uniqid();
        $newPage->is_shop = 1;
        $newPage->content_type = 'page';
        $newPage->subtype = 'dynamic';
        $newPage->save();

        $shopPage = Page::where('content_type', 'page')
            ->where('subtype','dynamic')
            ->where('is_shop', 1)
            ->first();

        $products = [];

        for($i = 0; $i < 5; $i++) {

            $newProduct = new Product();
            $newProduct->price = rand(11,999);
            $newProduct->title = uniqid();
            $newProduct->parent = $shopPage->id;
            $newProduct->save();

            $products[] = $newProduct;
        }

        $controller = App::make(ShopController::class);

        $request = new Request();
        $request->merge(['id'=>$shopPage->id]);

        $html = $controller->index($request);

        foreach ($products as $product) {

            $findProductTitle = (strpos($html, $product->title) !== false);
            $this->assertTrue($findProductTitle);

            $findProductPrice = (strpos($html, $product->price) !== false);
            $this->assertTrue($findProductPrice);

        }

        $findJs = (strpos($html, 'filter.js') !== false);
        $this->assertTrue($findJs);

        $findCss = (strpos($html, 'filter.css') !== false);
        $this->assertTrue($findCss);

    }
}