<section class="w-full px-10">
    @include('partials.settings-heading')
    <x-settings.layout :heading="__('Your address')" :subheading="__('Update and manage your address')">
        <form wire:submit.prevent="saveAddress" class="my-6 w-full space-y-6" style="justify-self: center;">
            <flux:input wire:model="username_address" :label="__('Recipient name')" type="text" style="min-width: 800px" autofocus />

            <flux:input wire:model="phone" :label="__('Phone')" type="text" style="min-width: 800px" />

            <div>
                <select
                    wire:model="province_id"
                    id="province"
                    class="block w-full rounded-md border border-gray-300 shadow-sm 
                    focus:ring-indigo-500 focus:border-indigo-500
                    bg-white dark:bg-white/10
                    text-sm px-3 py-2
                    text-black dark:text-white" style="min-width: 800px">
                    <option value="" class="text-white dark:text-white">
                        {{ __('Select province/city') }}
                    </option>
                    @foreach ($provinces as $province)
                    <option value="{{ $province['ProvinceID'] }}" class="text-black dark:text-black">
                        {{ $province['ProvinceName'] }}
                    </option>
                    @endforeach
                </select>

            </div>

            <div>

                <select
                    wire:model="district_id"
                    id="district"
                    class="block w-full rounded-md border border-gray-300 shadow-sm 
                    focus:ring-indigo-500 focus:border-indigo-500
                    bg-white dark:bg-white/10
                    text-sm px-3 py-2
                    text-black dark:text-white" style="min-width: 800px">

                    <option value="" class="text-white dark:text-white">{{ __('Select district') }}</option>
                    @foreach ($districts as $district)
                    <option value="{{ $district['DistrictID'] }}" class="text-black dark:text-black">{{ $district['DistrictName'] }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select wire:model="ward_id" class="block w-full rounded-md border border-gray-300 shadow-sm 
                focus:ring-indigo-500 focus:border-indigo-500
                bg-white dark:bg-white/10
                text-sm px-3 py-2
                text-black dark:text-white" id="ward" style="min-width: 800px">
                    <option value="" class="text-white dark:text-white">{{ __('Select ward') }}</option>
                    @foreach ($wards as $ward)
                    <option value="{{ $ward['WardCode'] }}" class="text-black dark:text-black">{{ $ward['WardName'] }}</option>
                    @endforeach
                </select>
            </div>

            <flux:input wire:model="address" :label="__('specific address')" type="text" style="min-width: 800px" />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>
            </div>
        </form>

        <div class="mt-8">
            <h3 class="text-lg font-medium">{{ __('Saved addresses') }}</h3>
            <ul class="space-y-4 mt-4">
                @foreach ($addresses as $address)
                <li class="p-4 border border-gray-300 rounded-md mb-6 " style="min-width: 800px">
                    <p><strong>Recipient name: {{ $address->username_address }}</strong></p>
                    <p>Specific address: {{ $address->address }}</p>
                    <p>Address: {{ $address->ward_name }}, {{ $address->district_name }}, {{ $address->province_name }}</p>
                    <p>Phone: {{ $address->phone }}</p>
                    <button type="button" wire:click="confirmDelete({{ $address->id }})" class="text-red-500 mt-2 ml-auto block">
                        {{ __('Delete') }}
                    </button>

                </li>
                @endforeach
            </ul>
        </div>
    </x-settings.layout>

    <div x-data="{ open: @entangle('deleteModalOpen') }" x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h3 class="text-lg font-medium text-black dark:text-black">{{ __('Confirm address deletion') }}</h3>
            <p class="text-black dark:text-black">{{ __('Are you sure you want to delete this address?') }}</p>
            <div class="mt-4 flex justify-end gap-4">
                <button @click="open = false" class="text-gray-500">{{ __('Cancel') }}</button>
                <button @click="open = false; @this.deleteAddress()" class="text-red-500">{{ __('Delete') }}</button>
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