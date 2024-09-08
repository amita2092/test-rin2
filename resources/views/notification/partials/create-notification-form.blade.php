<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Notification') }}
        </h2>

        <!-- <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p> -->
    </header>

    <form method="post" action="{{ route('notification.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
        <x-input-label for="type" :value="__('Type')" />
            <select id="type" name="type" class="mt-1 block w-full" required>
                <option value="" disabled>Select</option>
                <option value="marketing">{{ __('Marketing') }}  </option>
                <option value="invoices">{{ __('Invoices') }}  </option>
                <option value="system">{{ __('System') }}  </option>
                    {{ __('Disabled') }}
                </option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('type')" />
        </div>

        <div>
            <x-input-label for="short_text" :value="__('Short text')" />
            <x-text-input id="short_text" name="short_text" type="text" class="mt-1 block w-full" autocomplete="short-text" />
            <x-input-error class="mt-2" :messages="$errors->get('type')" />
        </div>

        <div>
            <x-input-label for="short_text" :value="__('Expiration Time (days):')" />
            <x-text-input id="expiration" name="expiration" type="number" class="mt-1 block w-full" autocomplete="expiration" min="1" required/>
            <x-input-error class="mt-2" :messages="$errors->get('expiration')" />
        </div>


        <div>
            <x-input-label for="users" :value="__('Select Users')" />
            <select id="users" name="users[]" multiple class="mt-1 block w-full" required>

                <!-- Options for individual users -->
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('users')" />
            
            
        </div>
        <div><input type="checkbox" id="myCheckbox" /><label for="myCheckbox">All Users</label></div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>


<!-- JavaScript to handle select all functionality -->
<script>
    document.getElementById('myCheckbox').addEventListener('change', function() {
        const usersSelect = document.getElementById('users');
        
        // Check if the "All Users" checkbox is checked
        if (this.checked) {
            // Select all options
            for (let i = 0; i < usersSelect.options.length; i++) {
                usersSelect.options[i].selected = true;
            }
        } else {
            // Deselect all options if checkbox is unchecked
            for (let i = 0; i < usersSelect.options.length; i++) {
                usersSelect.options[i].selected = false;
            }
        }
    });
</script>