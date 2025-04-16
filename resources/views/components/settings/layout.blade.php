<div class="flex items-start max-md:flex-col">
    <div class="mr-10 w-full pb-4 md:w-[220px]">
        <flux:navlist>
            <flux:navlist.item :href="route('settings.profile')" wire:navigate>{{ __('Thông tin cá nhân') }}</flux:navlist.item>
            <flux:navlist.item :href="route('settings.password')" wire:navigate>{{ __('Đổi mật khẩu') }}</flux:navlist.item>
            <flux:navlist.item :href="route('settings.address')" wire:navigate>{{ __('Địa chỉ') }}</flux:navlist.item>
            <flux:navlist.item :href="route('settings.order')" wire:navigate>{{ __('Đơn hàng') }}</flux:navlist.item>
            <flux:navlist.item :href="route('settings.appearance')" wire:navigate>{{ __('Tùy chỉnh giao diện') }}</flux:navlist.item>
            <flux:navlist.item :href="route('home')" variant="ghost">
                Trở về trang chủ
            </flux:button>

        </flux:navlist>
    </div>

    <flux:separator class="md:hidden" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>