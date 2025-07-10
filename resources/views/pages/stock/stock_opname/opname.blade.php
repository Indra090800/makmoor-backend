@extends('layouts.app')

@section('title', 'Products Stock Opname')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product Stock Opname</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Products</a></div>
                    <div class="breadcrumb-item">Stock Opname</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">@include('layouts.alert')</div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Detail Product</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $product->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Current System Stock</th>
                                    <td>{{ $product->stock ?? '0' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>System Stock</th>
                                            <th>Physical Stock</th>
                                            <th>Difference</th>
                                            <th>Note</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($opname as $data)
                                            <tr>
                                                <td>{{ $data->system_stock }}</td>
                                                <td>{{ $data->physical_stock }}</td>
                                                <td>{{ $data->difference }}</td>
                                                <td>{{ $data->note }}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>{{ $data->updated_at }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary btn-icon" data-toggle="modal"
                                                        data-target="#editModal{{ $data->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form action="{{ route('products-stocks-opname.destroy', $data->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                            <i class="fas fa-times"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">{{ $opname->withQueryString()->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel{{ $data->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $data->id }}">Edit Stock Opname</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('products-stocks-opname.update', $data->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Physical Stock</label>
                            <input type="number" name="physical_stock" class="form-control"
                                value="{{ $data->physical_stock }}" required>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <input type="text" name="note" class="form-control" value="{{ $data->note }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
