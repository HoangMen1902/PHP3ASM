<main>
    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 pt-70 text-center">
                            <h2>Booking</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="padding: 30px 0" class="container py-6 ">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Make an appointment</h4>

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form id="appointment-form" wire:submit.prevent="submit">
                    <div class="mb-3">
                        <label class="form-label">Fullname</label>
                        <input type="text" wire:model="customer_name" class="form-control">
                        @error('customer_name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" wire:model="customer_phone" class="form-control">
                        @error('customer_phone') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Day</label>
                        <input type="date" wire:model="date" class="form-control">
                        @error('date') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Time</label>
                        <input type="time" wire:model="time" class="form-control">
                        @error('time') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Branch</label>
                        <select wire:model="branch_id" class="form-select" id="brandSelect">
                            <option value="">-- Choose branch --</option>
                            @foreach ($branches as $branch)
                                <option value={{ $branch->id }}>{{ $branch->branch_name ?? 'Chi nhánh không xác định' }}
                                </option>
                            @endforeach
                        </select>
                        @error('branch_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    @if (!empty($chairs))
                        <div class="mb-3">
                            <label class="form-label">Chair</label>
                            <select wire:model="chair_id" class="form-select" id="chairSelect">
                                <option value="">-- Choose chair --</option>
                                @foreach ($chairs as $chair)
                                    <option value={{ $chair->id }}>{{ $chair->name ?? 'Ghế không xác định' }}</option>
                                @endforeach
                            </select>
                            @error('chair_id') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                    @endif


                    <div class="mb-3">
                        <label for="" class="form-label">Services</label>
                        @if (!empty($services))
                            @foreach ($services as $service)
                                <div>
                                    <input type="checkbox" wire:model="selectedServices" value="{{ $service->id }}">
                                    <span>{{ $service->name}} - {{  number_format($service->price, 2) }}$</span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary my-4 w-100">Book!</button>
                </form>
            </div>
        </div>
    </div>


    @script
    <script>
        $(() => {
            $('#brandSelect').on('change', function () {
                let branch_id = $(this).val();
                $wire.dispatch('chose-branch', { branch_id: branch_id });
            });
            $('#chairSelect').on('change', function () {
                let chair_id = $(this).val();
                $wire.dispatch('chose-chair', { chair_id: chair_id });
            });
        });
    </script>
    @endscript
</main>