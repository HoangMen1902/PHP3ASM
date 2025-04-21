
    <div>

        <!--================Home Banner Area =================-->
        <!-- breadcrumb start-->
        <section class="breadcrumb breadcrumb_bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="breadcrumb_iner">
                            <div class="breadcrumb_iner_item">
                                <h2>Shop Category</h2>
                                <p>Home <span>-</span> Shop Category</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb start-->

        <!--================Category Product Area =================-->
        <section class="cat_product_area section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="left_sidebar_area">
                            <!-- Category Filter -->
                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Sort Options</h3>
                                </div>
                                <div class="widgets_inner">
                                    <div>
                                        <label>
                                            <input type="radio" wire:model="sortOrder" value="" />
                                            Default
                                        </label>
                                    </div>

                                    <div>
                                        <label>
                                            <input type="radio" wire:model.live="sortOrder" value="newest" />
                                            Newest
                                        </label>
                                    </div>

                                    <div>
                                        <label>
                                            <input type="radio" wire:model.live="sortOrder" value="low_to_high" />
                                            Price: Low to High
                                        </label>
                                    </div>

                                    <div>
                                        <label>
                                            <input type="radio" wire:model.live="sortOrder" value="high_to_low" />
                                            Price: High to Low
                                        </label>
                                    </div>

                                    <div>
                                        <label>
                                            <input type="radio" wire:model.live="sortOrder" value="name_a_z" />
                                            Name: A - Z
                                        </label>
                                    </div>

                                    <div>
                                        <label>
                                            <input type="radio" wire:model.live="sortOrder" value="name_z_a" />
                                            Name: Z - A
                                        </label>
                                    </div>
                                </div>
                            </aside>
                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Browse Categories</h3>
                                </div>
                                <div class="widgets_inner">
                                    <ul class="list">
                                        @foreach ($categories as $category)
                                        <li>
                                            <label class="d-flex align-items-center" style="cursor:pointer;">
                                                <input type="checkbox" wire:model.live="selectedCategories" value="{{ $category->id }}" class="mr-2">
                                                <span>{{ $category->name }} ({{ $category->count_products }})</span>
                                            </label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product_top_bar d-flex justify-content-between align-items-center">
                                    <div class="single_product_menu">
                                        <p><span>{{$data->count()}}</span> Products Found</p>
                                    </div>

                                    <button wire:click="resetFilters" class="btn btn-sm" style="padding: 22px 15px; font-size: 14px; border-radius: 5px;">
                                        Clear all filters
                                    </button>
                                    <div class="single_product_menu d-flex justify-content-center mb-4">
                                        <form wire:submit.prevent="searchProduct" class="d-flex input-group w-100">
                                            <input type="text" wire:model.defer="search" class="form-control" placeholder="Enter product name..." style="height: 45px; border-radius: 5px;">
                                            <button type="submit" class="btn btn-sm" style="padding: 5px 15px; font-size: 14px; border-radius: 5px;">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($search || $selectedCategories || $sortOrder)
                        <div class="mb-3">
                            <strong>Filter:</strong>
                            @if($search)
                            <span class="badge bg-secondary text-white" style="padding: 10px 15px;">Search: {{ $search }}</span>
                            @endif
                            @foreach($selectedCategories as $catId)
                            @php $cat = $categories->firstWhere('id', $catId); @endphp
                            @if($cat)
                            <span class="badge bg-primary text-white" style="padding: 10px 15px;">{{ $cat->name }}</span>
                            @endif
                            @endforeach
                            @if($sortOrder)
                            <span class="badge bg-success text-white" style="padding: 10px 15px;">Sort: {{ ucfirst(str_replace('_', ' ', $sortOrder)) }}</span>
                            @endif
                        </div>
                        @endif



                        <div class="row align-items-center latest_product_inner">

                            @forelse($data as $product)
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="single_product_item">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                        alt="{{ $product->name }}"
                                        class="w-100"
                                        style="object-fit:cover; height: 250px; cursor:pointer;"
                                        onclick="window.location.href = '/products/{{ $product->id }}'">

                                    <div class="single_product_text">
                                        <h4 class="cursor-pointer" onclick="window.location.href = '/products/{{ $product->id }}'">
                                            {{ $product->name }}
                                        </h4>
                                        <h3>
                                            {{ $product->min_price == $product->max_price 
                                                ? number_format($product->min_price, 0, ',', '.') . '$' 
                                                : number_format($product->min_price, 0, ',', '.') . '$ - ' . number_format($product->max_price, 0, ',', '.') . '$' }}
                                        </h3>
                                        <a href="#" class="add_cart">+ add to cart <i class="ti-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <p class="text-center text-muted">Không có sản phẩm phù hợp.</p>
                            </div>
                            @endforelse


                            <div class="col-lg-12">
                                <div class="pageination">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <i class="ti-angle-double-left"></i>
                                                </a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <i class="ti-angle-double-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>