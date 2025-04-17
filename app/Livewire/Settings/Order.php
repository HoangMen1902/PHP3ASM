<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order as OrderModel;

class Order extends Component
{
    public $orders;
    public $selectedOrder = null;

    public function mount()
    {
        $this->orders = OrderModel::with('orderDetails.sku.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    }

    public function showOrderDetail($orderId)
    {
        $this->selectedOrder = $this->orders->firstWhere('id', $orderId);
    }

    public function hideOrderDetail()
    {
        $this->selectedOrder = null;
    }
    // 0 hủy , 1 chờ xử lý, 2 đã thanh toán, 3 chờ hoàn tiền , 4 đã hoàn tiền, 5 đang vận chuyển 6 thành công
    public function getStatusText($status)
    {
        return match ((int) $status) {
            0 => 'Huỷ',
            1 => 'Đang xử lý',
            2 => 'Đã thanh toán',
            3 => 'Chờ hoàn tiền',
            4 => 'Đã hoàn tiền',
            5 => 'Đang vận chuyển',
            6 => 'Thành công',
            default => 'Không xác định',
        };
    }


    public function render()
    {
        return view('livewire.settings.order');
    }
}
