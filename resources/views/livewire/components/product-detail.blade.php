<div>
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Shop Single</h2>
                            <p>Home <span>-</span> Shop Single</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->
    <!--================End Home Banner Area =================-->

    <!--================Single Product Area =================-->
    <div class="product_image_area section_padding">
        <div class="container">
            <div class="row s_product_inner justify-content-between">
                <div class="col-lg-7 col-xl-7">
                    <div class="product_slider_img">
                        <ul id="lightSlider">
                            <li data-thumb="{{ asset('storage/' . $data->thumbnail) }}">
                                <img src="{{ asset('storage/' . $data->thumbnail) }}" alt="Product Image" />
                            </li>
                            @foreach($data->productSkus as $sku)

                                <li data-thumb="{{ asset('storage/' . $sku->images) }}">
                                    <img src="{{ asset('storage/' . $sku->images) }}" alt="Product Image" />
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="col-lg-5 col-xl-4">
                    <div class="s_product_text">
                        <h3>Faded SkyBlu Denim Jeans</h3>
                        <h2 id='price'>{{$price}}$</h2>
                        <ul class="list">
                            <li>
                                <a class="active" href="#">
                                    <span>Category</span> : {{$data->category->name}}
                                </a>
                            </li>
                            <li>
                                <a href="#"> <span>Availability</span> :
                                    {{$data->productSkus->sum('quantity') ? 'In stock' : 'Out of stock'}}</a>
                            </li>
                        </ul>
                        {!!$data->short_description!!}

                        <div class="variants">
                            <h4>Choose Variant:</h4>
                            <div class="variant-options">
                                @foreach ($data->productSkus as $sku)
                                    @foreach ($sku->skuValues as $value)

                                        <input type="radio" id="value_{{$sku->id}}" wire:click='updatePrice({{$sku->id}})'
                                            name="variant" value="{{$sku->id}}">
                                        <label for="value_{{$sku->id}}">{{ $value->optionValue->value_name }}</label>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>


                        <div class="card_area d-flex justify-content-between align-items-center">
                            <div class="product_count">
                                <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                <input class="input-number" type="text" value="1" min="0" max="10">
                                <span class="number-increment"> <i class="ti-plus"></i></span>
                            </div>
                            <a href="#" class="btn_3">add to cart</a>
                            <a href="#" class="like_us"> <i class="ti-heart"></i> </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Specification</a>
                </li>



            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    {!! $data->description !!}
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Width</h5>
                                    </td>
                                    <td>
                                        <h5>128mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Height</h5>
                                    </td>
                                    <td>
                                        <h5>508mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Depth</h5>
                                    </td>
                                    <td>
                                        <h5>85mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Weight</h5>
                                    </td>
                                    <td>
                                        <h5>52gm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Quality checking</h5>
                                    </td>
                                    <td>
                                        <h5>yes</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Freshness Duration</h5>
                                    </td>
                                    <td>
                                        <h5>03days</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>When packeting</h5>
                                    </td>
                                    <td>
                                        <h5>Without touch of hand</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Each Box contains</h5>
                                    </td>
                                    <td>
                                        <h5>60pcs</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->

</div>
@script
<script>
    $(document).ready(function () {
        makeSlider();
    });

    function makeSlider() {
        if ($("#lightSlider").data('lightSlider')) {
            $("#lightSlider").lightSlider('destroy');
        }

        setTimeout(function () {
            $("#lightSlider").lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 4,
                slideMargin: 0,
                enableDrag: true,
                currentPagerPosition: 'left',
                auto: true,
                pause: 3000
            });
        }, 0.1);
    }

    Livewire.on('updatedPrice', () => {

        makeSlider();
    })

</script>
@endscript