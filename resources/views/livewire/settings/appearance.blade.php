<div class="flex flex-col items-start">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('')" :subheading=" __('Cập nhật cài đặt giao diện cho tài khoản của bạn')">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('Sáng') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Tối') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('Hệ thống') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</div>
