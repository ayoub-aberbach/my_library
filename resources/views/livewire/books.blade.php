<div class="container py-3 flex flex-col">
    <x-slot name="title">{{ __('messages.books') }}</x-slot>
    @if ($tableShow)
        <div
            class="w-auto flex flex-col md:flex-row items-center justify-between py-3 px-2 my-5 font-bold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none">
            <div class="flex items-center mb-2 md:mb-0 uppercase">
                <span wire:poll>{{ __('messages.books') . ' (' . $books_count . ')' }}</span>
            </div>
            <button
                class="px-3 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:text-black hover:bg-white focus:outline-none border-white border-2 uppercase"
                wire:click="addForm">
                @lang('messages.add_book')
            </button>
        </div>
    @endif
    <div class="container grid w-full px-6 mx-auto animate-[slidebottom_.7s_linear_both]">
        @if ($this->tableShow === true)
            <div class="w-full mt-5 flex flex-col items-center justify-center overflow-hidden">
                <div class="flex flex-col md:flex-row w-full mx-auto md:me-auto gap-4 mb-7">
                    <div class="flex items-center w-full md:w-1/3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                            style="fill: #000;" class="bg-slate-300 rounded-l p-1">
                            <path
                                d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z">
                            </path>
                        </svg>
                        <input style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                            class="block w-full focus:outline-none text-black rounded-r p-2 placeholder:text-black {{ $searchAuthor !== '' ? 'bg-gray-900' : 'bg-slate-300' }}"
                            placeholder="{{ __('messages.book_search') }} ..." wire:model.live='searchBook'
                            type="text" {{ $searchAuthor !== '' ? 'disabled' : '' }} />
                    </div>

                    <div class="flex items-center w-full md:w-1/3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                            style="fill: #000;" class="bg-slate-300 rounded-l p-1">
                            <path
                                d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z">
                            </path>
                        </svg>
                        <input style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                            class="block w-full focus:outline-none text-black rounded-r p-2 placeholder:text-black {{ $searchBook !== '' ? 'bg-gray-900' : 'bg-slate-300' }}"
                            placeholder="{{ __('messages.author_search') }} ..." wire:model.live='searchAuthor'
                            type="text" {{ $searchBook !== '' ? 'disabled' : '' }} />
                    </div>
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="table-auto w-full rounded border border-2 border-blue-500 mb-2">
                        <thead>
                            <tr class="tracking-wide text-center text-white uppercase border-b bg-gray-800">
                                <th class="p-3 text-sm font-medium">@lang('messages.title')</th>
                                <th class="p-3 text-sm font-medium">@lang('messages.page_count')</th>
                                <th class="p-3 text-sm font-medium">@lang('messages.pub_date')</th>
                                <th class="p-3 text-sm font-medium">@lang('messages.author_name')</th>
                                <th class="p-3 text-sm font-medium">@lang('messages.options')</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($books as $book)
                                <tr class="text-gray-700 dark:text-gray-400 text-center">
                                    <td class="p-3">{{ ucwords($book->title) }}</td>
                                    <td class="p-3">{{ ucwords($book->page_count) }}</td>
                                    <td class="p-3">{{ ucwords($book->publish_date) }}</td>
                                    <td class="p-3 text-blue-700">
                                        <p class="rounded-lg bg-slate-200 p-1">
                                            {{ ucwords($book->author->firstname . ' ' . ucwords($book->author->lastname)) }}
                                        </p>
                                    </td>
                                    <td class="p-3 w-auto flex flex-col md:flex-row gap-2 justify-center">
                                        <button class="btn bg-green-500 rounded p-1 font-bold text-white uppercase"
                                            wire:click="edit('{{ $book->id }}')">@lang('messages.edit')</button>
                                        <button class="btn bg-red-500 rounded p-1 font-bold text-white uppercase"
                                            wire:click="destroy('{{ $book->id }}')"
                                            wire:confirm="Confirm">@lang('messages.delete')</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    @if ($this->searchBook === '' && $this->searchAuthor === '')
                        {{ $books->links() }}
                    @endif
                </div>
            </div>
        @endif

        @if ($this->createForm === true)
            <div class="p-3 rounded bg-blue-400 flex text-center place-self-center mt-5 shadow w-full md:w-2/3">
                <form action="POST" wire:submit='store' class="w-full flex flex-col gap-5">
                    @csrf
                    <div class="flex flex-col gap-3 w-full">
                        <div class="flex flex-col md:flex-row gap-3 w-full">
                            <div class="flex flex-col w-full">
                                <label for="title"
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium">@lang('messages.title')</label>
                                <input id="title"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    class="block w-full mt-1 bg-white focus:outline-none text-black rounded p-2 placeholder:uppercase"
                                    placeholder="{{ __('messages.title') }}" wire:model.live='title' />
                                @error('title')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col w-full">
                                <label for="page_count"
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium">@lang('messages.page_count')</label>
                                <input id="page_count"
                                    class="block w-full mt-1 focus:outline-none rounded p-2 placeholder:uppercase"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    placeholder="{{ __('messages.page_count') }}" wire:model.live='page_count' />
                                @error('page_count')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="author"
                                class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium">@lang('messages.author_name')</label>
                            <select id="author" class="block w-full mt-1 focus:outline-none rounded p-2 uppercase"
                                style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                wire:model.live='author_id'>
                                <option selected value="">@lang('messages.select_author')</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}">
                                        {{ $author->firstname . ' ' . $author->lastname }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <span class="text-red-900 font-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="date"
                                class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium">@lang('messages.pub_date')</label>
                            <input id="date"
                                style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                class="block w-full mt-1 bg-white focus:outline-none text-black rounded p-2"
                                placeholder="{{ __('messages.title') }}" type="date"
                                wire:model.live='publish_date' />
                            @error('publish_date')
                                <span class="text-red-900 font-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full flex items-center gap-3">
                        <button type="submit"
                            class="bg-black w-full text-white rounded px-3 py-2 font-bold hover:bg-purple-700">@lang('messages.add')</button>
                        <button class="bg-yellow-300 text-black w-full rounded px-3 py-2 font-bold hover:bg-white"
                            wire:click='showTable'>@lang('messages.cancel')</button>
                    </div>

                </form>
            </div>
        @endif

        @if ($this->updateForm === true)
            <div class="p-3 rounded bg-blue-400 flex text-center place-self-center mt-5 shadow w-full md:w-2/3">
                <form wire:submit="update('{{ $book_id }}')" class="w-full">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-3 w-full">
                        <div class="flex flex-col w-full gap-3">
                            <div class="w-full flex flex-col">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="title">@lang('messages.title')</label>
                                <input
                                    class="block w-full mt-1 bg-white focus:outline-none text-black rounded p-2 placeholder:uppercase"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    placeholder="{{ __('messages.title') }}" wire:model.blur='title' />
                                @error('title')
                                    <span class="text-red-900 font-bold ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full flex flex-col">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="page_count">@lang('messages.page_count')</label>
                                <input
                                    class="block w-full mt-1 bg-white focus:outline-none text-black rounded p-2 placeholder:uppercase"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    placeholder="{{ __('messages.page_count') }}" wire:model.blur='page_count' />
                                @error('page_count')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 w-full">
                            <div class="w-full flex flex-col">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="author">@lang('messages.author_name')</label>
                                <select class="block w-full mt-1 focus:outline-none rounded p-2"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    wire:model.blur='author_id'>
                                    @foreach ($authors as $author)
                                        @if ($author->id === $author_id)
                                            <option value="{{ $author->id }}" selected> {{ $author->firstname }}
                                            </option>
                                        @else
                                            <option value="{{ $author->id }} "> {{ $author->firstname }} </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full flex flex-col">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="date">@lang('messages.pub_date')</label>
                                <input
                                    class="block w-full mt-1 bg-white focus:outline-none text-black rounded p-2 placeholder:uppercase"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    placeholder="{{ __('messages.pub_date') }}" type="date"
                                    wire:model.blur='publish_date' />
                                @error('publish_date')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex gap-3 items-center mt-3">
                        <button type="submit"
                            class="bg-black text-white w-full rounded px-3 py-2 font-bold hover:bg-purple-700 uppercase">@lang('messages.update')</button>
                        <button wire:click='showTable'
                            class="bg-yellow-300 text-black rounded px-3 py-2 font-bold hover:bg-white w-full uppercase">@lang('messages.cancel')</button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <div wire:loading wire:target="showTable, addForm, edit, destroy, store, update" class="mx-auto">
        @include('includes.loader')
    </div>
</div>
