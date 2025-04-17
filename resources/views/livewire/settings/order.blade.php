<section class="w-full">
    <x-settings.layout :heading="__('Đơn hàng của bạn')" :subheading="__('Danh sách đơn hàng đã mua')">

        @if ($selectedOrder)
        <!-- Chi tiết đơn hàng -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Chi tiết đơn hàng #{{ $selectedOrder->id }}</h2>

            <p>
                <strong>Trạng thái:</strong>
                <span class="inline-block px-2 py-1 rounded text-white text-sm 
                        @switch($selectedOrder->status)
                             @case('Hủy') bg-red-500 @break
                             @case('Đang xử lý') bg-green-500 @break
                            @case('Thành công') bg-green-600 @break
                            @case('Đã thanh toán') bg-green-600 @break
                            @case('Đang vận chuyển') bg-blue-500 @break
                            @case('Chờ hoàn tiền') bg-yellow-500 text-black @break
                            @case('Đã hoàn tiền') bg-purple-500 @break
                            @default bg-gray-500
                        @endswitch
                    ">
                    {{ $this->getStatusText($selectedOrder->status) }}
                </span>
            </p>

            <p><strong>Địa chỉ:</strong> {{ $selectedOrder->address }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($selectedOrder->total_price) }}đ</p>

            <h3 class="mt-4 font-semibold">Sản phẩm:</h3>
            <ul class="mt-2 space-y-4">
                @foreach ($selectedOrder->orderDetails as $item)
                <li class="border p-4 rounded-md dark:border-gray-600 flex items-start gap-4">
                    <img src="{{ asset('storage/' . $item->sku->images) }}"
                        alt="Ảnh SKU"
                        class="w-16 h-16 object-cover rounded-md"
                        style="max-width: 50%;">

                    <div>
                        <p class="font-semibold">{{ $item->sku->product->name }}</p>
                        <p>SKU: {{ $item->sku->sku }}</p>
                        <p>Số lượng: {{ $item->quantity }}</p>
                        <p>Giá: {{ number_format($item->price) }}đ</p>
                    </div>
                </li>
                @endforeach
            </ul>

            <div class="mt-4">
                @if ($selectedOrder->status === 'Đang xử lý')
                <button wire:click="cancelOrder({{ $selectedOrder->id }})" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700">
                    Hủy đơn hàng
                </button>
                @elseif ($selectedOrder->status === 'Đã thanh toán')
                <button wire:click="refundOrder({{ $selectedOrder->id }})" class="bg-yellow-600 text-white py-2 px-4 rounded hover:bg-yellow-700">
                    Hoàn tiền
                </button>
                @endif
            </div>

            <button wire:click="hideOrderDetail" class="mt-4 text-blue-600 hover:underline">
                ← Quay lại danh sách
            </button>
        </div>
        @else
        <div class="grid gap-4">
            @forelse ($orders as $order)
            <div class="p-4 bg-white dark:bg-gray-800 rounded shadow border dark:border-gray-700">
                <h3 class="font-semibold">Mã đơn: #{{ $order->id }}</h3>
                <p>
                    Trạng thái:
                    <span class="inline-block px-2 py-1 rounded text-white text-sm 
                                @switch($order->status)
                                 @case('Hủy') bg-red-500 @break
                             @case('Đang xử lý') bg-green-500 @break

                            @case('Thành công') bg-green-600 @break
                            @case('Đã thanh toán') bg-green-600 @break
                            @case('Đang vận chuyển') bg-blue-500 @break
                            @case('Chờ hoàn tiền') bg-yellow-500 text-black @break
                            @case('Đã hoàn tiền') bg-purple-500 @break
                            @default bg-gray-500
                                @endswitch
                            ">
                        {{ $this->getStatusText($order->status) }}
                    </span>
                </p>
                <p>Tổng tiền: {{ number_format($order->total_price) }}đ</p>
                <button wire:click="showOrderDetail({{ $order->id }})" class="text-blue-600 hover:underline mt-2">
                    Xem chi tiết
                </button>
            </div>
            @empty
            <p>Chưa có đơn hàng nào.</p>
            @endforelse
        </div>
        @endif

    </x-settings.layout>
</section>