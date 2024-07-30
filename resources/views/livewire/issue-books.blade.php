<div class="container py-3 flex flex-col">
    <x-slot name="title">{{ __('messages.rented_books') }}</x-slot>
    @if ($tableShow)
        <div
            class="w-auto flex flex-col md:flex-row items-center justify-between py-3 px-2 my-5 font-bold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none">
            <div class="flex items-center mb-2 md:mb-0 uppercase">
                <span>{{ __('messages.rented_books') . ' (' . $issuedBooks_count . ')' }}</span>
            </div>
            <button
                class="px-3 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:text-black hover:bg-white focus:outline-none border-white border-2 uppercase"
                wire:click="addForm">@lang('messages.check_book')
            </button>
        </div>
    @endif
    <div class="container grid w-full px-6 mx-auto animate-[slidebottom_.7s_linear_both]">
        @if ($this->tableShow)
            <div class="w-full mt-5 flex flex-col items-center md:justify-center overflow-hidden">
                <h2 class="text-center mx-auto uppercase w-full rounded p-1 text-white mb-2 bg-black">@lang('messages.filtering')
                </h2>
                <div class="flex flex-col justify-center items-center gap-3 w-full mb-5">
                    <div class="flex flex-wrap md:flex-nowrap items-center justify-center gap-2 w-full">
                        <div class="bg-slate-200 rounded flex justify-between items-center w-full p-2">
                            <label for="start_date"
                                class="w-full uppercase {{ session()->get('locale') === 'en' ? '' : 'order-2 text-right' }}">@lang('messages.start_date')</label>
                            <input id="start_date" type="date" wire:model.live='fromDate'
                                class="block w-full bg-blue-200 rounded px-2 py-1 focus:outline-none {{ session()->get('locale') === 'en' ? '' : 'order-1' }}"
                                placeholder="Search for author..." />
                        </div>
                        <button
                            class="block w-auto shadow bg-blue-300 hover:bg-gray-200 font-bold focus:outline-none rounded-full p-2"
                            wire:click='clearFilter'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                <path d="M12 16c1.671 0 3-1.331 3-3s-1.329-3-3-3-3 1.331-3 3 1.329 3 3 3z"></path>
                                <path
                                    d="M20.817 11.186a8.94 8.94 0 0 0-1.355-3.219 9.053 9.053 0 0 0-2.43-2.43 8.95 8.95 0 0 0-3.219-1.355 9.028 9.028 0 0 0-1.838-.18V2L8 5l3.975 3V6.002c.484-.002.968.044 1.435.14a6.961 6.961 0 0 1 2.502 1.053 7.005 7.005 0 0 1 1.892 1.892A6.967 6.967 0 0 1 19 13a7.032 7.032 0 0 1-.55 2.725 7.11 7.11 0 0 1-.644 1.188 7.2 7.2 0 0 1-.858 1.039 7.028 7.028 0 0 1-3.536 1.907 7.13 7.13 0 0 1-2.822 0 6.961 6.961 0 0 1-2.503-1.054 7.002 7.002 0 0 1-1.89-1.89A6.996 6.996 0 0 1 5 13H3a9.02 9.02 0 0 0 1.539 5.034 9.096 9.096 0 0 0 2.428 2.428A8.95 8.95 0 0 0 12 22a9.09 9.09 0 0 0 1.814-.183 9.014 9.014 0 0 0 3.218-1.355 8.886 8.886 0 0 0 1.331-1.099 9.228 9.228 0 0 0 1.1-1.332A8.952 8.952 0 0 0 21 13a9.09 9.09 0 0 0-.183-1.814z">
                                </path>
                            </svg>
                        </button>
                        <div class="bg-slate-200 rounded flex items-center w-full p-2">
                            <label for="end_date"
                                class="w-full uppercase {{ session()->get('locale') === 'en' ? '' : 'order-2 text-right' }}">@lang('messages.end_date')</label>
                            <input id="end_date" type="date" wire:model.live='toDate'
                                class="block w-full bg-blue-200 rounded px-2 py-1 focus:outline-none {{ session()->get('locale') === 'en' ? '' : 'order-1' }}"
                                placeholder="Search for author..." />
                        </div>
                    </div>
                    <hr class="flex w-full border-black">
                    <div class="mb-3 w-full md:w-auto {{ session()->get('locale') === 'en' ? 'me-auto' : 'ms-auto' }}">
                        <select class="block w-full shadow bg-slate-200 focus:outline-none rounded p-2 uppercase"
                            wire:model.live='book_id'>
                            <option selected value="">@lang('messages.book_records')</option>
                            @foreach ($all_books as $book)
                                <option value="{{ $book->id }} "> {{ $book->title }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="table-auto w-full rounded border border-2 border-blue-500 mb-2">
                        <thead>
                            <tr class="tracking-wide text-center text-white uppercase border-b bg-gray-800">
                                <th class="p-3 uppercase text-sm">@lang('messages.title')</th>
                                <th class="p-3 uppercase text-sm">@lang('messages.author_name')</th>
                                <th class="p-3 uppercase text-sm">@lang('messages.client')</th>
                                <th class="p-3 uppercase text-sm">@lang('messages.start_date')</th>
                                <th class="p-3 uppercase text-sm">@lang('messages.end_date')</th>
                                <th class="p-3 uppercase text-sm">@lang('messages.options')</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($issueBooks as $issueBook)
                                <tr class="text-gray-700 dark:text-gray-400 text-center">
                                    <td class="p-3">
                                        {{ ucwords($issueBook->book->title) }}
                                    </td>
                                    <td class="p-3">
                                        {{ ucwords($issueBook->book->author->firstname) . ' ' . ucwords($issueBook->book->author->lastname) }}
                                    </td>
                                    <td class="p-3">{{ ucwords($issueBook->client) }}</td>
                                    <td class="p-3">{{ ucwords($issueBook->issue_date) }}</td>
                                    <td class="p-3">
                                        {{ $issueBook->return_date === '' || $issueBook->return_date === null ? '---' : ucwords($issueBook->return_date) }}
                                    </td>
                                    <td class="p-3 w-auto flex flex-col md:flex-row gap-2 justify-center">
                                        <button class="btn bg-green-500 rounded p-1 font-bold text-white uppercase"
                                            wire:click="edit('{{ $issueBook->id }}')">@lang('messages.edit')</button>
                                        <button class="btn bg-red-500 rounded p-1 font-bold text-white uppercase"
                                            wire:click="destroy('{{ $issueBook->id }}')"
                                            wire:confirm="Confirm">@lang('messages.delete')</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    @if ($this->fromDate === '' && $this->toDate === '' && $this->book_id === '')
                        {{ $issueBooks->links() }}
                    @endif
                </div>
            </div>
        @endif

        @if ($this->createForm === true)
            <div class="p-3 rounded bg-blue-400 flex text-center place-self-center mt-5 shadow w-full md:w-2/3">
                <form action="POST" wire:submit='store' class="flex flex-col w-full">
                    @csrf
                    <div class="flex flex-col items-center gap-3 w-full">
                        <div class="flex flex-col gap-3 items-center w-full">
                            <div class="flex flex-col w-full">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="">@lang('messages.select_book')</label>
                                <select class="rounded mt-2 p-2 w-full bg-white focus:outline-none text-black"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    wire:model.live='book_id'>
                                    <option selected>@lang('messages.select_book')</option>
                                    @foreach ($all_books as $book)
                                        <option value="{{ $book->id }} "> {{ $book->title }} </option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col w-full">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="client">@lang('messages.client')</label>
                                <input class="block mt-2 w-full bg-white focus:outline-none text-black rounded p-2"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    placeholder="{{ __('messages.client') }}" type="text" wire:model.live='client'
                                    id="client" />
                                @error('client')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row gap-3 w-full">
                            <div class="flex flex-col w-full">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="start">@lang('messages.start_date')</label>
                                <input class="block w-full mt-2 bg-white focus:outline-none text-black rounded p-2"
                                    id="start"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    placeholder="{{ __('messages.start_date') }}" type="date"
                                    wire:model.live='issue_date' />
                                @error('issue_date')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col w-full">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="end">@lang('messages.end_date') -
                                    @lang('messages.optional')
                                </label>
                                <input class="block w-full mt-2 bg-white focus:outline-none text-black rounded p-2"
                                    id="end"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    placeholder="{{ __('messages.end_date') }}" type="date"
                                    wire:model.live='return_date' />
                                @error('return_date')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="w-full mt-5 flex items-center gap-3">
                        <button type="submit"
                            class="bg-black w-full text-white rounded px-3 py-2 font-bold hover:bg-purple-700v uppercase">
                            @lang('messages.add')
                        </button>
                        <button
                            class="bg-yellow-300 w-full text-black rounded px-3 py-2 font-bold hover:bg-white uppercase"
                            wire:click='showTable'>@lang('messages.cancel')</button>
                    </div>
                </form>
            </div>
        @endif

        @if ($this->updateForm === true)
            <div class="p-3 rounded bg-blue-400 flex text-center place-self-center mt-5 shadow w-full md:w-2/3">
                <form wire:submit="update('{{ $issuedBook_id }}')" class="w-full flex flex-col">
                    @csrf
                    <div class="flex flex-col items-center gap-3 w-full">
                        <div class="flex flex-col w-full">
                            <label
                                class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                for="book">@lang('messages.book')</label>
                            <select id="book"
                                class="w-full rounded mt-1 p-2 bg-gray-700 focus:outline-none text-white"
                                style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                wire:model.blur='book_id' disabled>
                                @foreach ($all_books as $book)
                                    @if ($book->id === $book_id)
                                        <option value="{{ $book->id }} " selected> {{ $book->title }}
                                        </option>
                                    @else
                                        <option value="{{ $book->id }} "> {{ $book->title }} </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('book_id')
                                <span class="text-red-900 font-bold">{{ $message }}</span>
                            @enderror
                            <div class="flex flex-col w-full mt-4">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="client">@lang('messages.client')</label>
                                <input class="block w-full mt-1 bg-gray-700 focus:outline-none text-white rounded p-2"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    placeholder="Client name" id="client" type="text" wire:model.blur='client'
                                    disabled />
                                @error('client')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row gap-3 w-full">
                            <div class="flex flex-col w-full">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="start">@lang('messages.start_date')</label>
                                <input id="start"
                                    class="block w-full mt-1 bg-gray-700 focus:outline-none text-white rounded p-2"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    placeholder="Issue Date" type="date" wire:model.blur='issue_date' disabled />
                                @error('issue_date')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col w-full">
                                <label
                                    class="{{ session()->get('locale') === 'en' ? 'text-left' : 'text-right' }} uppercase font-medium"
                                    for="end">@lang('messages.end_date')</label>
                                <input id="end"
                                    class="block w-full mt-1 bg-white focus:outline-none text-black rounded p-2"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}"
                                    placeholder="Return Date" type="date" wire:model.live='return_date' />
                                @error('return_date')
                                    <span class="text-red-900 font-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex items-center gap-3 mt-5">
                        <button type="submit"
                            class="bg-black w-full text-white rounded px-3 py-2 font-bold hover:bg-purple-700 uppercase">@lang('messages.update')</button>
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
