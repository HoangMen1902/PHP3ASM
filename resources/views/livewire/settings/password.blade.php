<section class="w-full px-10">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Update Password')" :subheading="__('Make sure your account uses a long, random password to stay secure.')">
        <form wire:submit="updatePassword" class="mt-6 space-y-6">
            <flux:input
                wire:model="current_password"
                :label="__('Current Password')"
                type="password"
                autocomplete="current-password"
                style="min-width: 800px" />
            <flux:input
                wire:model="password"
                :label="__('New Password')"
                type="password"
                autocomplete="new-password"
                style="min-width: 800px"
            />
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirm new password')"
                type="password"
                autocomplete="new-password"
                style="min-width: 800px"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Change password') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('Update successful.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
