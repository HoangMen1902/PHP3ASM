<?php

namespace App\Livewire\Settings;

use App\Models\CheckoutAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Services\GhnService;
use Livewire\Attributes\On;

class Address extends Component
{
    public $username_address;
    public $phone;
    public $address;
    public $province_id;
    public $district_id;
    public $ward_id;
    public $provinces = [];
    public $districts = [];
    public $wards = [];
    public $addresses;

    public $addressIdToDelete;


    public function mount(GhnService $ghn)
    {
        $this->provinces = $ghn->getProvinces()['data'] ?? [];
        $this->addresses = CheckoutAddress::where('user_id', Auth::id())->get();
    }

    public function saveAddress(GhnService $ghn)
    {
        $this->validate([
            'username_address' => 'required|string|max:125',
            'phone' => 'required|string|regex:/^(\d{10})$/',  
            'address' => 'required|string',
            'province_id' => 'required|integer',
            'district_id' => 'required|integer',
            'ward_id' => 'required|integer',
        ]);

        $province = collect($this->provinces)->firstWhere('ProvinceID', $this->province_id);
        $district = collect($this->districts)->firstWhere('DistrictID', $this->district_id);
        $ward = collect($this->wards)->firstWhere('WardCode', $this->ward_id);

        CheckoutAddress::create([
            'user_id' => Auth::id(),
            'username_address' => $this->username_address,
            'phone' => $this->phone,
            'address' => $this->address,
            'province_name' => $province['ProvinceName'],
            'district_name' => $district['DistrictName'],
            'ward_name' => $ward['WardName'],
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'ward_id' => $this->ward_id,
        ]);

        $this->addresses = CheckoutAddress::where('user_id', Auth::id())->get();

        // Đặt lại các giá trị form
        $this->reset(['username_address', 'phone', 'address', 'province_id', 'district_id', 'ward_id']);

        session()->flash('message', 'Địa chỉ đã được lưu thành công!');
    }

    public $deleteModalOpen = false; 

    public function confirmDelete($addressId)
    {
        $this->deleteModalOpen = true;
        $this->addressIdToDelete = $addressId;
    }
    
    public function deleteAddress()
    {
        if (isset($this->addressIdToDelete)) {
            $address = CheckoutAddress::find($this->addressIdToDelete);
            if ($address && $address->user_id === Auth::id()) {
                $address->delete();
                $this->addresses = CheckoutAddress::where('user_id', Auth::id())->get();
                session()->flash('message', 'Địa chỉ đã được xóa!');
            } else {
                session()->flash('error', 'Không tìm thấy địa chỉ hoặc không có quyền xóa.');
            }
        }
    
        $this->deleteModalOpen = false;
    }
    #[On('updateProvince')]
    public function updatedProvinceId(GhnService $ghn)
    {
        $this->province_id = (int) $this->province_id;
        $districtsData = $ghn->getDistricts($this->province_id);
        $this->districts = $districtsData;
        $this->district_id = null;
        $this->wards = [];
        $this->ward_id = null;
    }

    #[On('updateDistrict')]
    public function updatedDistrictId(GhnService $ghn)
    {
        $wardsData = $ghn->getWards($this->district_id);
        $this->wards = $wardsData;
        $this->ward_id = null;
    }

    public function render()
    {
        return view('livewire.settings.address');
    }
}
