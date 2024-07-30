<div class="container py-3 flex flex-col">
    <x-slot name="title">{{ __('messages.authors') }}</x-slot>
    @if ($tableShow)
        <div
            class="w-auto flex flex-col md:flex-row items-center justify-between py-3 px-2 my-5 font-bold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none">
            <div class="flex items-center mb-2 md:mb-0 uppercase">
                <span>@lang('messages.authors') ({{ $authors_count }})</span>
            </div>
            <button
                class="px-3 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:text-black hover:bg-white focus:outline-none border-white border-2 uppercase"
                wire:click="addForm">
                @lang('messages.add_author')
            </button>
        </div>
    @endif
    <div class="container grid w-full px-6 mx-auto animate-[slidebottom_.7s_linear_both]">
        @if ($tableShow === true)
            <div class="w-full mb-8 flex flex-col items-center md:justify-center overflow-hidden">
                <div class="flex items-center justify-start mb-7 me-auto w-full md:w-1/3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                        style="fill: #000;" class="bg-slate-300 rounded-l p-1">
                        <path
                            d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z">
                        </path>
                    </svg>
                    <input placeholder="{{ __('messages.author_search') }} ..."
                        style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}" wire:model.live='search'
                        class="block me-auto w-full bg-slate-300 focus:outline-none text-black rounded-r p-2 placeholder:text-black" />
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="table-auto w-full rounded border border-2 border-blue-500 mb-2">
                        <thead>
                            <tr
                                class="tracking-wide text-center text-white uppercase border-b bg-gray-800">
                                <th class="p-3 text-sm">@lang('messages.firstname')</th>
                                <th class="p-3 text-sm">@lang('messages.lastname')</th>
                                <th class="p-3 text-sm">@lang('messages.options')</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($authors as $author)
                                <tr class="text-gray-700 dark:text-gray-400 text-center">
                                    <td class="p-3">{{ ucwords($author->firstname) }}</td>
                                    <td class="p-3">{{ ucwords($author->lastname) }}</td>
                                    <td class="p-3 w-auto flex flex-col md:flex-row gap-2 justify-center">
                                        <button class="btn bg-green-500 rounded p-1 font-bold text-white uppercase"
                                            wire:click="edit('{{ $author->id }}')">@lang('messages.edit')</button>
                                        <button class="btn bg-red-500 rounded p-1 font-bold text-white uppercase"
                                            wire:click="destroy('{{ $author->id }}')">@lang('messages.delete')</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    @if ($this->search === '')
                        {{ $authors->links() }}
                    @endif
                </div>
            </div>
        @endif

        @if ($createForm === true)
            <div class="p-3 rounded bg-blue-400 flex text-center place-self-center mt-5 shadow w-full md:w-2/3">
                <form action="POST" wire:submit='store' class="w-full flex flex-col gap-4">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-3 w-full"
                        style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}">
                        <div class="flex flex-col w-full">
                            <label for="firstname"
                                class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium">@lang('messages.firstname')</label>
                            <input id="firstname"
                                class="block w-full mt-2 bg-white focus:outline-none text-black rounded p-2 placeholder:uppercase"
                                placeholder="{{ __('messages.firstname') }}" wire:model.live='firstname' />
                            @error('firstname')
                                <span class="text-red-900 font-bold uppercase">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="lastname"
                                class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium">@lang('messages.lastname')</label>
                            <input id="lastname"
                                class="block w-full mt-2 bg-white focus:outline-none text-black rounded p-2 placeholder:uppercase"
                                placeholder="{{ __('messages.lastname') }}" wire:model.live='lastname' />
                            @error('lastname')
                                <span class="text-red-900 font-bold uppercase">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full flex items-center gap-3 mt-5">
                        <button type="submit"
                            class="bg-black w-full text-white rounded px-3 py-2 font-bold hover:bg-purple-700 uppercase">@lang('messages.add')</button>
                        <button
                            class="bg-yellow-300 w-full text-black rounded px-3 py-2 font-bold hover:bg-white uppercase"
                            wire:click='showTable'>@lang('messages.cancel')</button>
                    </div>

                </form>
            </div>
        @endif

        @if ($updateForm === true)
            <div class="p-3 rounded bg-blue-400 flex text-center place-self-center mt-5 shadow w-full md:w-2/3">
                <form wire:submit="update('{{ $author_id }}')" method="POST" class="w-full">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-3 w-full"
                        style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}">
                        <div class="flex flex-col w-full">
                            <label for="firstname"
                                class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} font-medium">@lang('messages.firstname')</label>
                            <input class="block w-full mt-1 bg-white focus:outline-none text-black rounded p-2"
                                placeholder="First Name" wire:model.blur='firstname' />
                            @error('firstname')
                                <span class="text-red-900 font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="lastname"
                                class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} font-medium">@lang('messages.lastname')</label>
                            <input class="block w-full mt-1 bg-white focus:outline-none text-black rounded p-2"
                                placeholder="Last Name" wire:model.blur='lastname' />
                            @error('lastname')
                                <span class="text-red-900 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center w-full gap-3 mt-5">
                        <button type="submit"
                            class="bg-black w-full text-white rounded px-3 py-2 font-bold hover:bg-purple-700 uppercase"
                            id="uptBtn">@lang('messages.update')</button>
                        <button
                            class="bg-yellow-300 w-full text-black rounded px-3 py-2 font-bold hover:bg-white uppercase"
                            wire:click='showTable'>@lang('messages.cancel')</button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <div wire:loading wire:target="showTable, addForm, edit, destroy, store, update" class="mx-auto">
        @include('includes.loader')
    </div>

</div>
