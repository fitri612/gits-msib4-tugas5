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
                        <form action="{{ route('cart.addToCart') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="product">Product</label>
                                <select class="form-control" name="product_id" id="product_id">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="qty" required>
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
                                <thead class="table-info">
                                    <th scope="col">No</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Action</th>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp

                                    @foreach ($carts as $cart)
                                        <tr scope="row">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cart->product->name }}</td>
                                            <td>Rp{{ number_format($cart->product->price, 2, ',', '.') }}</td>
                                            <td>{{ $cart->qty }}</td>
                                            <td>Rp{{ number_format($cart->product->price * $cart->qty, 2, ',', '.') }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#editCartModal-{{ $cart->id }}">Edit</button>

                                                <form action="{{ route('cart.destroy', $cart->id) }}" method="post"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>

                                                </form>
                                            </td>

                                        </tr>
                                        @php
                                            $total += $cart->product->price * $cart->qty;
                                        @endphp
                                    @endforeach


                                    <tr class="table table-borderless">
                                        <td colspan="4" rowspan="4"></td>
                                        <td>Grand Total </td>
                                        <td>: Rp{{ number_format($total, 2, ',', '.') }}</td>
                                    </tr>
                                    <form action="{{ route('cart.checkout') }}" method="post">
                                        @csrf
                                        <tr class="table table-borderless">
                                            <td>
                                                <label for="cash">Cash(Rp)</label>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" id="cash" name="cash"
                                                    value="" placeholder="Cash" required>
                                            </td>
                                        </tr>
                                        <tr class="table table-borderless">
                                            <td></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm col-12" type="submit"
                                                    onclick="return confirm('Are you sure you want to checkout?')">Checkout
                                                    / Paid</button>
                                            </td>
                                        </tr>
                                        <input type="hidden" name="total" value="{{ $total }}">
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @foreach ($carts as $cart)
                    <!-- Edit Cart Modal -->
                    <div class="modal fade" id="editCartModal-{{ $cart->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editCartModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCartModalLabel">Edit Cart</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('cart.update', $cart->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="qty">Quantity</label>
                                            <input type="number" class="form-control" id="qty" name="qty"
                                                value="{{ $cart->qty }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Edit Cart Modal -->
                @endforeach
            </div>
        </div>
    </div>
@endsection
