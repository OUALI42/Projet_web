<div class="card pb-2.5">
    <div class="card-header" id="auth_password">
        <h3 class="card-title">Password</h3>
    </div>

    <div class="card-body grid gap-5 pt-7.5">
        <form method="POST" action="{{ route('profile.updatePassword') }}">
            @csrf
            @method('PATCH')

            <x-forms.input
                label="{{ __('Current Password') }}"
                name="current_password"
                type="password"
                :placeholder="__('Enter your current password')"
                required
                :messages="$errors->get('current_password')"
            />

            <x-forms.input
                label="{{ __('New Password') }}"
                name="password"
                type="password"
                :placeholder="__('Enter new password')"
                required
                :messages="$errors->get('password')"
            />

            <x-forms.input
                label="{{ __('Confirm Password') }}"
                name="password_confirmation"
                type="password"
                :placeholder="__('Confirm new password')"
                required
                :messages="$errors->get('password_confirmation')"
            />

            <div class="flex justify-end pt-2.5">
                <x-forms.primary-button>Reset Password</x-forms.primary-button>

                @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 ml-4"
                    >
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</div>
