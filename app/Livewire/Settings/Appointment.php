<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Appointment as AppointmentModel;

class Appointment extends Component
{
    public $appointments;
    public $selectedAppointment = null;

    public function mount()
    {
        $this->appointments = AppointmentModel::with( 'branch', 'services' )
        ->latest()
        ->where('user_id', Auth::id())
        ->get();
    }
    public function showAppointmentDetail($appointmentId)
    {
        $this->selectedAppointment = AppointmentModel::with('services', 'branch')->find($appointmentId);
    }

    public function hideAppointmentDetail()
    {
        $this->selectedAppointment = null;
    }

    public function render()
    {
        return view('livewire.settings.appointment');
    }
}
