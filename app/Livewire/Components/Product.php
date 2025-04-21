<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Product as ModelsProduct;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public $search = '';
    public $sortOrder = '';
    public $selectedCategories = [];
    public $data;
    public $categories;

    public function mount()
    {
        $this->applyFilters();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->sortOrder = '';
        $this->selectedCategories = [];
        $this->resetPage(); // reset pagination nếu có
        $this->applyFilters();
    }

    public function testClick()
    {
        logger('Test click hoạt động');
    }

    public function updating($property)
    {
        if ($property !== 'search') {
            $this->resetPage();
        }
    }

    public function updatedSortOrder()
    {
        // logger('Cập nhật sắp xếp:', [$this->sortOrder]);
        $this->applyFilters();
    }

    public function updatedSelectedCategories()
    {
        // logger('Cập nhật danh mục đã chọn:', [$this->selectedCategories]);
        $this->applyFilters();
    }

    // Người dùng nhấn nút "Tìm kiếm"
    public function searchProduct()
    {
        // logger('Thực hiện tìm kiếm sản phẩm');
        // logger('Từ khóa:', [$this->search]);
        $this->applyFilters();
    }

    public function applyFilters()
    {
        // logger('Áp dụng bộ lọc...');
        // logger('Từ khóa:', [$this->search]);
        // logger('Danh mục chọn:', [$this->selectedCategories]);
        logger('Sắp xếp:', [$this->sortOrder]);

        $query = ModelsProduct::select(
            'products.*',
            DB::raw('(SELECT MIN(price) FROM product_skus WHERE product_skus.product_id = products.id) AS min_price'),
            DB::raw('(SELECT MAX(price) FROM product_skus WHERE product_skus.product_id = products.id) AS max_price')
        );

        // Tìm theo tên nếu có nhập
        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Lọc theo danh mục
        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        // Sắp xếp
        switch ($this->sortOrder) {
            case 'low_to_high':
                $query->orderBy(DB::raw('(SELECT MIN(price) FROM product_skus WHERE product_skus.product_id = products.id)'), 'asc');
                break;
            case 'high_to_low':
                $query->orderBy(DB::raw('(SELECT MAX(price) FROM product_skus WHERE product_skus.product_id = products.id)'), 'desc');
                break;
            case 'name_a_z':
                $query->orderBy('name', 'asc');
                break;
            case 'name_z_a':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
        }

        $this->data = $query->get();

        $this->categories = Category::select(
            'categories.*',
            DB::raw('(SELECT COUNT(*) FROM products WHERE products.category_id = categories.id) AS count_products')
        )->get();
    }

    public function render()
    {
        return view('livewire.components.product', [
            'data' => $this->data,
            'categories' => $this->categories
        ]);
    }
}
