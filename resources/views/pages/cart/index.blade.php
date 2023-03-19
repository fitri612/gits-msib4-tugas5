@extends('layouts.default')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input to Cart</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product">Product</label>
                                <select class="form-control" name="product_id" id="product_id">
                                    <option value="">Select Product</option>
                                    @if(isset($products))
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                {{-- Flask Message --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Transaction</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class=" text-primary">
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                   

                                    <tr>
                                        <td colspan="4" rowspan="4"></td>
                                        <td>Grand Total </td>
                                        <td>: </td>
                                    </tr>
                                    <form action="" method="post">
                                        @csrf
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="number" class="form-control" id="cash" name="cash"
                                                    placeholder="Cash" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Change </td>
                                            <td>: Rp. </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm col-12">Checkout / Paid</button>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('script')
$('#category_id').on('change', function() {
    var category_id = $(this).val();
    if (category_id) {
        $.ajax({
            url: '/products/' + category_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#product_id').empty();
                $('#product_id').append('<option value="">Select Product</option>');
                $.each(data, function(key, value) {
                    $('#product_id').append('<option value="' + key + '">' + value +
                        '</option>');
                });
            }
        });
    } else {
        $('#product_id').empty();
        $('#product_id').append('<option value="">Select Product</option>');
    }
});
@endpush