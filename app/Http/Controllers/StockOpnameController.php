<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock_OpName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOpnameController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::when($request->input('name'), function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        })->paginate(10);
        return view('pages.stock.stock_opname.index', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // Insert new stock opname record before displaying the view if not exists today
        $today = now()->toDateString();
        $exists = DB::table('stock_opnames')
            ->where('product_id', $id)
            ->whereDate('created_at', $today)
            ->exists();

        if (!$exists) {
            DB::table('stock_opnames')->insert([
                'product_id' => $id,
                'system_stock' => $product->stock,
                'physical_stock' => 0,
                'difference' => 0,
                'note' => 'Initial opname auto-insert',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $opname = DB::table('stock_opnames')
            ->where('product_id', $id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('pages.stock.stock_opname.opname', compact('product', 'opname'));
    }

    public function update(Request $request, $id)
    {
        // validate the request...
        $request->validate([
            'physical_stock' => 'required',
            'note' => 'required',
        ]);

        // update the request...
        $opname = Stock_OpName::find($id);
        $opname->physical_stock = $request->physical_stock;
        $opname->difference = $opname->system_stock - $request->physical_stock;
        $opname->note = $request->note;
        $opname->save();

        // update the related product stock with the new physical stock
        $product = Product::findOrFail($opname->product_id);
        $product->stock = $request->physical_stock;
        $product->save();

        return redirect()->route('products-stocks-opname.index')->with('success', 'Stock updated successfully');
    }

    public function destroy($id)
    {
        // delete the request...
        $opname = Stock_OpName::find($id);
        $opname->delete();

        return redirect()->route('products-stocks-opname.index ')->with('success', 'Stock Opname deleted successfully');
    }
}
