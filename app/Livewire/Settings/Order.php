<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order as OrderModel;

class Order extends Component
{
    public $orders;
    public $selectedOrder = null;
    public $showConfirmModal = false;
    public $confirmAction = null;
    public $targetOrderId = null;
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
            0 => 'Cancelled',
            1 => 'Processing',
            2 => 'Paid',
            3 => 'Refund Pending',
            4 => 'Refunded',
            5 =>  'Shipping',
            6 => 'Completed',
            default => 'Không xác định',
        };
    }


    public function confirmCancelOrder($orderId)
    {
        $this->showConfirmModal = true;
        $this->confirmAction = 'cancel';
        $this->targetOrderId = $orderId;
    }

    public function confirmRefundOrder($orderId)
    {
        $this->showConfirmModal = true;
        $this->confirmAction = 'refund';
        $this->targetOrderId = $orderId;
    }

    public function executeConfirmedAction()
    {
        if (!$this->targetOrderId || !$this->confirmAction) return;

        $order = $this->orders->firstWhere('id', $this->targetOrderId);
        if (!$order) return;

        if ($this->confirmAction === 'cancel' && $order->status == 1) {
            $order->status = 0;
        } elseif ($this->confirmAction === 'refund' && $order->status == 2) {
            $order->status = 3;
        }

        $order->save();
        $this->orders = $this->orders->fresh();
        $this->selectedOrder = $this->orders->firstWhere('id', $order->id);

        $this->reset(['showConfirmModal', 'confirmAction', 'targetOrderId']);
    }

    public function cancelConfirmation()
    {
        $this->reset(['showConfirmModal', 'confirmAction', 'targetOrderId']);
    }


    public function render()
    {
        return view('livewire.settings.order');
    }
}
