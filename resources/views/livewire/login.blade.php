<div class="flex flex-col justify-center items-center py-3 w-full">
    <x-slot name="title">{{ __('messages.account') }}</x-slot>
    <div class="p-1 rounded flex items-center absolute top-0">
        @if (session()->get('locale') === 'en')
            <a href="{{ route('locale', 'ar') }}" wire:navigate class="bg-black shadow text-white p-1 rounded">AR</a>
        @else
            <a href="{{ route('locale', 'en') }}" wire:navigate class="bg-black shadow text-white p-1 rounded">EN</a>
        @endif
    </div>
    @error('Error')
        <p class="w-max mx-auto text-center text-2xl bg-red-500 rounded shadow my-2 p-2 text-white">{{ $message }}</p>
    @enderror

    @if ($this->register_form)
        <div class="p-4 w-4/5 mx-auto md:w-1/3 flex-col flex rounded bg-slate-200 flex text-center shadow">
            <h1 class="text-center font-bold text-3xl my-2 uppercase">@lang('messages.register')</h1>
            <form wire:submit='signup' method="POST">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <input type="text" placeholder="{{ __('messages.username') }}" wire:model.live='name'
                            style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                            class="block w-auto mt-1 text-sm dark:bg-gray-700 focus:border-black border-2 focus:outline-none dark:text-white rounded-lg p-3 placeholder:uppercase" />
                        @error('name')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <input type="email" wire:model.live='email' placeholder="{{ __('messages.email') }}"
                            style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                            class="block w-auto mt-1 text-sm dark:bg-gray-700 focus:border-black border-2 focus:outline-none dark:text-white rounded-lg p-3 placeholder:uppercase" />
                        @error('email')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <input type="password" wire:model.live='password' placeholder="{{ __('messages.password') }}"
                            style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                            class="block w-auto mt-1 text-sm dark:bg-gray-700 focus:border-black border-2 focus:outline-none dark:text-white rounded-lg p-3 placeholder:uppercase" />
                        @error('password')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="bg-green-500 mt-3 text-white rounded px-3 py-2 font-bold hover:bg-purple-700 uppercase">@lang('messages.register')
                </button>
                <div wire:loading wire:target="signup">
                    @include('includes.loader')
                </div>
            </form>
            <button class="bg-yellow-300 mt-3 text-black rounded px-3 py-2 font-bold hover:bg-white uppercase"
                wire:click='loginForm'>@lang('messages.login_here')</button>
        </div>
    @else
        <div class="p-4 w-4/5 md:w-1/3 flex-col flex mx-auto rounded bg-slate-200 flex text-center shadow">
            <h1 class="text-center font-bold text-3xl my-2 uppercase">@lang('messages.login')</h1>
            <form wire:submit='login' method="POST">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <input
                            placeholder="{{ __('messages.username') . ' ' . __('messages.or') . ' ' . __('messages.email') }}"
                            wire:model.live='user_email_name' type="text"
                            style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                            class="block w-auto mt-1 text-sm dark:bg-gray-700 focus:border-black border-2 focus:outline-none dark:text-white rounded-lg p-3 placeholder:uppercase" />
                        @error('user_email_name')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <input placeholder="{{ __('messages.password') }}" type="password"
                            wire:model.live='user_password'
                            style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                            class="block w-auto mt-1 text-sm dark:bg-gray-700 focus:border-black border-2 focus:outline-none dark:text-white rounded-lg p-3 placeholder:uppercase" />
                        @error('user_password')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="bg-green-500 mt-3 text-white rounded px-3 py-2 font-bold hover:bg-purple-700 uppercase">@lang('messages.login')</button>
            </form>
            <button class="bg-yellow-300 mt-3 text-black rounded px-3 py-2 font-bold hover:bg-white uppercase"
                wire:click='signupForm'>@lang('messages.signup_here')
            </button>
            <div wire:loading wire:target="login">
                @include('includes.loader')
            </div>
        </div>
    @endif

    <div wire:loading wire:target="signupForm, loginForm">
        @include('includes.loader')
    </div>

</div>
