<section class="w-full px-10">
    @include('partials.settings-heading')
    <x-settings.layout :heading="__('Your Appointments')" :subheading="__('List of all appointments')">

        @if ($selectedAppointment)
        <div class="bg-white dark:bg-white/10 p-6 rounded-lg shadow" style="min-width: 800px;">
            <h2 class="text-lg font-semibold mb-4">Appointment for {{ $selectedAppointment->customer_name }}</h2>

            <table class="w-full table-auto border border-gray-300 dark:border-gray-700">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300 border-b border-gray-300 dark:border-gray-700">{{ __('Field') }}</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300 border-b border-gray-300 dark:border-gray-700">{{ __('Details') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-800 dark:text-gray-200 border-b border-gray-300 dark:border-gray-700">{{ __('Phone') }}</td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $selectedAppointment->customer_phone }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-800 dark:text-gray-200 border-b border-gray-300 dark:border-gray-700">{{ __('Date') }}</td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $selectedAppointment->date }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-800 dark:text-gray-200 border-b border-gray-300 dark:border-gray-700">{{ __('Time') }}</td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $selectedAppointment->time }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-800 dark:text-gray-200 border-b border-gray-300 dark:border-gray-700">{{ __('Branch') }}</td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $selectedAppointment->branch->branch_name }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-800 dark:text-gray-200 border-b border-gray-300 dark:border-gray-700">{{ __('Chair') }}</td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $selectedAppointment->chair->name }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-800 dark:text-gray-200 border-b border-gray-300 dark:border-gray-700">{{ __('Services') }}</td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">
                            <ul class="space-y-2">
                                @foreach ($selectedAppointment->services as $service)
                                <li>{{ $service->name }} - ${{ number_format($service->price, 2) }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-800 dark:text-gray-200 border-b border-gray-300 dark:border-gray-700">{{ __('Total Price') }}</td>
                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">${{ number_format($selectedAppointment->services->sum('price'), 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <button wire:click="hideAppointmentDetail" class="mt-4 text-blue-600 hover:underline">
                ← Back to appointment list
            </button>
        </div>
        @else
        <div class="grid gap-4">
            @foreach ($appointments as $appointment)
            <div class="p-4 bg-white dark:bg-white/10 rounded shadow border dark:border-gray-700" style="min-width: 800px;">
                <h3 class="font-semibold">Appointment for {{ $appointment->customer_name }}</h3>
                <p><strong>Phone:</strong> {{ $appointment->customer_phone }}</p>
                <p><strong>Date:</strong> {{ $appointment->date }}</p>
                <p><strong>Time:</strong> {{ $appointment->time }}</p>

                <button wire:click="showAppointmentDetail({{ $appointment->id }})" class="text-blue-600 hover:underline mt-2">
                    See Details
                </button>
            </div>
            @endforeach
        </div>
        @endif
    </x-settings.layout>
</section>