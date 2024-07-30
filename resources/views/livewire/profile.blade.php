<div class="container py-3 flex flex-col mb-5">
    <x-slot name="title">{{ __('messages.profile') }}</x-slot>
    <div class="container grid w-full animate-[slidebottom_.7s_linear_both]">
        <button
            class="bg-white w-auto text-black rounded px-3 py-2 font-bold hover:bg-blue-200 me-auto flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                <path d="m12.707 7.707-1.414-1.414L5.586 12l5.707 5.707 1.414-1.414L8.414 12z"></path>
                <path d="M16.293 6.293 10.586 12l5.707 5.707 1.414-1.414L13.414 12l4.293-4.293z"></path>
            </svg>
            <a href="/dashboard" class="uppercase" wire:navigate>@lang('messages.dashboard')</a>
        </button>
        <div class="flex items-center gap-1 justify-center">
            <h3 class="text-center uppercase font-bold text-xl" wire:poll>{{ Auth::user()->name }}</h3>
        </div>
        <div class="p-3 rounded bg-blue-400 flex text-center place-self-center mt-5 shadow w-full md:w-2/3">
            <form wire:submit="updateData('{{ $user->email }}')" method="POST" class="w-full flex flex-col gap-4">
                @csrf
                <div class="flex flex-col gap-5 w-full">
                    <label for="username"
                        class="uppercase {{ session()->get('locale') === 'en' ? 'me-auto' : 'ms-auto' }} mb-0 pb-0 font-bold">@lang('messages.username')</label>
                    <div class="flex flex-col lg:flex-row w-full items-start gap-3">
                        <h3 class="w-full bg-slate-200 p-2 rounded flex items-center justify-between" wire:poll
                            style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}">
                            <small class="text-lg">
                                {{ ucwords($user->name) }}
                            </small>

                            @if (!$hidden_name)
                                <button type="button" wire:click='hide_name' style="cursor: pointer"
                                    class="hover:bg-blue-200 rounded">
                                    <img class="w-7 h-7"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAdRJREFUWEfdmI1NwzAQhV83oZMAm9BJgEmASQqTwCbQh2JkX853z00iRViKWin2+fO7H9s5YGftsDMe/BugGwAPAG4B8D+fr0lt/vJ5A/A+6oFRhZ4APA5MUsA4Tmoq0B2Al0kJybDpJIMpQKOqRMDPl5ehWhnQ+RIHVGfN9grg1DMYAa2pjJ2/q1QPiKpQnS0bVaJaTesBfS4IYHURDPSjAsT6woyKGo2x9iztM3Odp1CmTllZFGN0B4si3R6Bz1SyQIo69RgPqo4NwmRQ93VFt0B0FaFGakkNZQNVWWDjNguk1h3re0JR/jprFBgunK6lSr/NAmXxUysXVV0VhvaaOLJA32rOTv08qBGY1YG84nZNhf8TZonL3Eo7KTcCFbpMDWovm5ji9U6uQoVBrRiJUtvLvuxA1+z+1mXZpkp5maLluOoFcA1F1Zi5UQsLIwdmmVagyinSm4xQXHkGMys93l6mpK2yuSoVZJYYHpCy/yiTZX3k4wcNKSplE2bvm9jpbR21ESXjskl774ePsMXQFlBN3bHE2a2D/deEWnwNKgtY46JYTpGhmxWFioFyn88qbz2hfGNVgjpaSfax4WM6eG3+seHarJLHjbhMNrqk4+6AfgAjoW4lww46yAAAAABJRU5ErkJggg==" />
                                </button>
                            @else
                                <button type="button" wire:click='show_name' style="cursor: pointer"
                                    class="hover:bg-blue-200 rounded">
                                    <img class="w-7 h-7"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAVZJREFUWEft2O0NgjAQBuCXTXQSdRM3USdxFHUSdRL1TcAc5fpBeyUk0MQ/YrnH68dRGsysNTPzYPGgDYAbgAOAlzY6oQyx8zFjSO8A+HEb7/dsvyRGRflA/Bf7TAwDhTDdNRWlgZiVqyGGt2JmmCG3DVAa6Azg1PZk6h+JOPbztW7uaCjG+Gc1Brr8IoQChawMLieuhuL1rbxJLVA3gd2AEjXAEFYDJFcTY2gozlFt8puDXIxcUb2h8Y21ZYZ8mFEoK1AMow2dmiQLkBnGYlKXYlgNemWmJEOlGK60t7vP5YIsMCxRg403B1SKkbXSBPSJ1DZ1BxZ9ZK2sDoph6JoMlIKZDJSKmQQ0BlMFlPi85v2Z+RxaQcGUlqandNmPechPte7EEStpY2QF5rlsisbH2Gi1d5dmLVjv+NMFCR2lmSkWUu0sVYr0HbfXtx/RzC7+/VA0Q1+mJoUlzrswFgAAAABJRU5ErkJggg==" />
                                </button>
                            @endif
                        </h3>
                        @if (!$hidden_name)
                            <div
                                class="flex flex-col w-full items-center justify-center gap-1 h-full animate-[slideRight2_.3s_linear_both]">
                                <input type="text" id="username"
                                    class="block w-full bg-white focus:outline-none text-black rounded p-2 h-full"
                                    placeholder="{{ __('messages.new_name') }}" wire:model.blur='name' />
                                @error('name')
                                    <span class="text-red-900 font-medium">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <hr class="block lg:hidden border-black my-3">

                    <label for="email"
                        class="uppercase {{ session()->get('locale') === 'en' ? 'me-auto' : 'ms-auto' }} mb-0 pb-0 font-bold">@lang('messages.email')</label>
                    <div class="flex flex-col lg:flex-row w-full items-start gap-3">
                        <h3 class="w-full bg-slate-200 p-2 rounded flex items-center justify-between" wire:poll
                            style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}">
                            <small class="text-lg">
                                {{ ucwords($user->email) }}
                            </small>

                            @if (!$hidden_email)
                                <button type="button" wire:click='hide_email' style="cursor: pointer"
                                    class="hover:bg-blue-200 rounded">
                                    <img class="w-7 h-7"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAdRJREFUWEfdmI1NwzAQhV83oZMAm9BJgEmASQqTwCbQh2JkX853z00iRViKWin2+fO7H9s5YGftsDMe/BugGwAPAG4B8D+fr0lt/vJ5A/A+6oFRhZ4APA5MUsA4Tmoq0B2Al0kJybDpJIMpQKOqRMDPl5ehWhnQ+RIHVGfN9grg1DMYAa2pjJ2/q1QPiKpQnS0bVaJaTesBfS4IYHURDPSjAsT6woyKGo2x9iztM3Odp1CmTllZFGN0B4si3R6Bz1SyQIo69RgPqo4NwmRQ93VFt0B0FaFGakkNZQNVWWDjNguk1h3re0JR/jprFBgunK6lSr/NAmXxUysXVV0VhvaaOLJA32rOTv08qBGY1YG84nZNhf8TZonL3Eo7KTcCFbpMDWovm5ji9U6uQoVBrRiJUtvLvuxA1+z+1mXZpkp5maLluOoFcA1F1Zi5UQsLIwdmmVagyinSm4xQXHkGMys93l6mpK2yuSoVZJYYHpCy/yiTZX3k4wcNKSplE2bvm9jpbR21ESXjskl774ePsMXQFlBN3bHE2a2D/deEWnwNKgtY46JYTpGhmxWFioFyn88qbz2hfGNVgjpaSfax4WM6eG3+seHarJLHjbhMNrqk4+6AfgAjoW4lww46yAAAAABJRU5ErkJggg==" />
                                </button>
                            @else
                                <button type="button" wire:click='show_email' style="cursor: pointer"
                                    class="hover:bg-blue-200 rounded">
                                    <img class="w-7 h-7"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAVZJREFUWEft2O0NgjAQBuCXTXQSdRM3USdxFHUSdRL1TcAc5fpBeyUk0MQ/YrnH68dRGsysNTPzYPGgDYAbgAOAlzY6oQyx8zFjSO8A+HEb7/dsvyRGRflA/Bf7TAwDhTDdNRWlgZiVqyGGt2JmmCG3DVAa6Azg1PZk6h+JOPbztW7uaCjG+Gc1Brr8IoQChawMLieuhuL1rbxJLVA3gd2AEjXAEFYDJFcTY2gozlFt8puDXIxcUb2h8Y21ZYZ8mFEoK1AMow2dmiQLkBnGYlKXYlgNemWmJEOlGK60t7vP5YIsMCxRg403B1SKkbXSBPSJ1DZ1BxZ9ZK2sDoph6JoMlIKZDJSKmQQ0BlMFlPi85v2Z+RxaQcGUlqandNmPechPte7EEStpY2QF5rlsisbH2Gi1d5dmLVjv+NMFCR2lmSkWUu0sVYr0HbfXtx/RzC7+/VA0Q1+mJoUlzrswFgAAAABJRU5ErkJggg==" />
                                </button>
                            @endif
                        </h3>
                        @if (!$hidden_email)
                            <div
                                class="flex flex-col w-full items-center justify-center gap-1 h-full animate-[slideRight2_.3s_linear_both]">
                                <input type="email" id="email"
                                    class="block w-full bg-white focus:outline-none text-black rounded p-2 h-full"
                                    placeholder="{{ __('messages.new_email') }}" wire:model.blur='email' />
                                @error('email')
                                    <span class="text-red-900 font-medium">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <hr class="block lg:hidden border-black my-3">

                    <label for="password"
                        class="uppercase {{ session()->get('locale') === 'en' ? 'me-auto' : 'ms-auto' }} mb-0 pb-0 font-bold">@lang('messages.password')</label>
                    <div class="flex flex-col lg:flex-row w-full items-start gap-3">
                        <h3 class="w-full bg-slate-200 p-2 rounded flex items-center justify-between" wire:poll
                            style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}">
                            <small class="text-lg m-0 p-0 uppercase">@lang('messages.hidden_pass')</small>
                            @if (!$hidden_password)
                                <button type="button" wire:click='hide_pass' style="cursor: pointer"
                                    class="hover:bg-blue-200 rounded">
                                    <img class="w-7 h-7"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAdRJREFUWEfdmI1NwzAQhV83oZMAm9BJgEmASQqTwCbQh2JkX853z00iRViKWin2+fO7H9s5YGftsDMe/BugGwAPAG4B8D+fr0lt/vJ5A/A+6oFRhZ4APA5MUsA4Tmoq0B2Al0kJybDpJIMpQKOqRMDPl5ehWhnQ+RIHVGfN9grg1DMYAa2pjJ2/q1QPiKpQnS0bVaJaTesBfS4IYHURDPSjAsT6woyKGo2x9iztM3Odp1CmTllZFGN0B4si3R6Bz1SyQIo69RgPqo4NwmRQ93VFt0B0FaFGakkNZQNVWWDjNguk1h3re0JR/jprFBgunK6lSr/NAmXxUysXVV0VhvaaOLJA32rOTv08qBGY1YG84nZNhf8TZonL3Eo7KTcCFbpMDWovm5ji9U6uQoVBrRiJUtvLvuxA1+z+1mXZpkp5maLluOoFcA1F1Zi5UQsLIwdmmVagyinSm4xQXHkGMys93l6mpK2yuSoVZJYYHpCy/yiTZX3k4wcNKSplE2bvm9jpbR21ESXjskl774ePsMXQFlBN3bHE2a2D/deEWnwNKgtY46JYTpGhmxWFioFyn88qbz2hfGNVgjpaSfax4WM6eG3+seHarJLHjbhMNrqk4+6AfgAjoW4lww46yAAAAABJRU5ErkJggg==" />
                                </button>
                            @else
                                <button type="button" wire:click='show_pass' style="cursor: pointer"
                                    class="hover:bg-blue-200 rounded">
                                    <img class="w-7 h-7"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAVZJREFUWEft2O0NgjAQBuCXTXQSdRM3USdxFHUSdRL1TcAc5fpBeyUk0MQ/YrnH68dRGsysNTPzYPGgDYAbgAOAlzY6oQyx8zFjSO8A+HEb7/dsvyRGRflA/Bf7TAwDhTDdNRWlgZiVqyGGt2JmmCG3DVAa6Azg1PZk6h+JOPbztW7uaCjG+Gc1Brr8IoQChawMLieuhuL1rbxJLVA3gd2AEjXAEFYDJFcTY2gozlFt8puDXIxcUb2h8Y21ZYZ8mFEoK1AMow2dmiQLkBnGYlKXYlgNemWmJEOlGK60t7vP5YIsMCxRg403B1SKkbXSBPSJ1DZ1BxZ9ZK2sDoph6JoMlIKZDJSKmQQ0BlMFlPi85v2Z+RxaQcGUlqandNmPechPte7EEStpY2QF5rlsisbH2Gi1d5dmLVjv+NMFCR2lmSkWUu0sVYr0HbfXtx/RzC7+/VA0Q1+mJoUlzrswFgAAAABJRU5ErkJggg==" />
                                </button>
                            @endif
                        </h3>
                        @if (!$hidden_password)
                            <div
                                class="flex flex-col w-full items-center justify-center gap-1 h-full animate-[slideRight2_.3s_linear_both]">
                                <input type="password" id="password"
                                    class="block w-full bg-white focus:outline-none text-black rounded p-2 h-full"
                                    placeholder="{{ __('messages.new_pass') }}" wire:model.blur='password' />
                                @error('password')
                                    <span class="text-red-900 font-medium">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>

                <div class="w-full flex items-center gap-3 mt-5">
                    <button type="submit"
                        class="bg-black w-full text-white rounded px-3 py-2 font-bold hover:bg-purple-700 uppercase">@lang('messages.update')</button>
                </div>
            </form>
        </div>
    </div>
    <div wire:loading wire:target="updateData" class="mx-auto">
        @include('includes.loader')
    </div>

</div>
