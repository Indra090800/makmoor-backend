<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    //index
    public function index(Request $request)
    {
        $suppliers = Supplier::when($request->input('name'), function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        })->paginate(10);
        return view('pages.suppliers.index', compact('suppliers'));
    }

    //create
    public function create()
    {
        return view('pages.suppliers.create');
    }

    //store
    public function store(Request $request)
    {
        //validate the request...
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        //store the request...
        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->save();


        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully');
    }

    //show
    public function show($id)
    {
        return view('pages.suppliers.show');
    }

    //edit
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('pages.suppliers.edit', compact('supplier'));
    }

    //update
    public function update(Request $request, $id)
    {
        //validate the request...
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //update the request...
        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
    }

    //destroy
    public function destroy($id)
    {
        //delete the request...
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
    }
}
