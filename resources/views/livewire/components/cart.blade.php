<div>
    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Cart Products</h2>
                            <p>Home <span>-</span>Cart Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Cart Area =================-->
    <section class="cart_area padding_top">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $total = 0;
                            @endphp
                            @foreach ($data as $cart)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{asset('storage/' . $cart->productSku->images)}}" alt=""  style="max-width: 100px; object-fit: cover;"/>
                                            </div>
                                            <div class="media-body">
                                                <p>{{$cart->productSku->product->name}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{$cart->productSku->price}}$</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <span class="input-number-decrement"> <i class="ti-angle-down"></i></span>
                                            <input class="input-number" type="text" value="{{$cart->quantity}}" min="1" name="quantity">
                                            <span class="input-number-increment"> <i class="ti-angle-up"></i></span>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{$cart->productSku->price * $cart->quantity}}$</h5>
                                    </td>
                                </tr>
                                @php
                                $total += $cart->productSku->price * $cart->quantity;
                                @endphp
                            @endforeach

                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>{{$total}}$</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right mb-5">
                        <a class="btn_1" href="#">Continue Shopping</a>
                        <a class="btn_1 checkout_btn_1" href="/checkout">Proceed to checkout</a>
                    </div>
                </div>
            </div>
    </section>
    <!--================End Cart Area =================-->
</div>