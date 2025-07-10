<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductStockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with(['product', 'supplier'])->latest()->paginate(10);
        return view('pages.stock.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('pages.stock.create', compact('products', 'suppliers'));
    }

   public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'supplier_id' => 'required|exists:suppliers,id',
        'stock_in' => 'required|integer|min:1',
        'description' => 'required|string',
    ]);

    DB::beginTransaction();

    try {
        $stock = new Stock;
        $stock->product_id = $request->product_id;
        $stock->supplier_id = $request->supplier_id;
        $stock->description = $request->description;

        $product = Product::findOrFail($request->product_id);

        if ($request->description == 'Add From Supplier') {
            $stock->stock_in = $request->stock_in;
            $product->stock += $request->stock_in; // tambahkan stok
        } else {
            $stock->stock_out = $request->stock_in;
            if ($product->stock < $request->stock_in) {
                return back()->withErrors(['stock_in' => 'Stok produk tidak mencukupi untuk pengurangan ini.']);
            }
            $product->stock -= $request->stock_in; // kurangi stok
        }

        $stock->save();
        $product->save();

        DB::commit();

        return redirect()->route('products-stocks.index')->with('success', 'Stock entry created and product stock updated successfully.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}


    public function edit(Stock $productStock)
    {
        $products = Product::all();
        $stocks = Supplier::all();
        return view('product_stocks.edit', compact('productStock', 'products', 'stocks'));
    }

    public function update(Request $request, Stock $productStock)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock_id' => 'nullable|exists:stocks,id',
            'stock_in' => 'nullable|integer',
            'stock_out' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        $productStock->update($data);
        return redirect()->route('product-stocks.index')->with('success', 'Stock entry updated successfully.');
    }

    public function destroy(Stock $productStock)
    {
        $productStock->delete();
        return redirect()->route('product-stocks.index')->with('success', 'Stock entry deleted successfully.');
    }
}
