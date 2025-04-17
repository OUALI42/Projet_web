<form method="POST" action="{{ route('profile.updateAvatar') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="card pb-2.5">
        <div class="card-header" id="basic_settings">
            <h3 class="card-title">Basic Settings</h3>
        </div>

        <div class="card-body grid gap-5">
            <div class="flex items-center flex-wrap gap-2.5">
                <label class="form-label max-w-56">Photo</label>
                <div class="flex items-center justify-between flex-wrap grow gap-2.5">
                    <span class="text-2sm text-gray-700">150x150px JPEG, PNG Image</span>

                    <div class="image-input size-16" data-image-input="true">
                        <input accept=".png, .jpg, .jpeg" name="avatar" type="file" />
                        <input name="avatar_remove" type="hidden" />

                        <div class="btn btn-icon btn-icon-xs btn-light shadow-default absolute z-1 size-5 -top-0.5 -end-0.5 rounded-full" data-image-input-remove="" data-tooltip="#image_input_tooltip" data-tooltip-trigger="hover">
                            <i class="ki-filled ki-cross"></i>
                        </div>

                        <span class="tooltip" id="image_input_tooltip">Click to remove or revert</span>

                        <div class="image-input-placeholder rounded-full border-2 border-success image-input-empty:border-gray-300"
                             style="background-image:url({{ asset('metronic/media/avatars/blank.png') }})">
                            <div class="image-input-preview rounded-full"
                                 style="background-image:url({{ $user->avatar ? asset('storage/' . $user->avatar) : asset('metronic/media/avatars/300-2.png') }})"></div>
                            <div class="flex items-center justify-center cursor-pointer h-5 left-0 right-0 bottom-0 bg-dark-clarity absolute">
                                <!-- icône -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label flex items-center gap-1 max-w-56">Last name</label>
                    <x-forms.input
                        name="last_name"
                        type="text"
                        :value="old('name', auth()->user()->last_name)"
                        required autofocus class="w-full"
                        :messages="$errors->get('last_name')" />
                </div>
            </div>

            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label flex items-center gap-1 max-w-56">First name</label>
                    <x-forms.input
                        name="first_name"
                        type="text"
                        :value="old('name', auth()->user()->first_name)"
                        required autofocus class="w-full"
                        :messages="$errors->get('first_name')" />
                </div>
            </div>

            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label flex items-center gap-1 max-w-56">Phone number</label>
                    <input class="input" placeholder="Enter phone" type="text"/>
                </div>
            </div>

            <div class="flex justify-end pt-2.5">
                <button class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</form>
