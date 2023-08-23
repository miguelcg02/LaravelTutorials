<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Products - Online Store';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {

        $product = Product::findOrFail($id);

        if ($product['price'] > 100) {
            $viewData['color'] = 'red';
        }

        $viewData['title'] = $product['name'].' - Online Store';
        $viewData['subtitle'] = $product['name'].' - Product information';
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = []; 
        $viewData['title'] = 'Create product';

        return view('product.create')->with('viewData', $viewData);

    }

    public function save(Request $request): RedirectResponse
    {
        Product::validateCreateform($request);
        Product::create($request->only(['name', 'price']));

        return back();
    }
}
