<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Latest Products</h2>
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

        </div>
        <div class="row">

            @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box">
                    <a href="{{ route('products.show', $product) }}">
                        <div class="img-box">
                            <img src="{{ asset($product->image) }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h6>{{ $product->title }}</h6>
                            <h6>
                                Price
                                <span>{{ $product->price }}</span>
                            </h6>
                            <!-- View Details Button -->
                           
                        </div>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary mt-3">View Details</a>
                        @auth
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1" min="1" class="border p-2 rounded-md" placeholder="Quantity">
                            <button type="submit" class="bg-yellow-500 text-black p-2 rounded-md hover:bg-yellow-400">Add to Cart</button>
                        </form>
                        @endauth
                        
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
