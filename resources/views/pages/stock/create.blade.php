{{-- resources/views/product_stocks/create.blade.php --}}

@extends('layouts.app')

@section('title', 'Add/Return Stok Produk')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Add/Return Stok Produk</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ route('products-stocks.store') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h4>Form Add/Return Stok</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Produk</label>
                            <select name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Supplier</label>
                            <select name="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror">
                                <option value="">-- Pilih Supplier (Opsional) --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <select name="description" class="form-control @error('description') is-invalid @enderror">
                                <option value="">-- Pilih Deskripsi --</option>
                                <option value="Return From Supplier">Return From Supplier</option>
                                <option value="Add From Supplier">Add From Supplier</option>
                            </select>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stock_in" class="form-control @error('stock_in') is-invalid @enderror">
                            @error('stock_in')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
