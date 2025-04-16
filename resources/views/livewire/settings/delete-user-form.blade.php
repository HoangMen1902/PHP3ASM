<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('Xóa tài khoản') }}</flux:heading>
        <flux:subheading>{{ __('Xóa tài khoản của bạn và tất cả các tài nguyên của nó') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('Xóa tài khoản') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Bạn có chắc chắn muốn xóa tài khoản của mình không?') }}</flux:heading>

                <flux:subheading>
                    {{ __('Sau khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của tài khoản đó sẽ bị xóa vĩnh viễn. Vui lòng nhập mật khẩu của bạn để xác nhận bạn muốn xóa vĩnh viễn tài khoản của mình.') }}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" :label="__('Mật khẩu')" type="password" />

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Thoát') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" type="submit">{{ __('Xóa tài khoản') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</section>
