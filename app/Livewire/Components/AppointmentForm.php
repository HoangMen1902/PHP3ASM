<?php
namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Branch;
use App\Models\Chair;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class AppointmentForm extends Component
{
    public $branches = [];
    public $chairs = [];
    public $customer_name;
    public $customer_phone;
    public $date;
    public $time;
    public $branch_id; 
    public $chair_id;

    public function mount()
    {
        $this->branches = Branch::all();
    }
    #[On('chose-branch')] 
    public function updatedBranchId($branch_id)
    {
        $this->chairs = Chair::where('branch_id', $branch_id)->get();
        $this->branch_id = $branch_id;

    }
    #[On('chose-chair')]
    public function updatedChairId($chair_id)
    {
        Log::error('Chair ID updated: ', ['chair_id' => $chair_id]);

        $this->chair_id = $chair_id;
    }
    public function submit()
{
    Log::error('Updated Branch ID: ', ['branch_id' => $this->branch_id]);
    Log::error('Updated Chair ID: ', ['chair_id' => $this->chair_id]);

    $this->validate([
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:15',
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required',
        'branch_id' => 'required|exists:branches,id',
        'chair_id' => 'required|exists:chairs,id',
    ]);
    
    if (Auth::check()) {
        $userId = Auth::id();
    }

    $appointmentDateTime = Carbon::parse("{$this->date} {$this->time}");

    $startTime = $appointmentDateTime->copy()->subMinutes(20);
    $endTime = $appointmentDateTime->copy()->addMinutes(20);

    $exists = Appointment::where('branch_id', $this->branch_id)
        ->where('chair_id', $this->chair_id)
        ->where(function($query) use ($startTime, $endTime) {
            $query->whereBetween('date', [$startTime->toDateString(), $endTime->toDateString()])
                  ->whereBetween('time', [$startTime->toTimeString(), $endTime->toTimeString()]);
        })
        ->exists();

    if ($exists) {
        session()->flash('error', 'Ghế này đã có người đặt vào giờ này hoặc trong khoảng thời gian 20 phút trước/sau!');
        return;
    }

    Appointment::create([
        'customer_name' => $this->customer_name,
        'customer_phone' => $this->customer_phone,
        'date' => $this->date,
        'time' => $this->time,
        'branch_id' => $this->branch_id,
        'chair_id' => $this->chair_id,
        'user_id' => $userId,
    ]);

    session()->flash('success', 'Đặt lịch thành công!');
    return Redirect::to('/');
}

    public function render()
    {
        return view('livewire.components.appointment-form', [
            'branches' => $this->branches,
            'chairs' => $this->chairs,
        ]);
    }
}
