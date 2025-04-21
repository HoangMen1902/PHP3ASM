    <section class="w-full px-10">
        @include('partials.settings-heading')
        <x-settings.layout :heading="__('Your Order')" :subheading="__('List of purchased orders')">

            @if ($selectedOrder)
            <div class=" bg-white dark:bg-white/10 p-6 rounded-lg shadow" style="min-width: 800px;">
                <h2 class="text-lg font-semibold mb-4">Order Details #{{ $selectedOrder->ic }}</h2>
                <p>
                    <strong>Status:</strong>
                    <span class="inline-block px-2 py-1 rounded text-white text-sm 
                    @switch($selectedOrder->status)
                        @case('Cancelled') bg-red-500 @break
                        @case('Processing') bg-green-500 @break
                        @case('Completed') bg-green-600 @break
                        @case('Paid') bg-green-600 @break
                        @case('Shipping') bg-blue-500 @break
                        @case('Refund Pending') bg-yellow-500 text-black @break
                        @case('Refunded') bg-purple-500 @break
                        @default bg-gray-500
                    @endswitch
                    ">
                        {{ $this->getStatusText($selectedOrder->status) }}
                    </span>

                    @if ($selectedOrder->status == 1)
                    <button wire:click="confirmCancelOrder({{ $selectedOrder->id }})"
                        class="ml-4 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                        Order Cancellation Request
                    </button>
                    @elseif ($selectedOrder->status == 2)
                    <button wire:click="confirmRefundOrder({{ $selectedOrder->id }})"
                        class="ml-4 bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-1 rounded">
                        Request a refund
                    </button>
                    @endif
                </p>


                <p><strong>Address:</strong> {{ $selectedOrder->address }}</p>
                <p><strong>Total price:</strong> {{ number_format($selectedOrder->total_price) }}$</p>

                <h3 class="mt-4 font-semibold">Product:</h3>
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
                            <p>Quantity: {{ $item->quantity }}</p>
                            <p>Price: {{ number_format($item->price) }}$</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <button wire:click="hideOrderDetail" class="mt-4 text-blue-600 hover:underline">
                    ← Back to ordr list
                </button>
            </div>
            @else
            <div class="grid gap-4">
                @forelse ($orders as $order)
                <div class="p-4  bg-white dark:bg-white/10 rounded shadow border dark:border-gray-700" style="min-width: 800px;" >
                    <h3 class="font-semibold">Single code: #{{ $order->id }}</h3>
                    <p>
                        Status:
                        <span class="inline-block px-2 py-1 rounded text-white text-sm 
                        @switch($order->status) 
                            @case('Cancelled') bg-red-500 @break
                            @case('Processing') bg-green-500 @break
                            @case('Completed') bg-green-600 @break
                            @case('Paid') bg-green-600 @break
                            @case('Shipping') bg-blue-500 @break
                            @case('Refund Pending') bg-yellow-500 text-black @break
                            @case('Refunded') bg-purple-500 @break
                            @default bg-gray-500
                        @endswitch

                                ">
                            {{ $this->getStatusText($order->status) }}
                        </span>
                    </p>
                    <p>Total Price:{{ number_format($order->total_price) }}$</p>
                    <button wire:click="showOrderDetail({{ $order->id }})" class="text-blue-600 hover:underline mt-2">
                        See details
                    </button>
                </div>
                @empty
                <div style="justify-self: center;">
                    <p>No orders yet. <a href="/products">Shop now!</a></p>
                </div>

                @endforelse
            </div>
            @endif
            @if ($showConfirmModal)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-[90%] max-w-md shadow">
                    <h2 class="text-lg font-semibold mb-4">Confirm action</h2>
                    <p>
                        Are you sure you want to
                        <strong>
                            {{ $confirmAction === 'cancel' ? 'Cancelled' : 'Refund Pending' }}?
                        </strong>
                    </p>

                    <div class="mt-4 flex justify-end gap-2">
                        <button wire:click="cancelConfirmation"
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                        <button wire:click="executeConfirmedAction"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Yes
                        </button>
                    </div>
                </div>
            </div>
            @endif

        </x-settings.layout>
    </section>