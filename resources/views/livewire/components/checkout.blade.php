@push('styles')
    <style>
        input:read-only:not(:placeholder-shown)+.placeholder {
            display: none;
        }
    </style>
@endpush
<div>

    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Producta Checkout</h2>
                            <p>Home <span>-</span> Shop Single</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->


    <!--================Checkout Area =================-->
    <section class="checkout_area padding_top">
        <div class="container">
            <div class="cupon_area" style="display: flex; flex-direction: column;">
                <label for="checkout_address">Checkout Information</label>
                @if ($user->checkoutAddresses->count() < 1)

                    <a href="" style="color: #0000EE">You don't have any delivery address, click here to add!</a>
                @else
                        <select name="checkout_address" id="checkout_address" form="checkout">
                            <option>Choose Delivery Information</option>
                            @foreach ($user->checkoutAddresses as $user_address)
                                <option value="{{$user_address->id}}">{{ $user_address->address }}</option>
                            @endforeach
                        </select>
                        <a href="" style="color: #0000EE">Wrong address? Modify it here.</a>
                @endif
            </div>
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="/checkout" method="post" novalidate="novalidate"
                            name="checkout" id="checkout">
                            @csrf

                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="username" name="username" readonly
                                    wire:model="address_username" placeholder="Address Username" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="phone" name="phone" readonly
                                    wire:model="phone" placeholder="Phone Number" />
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" id="province_name" name="province_name"
                                    placeholder="Province Name" readonly wire:model="province_name" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="district_name" name="district_name" readonly
                                    wire:model="district_name" placeholder="District Name" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="ward_name" name="ward_name" readonly
                                    wire:model="ward_name" placeholder="Ward Name" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="Address" name="Address" readonly
                                    wire:model="address" placeholder="Address" />
                            </div>


                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li>
                                    <a href="#">Product
                                        <span>Total</span>
                                    </a>
                                </li>
                                @php
                                    $price = 0;
                                @endphp
                                @foreach ($data as $cart)
                                                                @php
                                                                    $price += $cart->quantity * $cart->productSku->price
                                                                @endphp
                                                                <li>
                                                                    <a href="#"
                                                                        style="display: flex; gap: 8px; align-items: center; justify-content: space-between;">
                                                                        <span
                                                                            style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px; display: inline-block;">
                                                                            {{ $cart->productSku->product->name }}
                                                                        </span>
                                                                        <span class="middle">x{{ $cart->quantity }}</span>
                                                                        <span class="last">${{ $cart->productSku->price }}</span>
                                                                    </a>
                                                                </li>
                                @endforeach
                                <ul class="list list_2">
                                    <li>
                                        <a href="#">Subtotal
                                            <span>${{$price}}</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">Total
                                            <span>${{$price}}</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="payment_item">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option5" name="payment-method" form="checkout" value="cash"/>
                                        <label for="f-option5">Cash</label>
                                        <div class="check"></div>
                                    </div>
                                    <p>
                                        Cash on delivery
                                    </p>
                                </div>
                                <div class="payment_item active">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option6" name="payment-method" form="checkout" value="international"/>
                                        <label for="f-option6">International Payment</label>
                                        <img src="img/product/single-product/card.jpg" alt="" />
                                        <div class="check"></div>
                                    </div>
                                    <p>
                                        Visa - Mastercard Supported
                                    </p>
                                </div>

                                <button class="btn_3" href="#" style="margin-top:1rem; width: 100%;"
                                    form="checkout">Proceed to payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->

</div>
@script
<script>
    $(() => {

        $('#checkout_address').on('change', function () {
            let selectedValue = $(this).val();
            $wire.dispatch('changedAddress', { id: selectedValue });
        });
        Livewire.on('contentUpdated', () => {
            setTimeout(() => {
            $('select').niceSelect(); 
            }, 1);
        });
    });
</script>

@endscript