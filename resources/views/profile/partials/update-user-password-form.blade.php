<div class="card pb-2.5">
    <div class="card-header" id="auth_password">
        <h3 class="card-title">Password</h3>
    </div>

    <div class="card-body grid gap-5 pt-7.5">
        <div class="w-full">
            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                <label class="form-label max-w-56">
                    {{ __('Change Password') }}
                </label>
                <div>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <x-forms.input
                            label="{{ __('Current Password') }}"
                            name="current_password"
                            type="password"
                            required
                            :placeholder="__('Enter your current password')"
                            :messages="$errors->get('current_password')"
                        />

                        <x-forms.input
                            label="{{ __('New Password') }}"
                            name="password"
                            type="password"
                            required
                            :placeholder="__('Enter new password')"
                            :messages="$errors->get('password')"
                        />

                        <x-forms.input
                            label="{{ __('Confirm New Password') }}"
                            name="password_confirmation"
                            type="password"
                            required
                            :placeholder="__('Confirm new password')"
                            :messages="$errors->get('password_confirmation')"
                        />

                        <div class="flex justify-end pt-2.5">
                            <x-forms.primary-button>{{ __('Reset Password') }}</x-forms.primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
