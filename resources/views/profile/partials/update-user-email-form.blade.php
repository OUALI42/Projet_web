<div class="card pb-2.5">
    <div class="card-header" id="auth_email">
        <h3 class="card-title">
            Email
        </h3>
    </div>
    <div class="card-body grid gap-5 pt-7.5">
        <div class="w-full">
            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                <label class="form-label max-w-56">
                    Email
                </label>
                <div>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')
                    <x-forms.input
                        label="{{ __('Email') }}"
                        name="email"
                        type="email"
                        :value="old('email', $user->email)"
                        required
                        :messages="$errors->get('email')"
                    />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <x-forms.primary-button>Save Changes</x-forms.primary-button>
        </div>
    </div>
</div>
