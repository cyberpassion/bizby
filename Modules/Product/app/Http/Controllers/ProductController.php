<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Modules\Product\Services\ProductService;
use Modules\Product\Models\Product;
use Modules\Product\Formatters\ProductFormatter;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Services\ProductResourceService;

class ProductController extends Controller
{
    protected $service;
	protected $moduleName = 'product';

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

	/**
     * Display a dashboard
     */
    public function index()
    {
        return view("{$this->moduleName}::index");
    }

    /**
     * Display a listing of the resource.
     */
    public function list()
    {
		$products = $this->service->list();
		//dd($products->toArray());
        return Inertia::render("{$this->moduleName}/list", [
            'products' => $products
        ]);
        return view("{$this->moduleName}::list");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		//return Inertia::render("{$this->moduleName}/create");
        return view("{$this->moduleName}::create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
	{
    	try {
	        $validated = $request->validate( ProductResourceService::get("{$this->moduleName}/create") );

	        // Debug: show what is coming from form
    	    // dd('VALIDATED DATA:', $validated);

	        $product = Product::create($validated);

	        dd('INSERTED:', $product);

	    } catch (\Exception $e) {

    	    dd('ERROR:', $e->getMessage());
    	}
	}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
		$product = Product::findOrFail($id);
		$formatted = ProductFormatter::format($product);
		//print_r($product->toArray());
		dd($formatted);die();
        return Inertia::render("{$this->moduleName}/show", [
            $this->moduleName => $product
        ]);
        return view("{$this->moduleName}::show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
		$product = Product::findOrFail($id);
        return Inertia::render("{$this->moduleName}/create", [
            $this->moduleName => $product
        ]);
        return view("{$this->moduleName}::edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
		// Validate incoming data
        $validated = $request->validate( ProductResourceService::get("{$this->moduleName}/update") );

        // Find and update product
        $product = Product::findOrFail($id);
        $product->update($validated);

        // Redirect with success message
        return redirect()
            ->route("{$this->moduleName}.index")
            ->with('success', 'Product updated successfully.');
	}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
		$product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', 'Product deleted successfully.');
	}

	/**
     * Display a report of the resource.
     */
    public function report()
    {
		return Inertia::render("{$this->moduleName}/report");
        return view("{$this->moduleName}::report");
    }

	/**
     * Display a settings of the resource.
     */
    public function settings()
    {
		return Inertia::render("{$this->moduleName}/settings");
        return view("{$this->moduleName}::settings");
    }

}
