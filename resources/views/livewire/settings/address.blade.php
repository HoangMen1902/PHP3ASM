<section class="w-full">
    <x-settings.layout :heading="__('Địa chỉ của bạn')" :subheading="__('Cập nhật và quản lý địa chỉ của bạn')">
        <form wire:submit.prevent="saveAddress" class="my-6 w-full space-y-6">
            <flux:input wire:model="username_address" :label="__('Tên người nhận')" type="text" autofocus />

            <flux:input wire:model="phone" :label="__('Số điện thoại')" type="text" />

            <div>
                <label for="province" class="block text-sm font-medium text-gray-700">{{ __('Tỉnh/Thành phố') }}</label>
                <select wire:model="province_id" class="block w-full rounded-md border-gray-300 shadow-sm
           focus:ring-indigo-500 focus:border-indigo-500
           dark:bg-gray-800 dark:border-gray-600 dark:text-white" id="province">
                    <option value="">{{ __('Chọn tỉnh') }}</option>
                    @foreach ($provinces as $province)
                    <option value="{{ $province['ProvinceID'] }}">{{ $province['ProvinceName'] }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="district" class="block text-sm font-medium text-gray-700">{{ __('Quận/Huyện') }}</label>
                <select wire:model="district_id" class="block w-full rounded-md border-gray-300 shadow-sm
           focus:ring-indigo-500 focus:border-indigo-500
           dark:bg-gray-800 dark:border-gray-600 dark:text-white" id="district">
                    <option value="">{{ __('Chọn quận') }}</option>
                    @foreach ($districts as $district)
                    <option value="{{ $district['DistrictID'] }}">{{ $district['DistrictName'] }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="ward" class="block text-sm font-medium text-gray-700">{{ __('Phường/Xã') }}</label>
                <select wire:model="ward_id" class="block w-full rounded-md border-gray-300 shadow-sm
           focus:ring-indigo-500 focus:border-indigo-500
           dark:bg-gray-800 dark:border-gray-600 dark:text-white" id="ward">
                    <option value="">{{ __('Chọn phường') }}</option>
                    @foreach ($wards as $ward)
                    <option value="{{ $ward['WardCode'] }}">{{ $ward['WardName'] }}</option>
                    @endforeach
                </select>
            </div>

            <flux:input wire:model="address" :label="__('Địa chỉ cụ thể')" type="text" />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Lưu địa chỉ') }}</flux:button>
                </div>
            </div>
        </form>

        <div class="mt-8">
            <h3 class="text-lg font-medium">{{ __('Các địa chỉ đã lưu') }}</h3>
            <ul class="space-y-4 mt-4">
                @foreach ($addresses as $address)
                <li class="p-4 border border-gray-300 rounded-md">
                    <p><strong>{{ $address->username_address }}</strong></p>
                    <p>{{ $address->address }}</p>
                    <p>{{ $address->ward_name }}, {{ $address->district_name }}, {{ $address->province_name }}</p>
                    <p>{{ $address->phone }}</p>
                    <button type="button" wire:click="confirmDelete({{ $address->id }})" class="text-red-500 mt-2">{{ __('Xóa') }}</button>
                </li>
                @endforeach
            </ul>
        </div>
    </x-settings.layout>

    <div x-data="{ open: @entangle('deleteModalOpen') }" x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h3 class="text-lg font-medium">{{ __('Xác nhận xóa địa chỉ') }}</h3>
            <p>{{ __('Bạn có chắc chắn muốn xóa địa chỉ này?') }}</p>
            <div class="mt-4 flex justify-end gap-4">
                <button @click="open = false" class="text-gray-500">{{ __('Hủy') }}</button>
                <button @click="open = false; @this.deleteAddress()" class="text-red-500">{{ __('Xóa') }}</button>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('province').addEventListener('change', function() {
            Livewire.dispatch('updateProvince');
        });

        document.getElementById('district').addEventListener('change', function() {
            Livewire.dispatch('updateDistrict');
        });
    });
</script>