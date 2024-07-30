<div class="container">
    <x-slot name="title">{{ __('messages.dashboard') }}</x-slot>
    <div class="grid mt-5 px-6 mx-auto animate-[slidebottom_.7s_linear_both]">
        <h1
            class="text-center text-white font-bold font-4xl bg-blue-500 w-48 my-2 rounded p-3 mb-5 mx-auto uppercase">
            @lang('messages.dashboard')
        </h1>
        <div class="w-full min-w-full max-w-full mb-8 overflow-hidden rounded-lg">
            <div class="w-full max-w-full min-w-full overflow-x-auto">
                <table class="w-full min-w-full max-w-full table-auto">
                    <thead>
                        <tr>
                            <td colspan="5"
                                class="text-center w-full font-bold font-2xl p-2 bg-green-500 rounded-top uppercase overflow-x-auto max-w-full">
                                @lang('messages.latest_rented')</td>
                        </tr>
                        <tr class="tracking-wide text-center text-white uppercase border-b bg-gray-800">
                            <th class="px-4 py-3 uppercase text-sm">@lang('messages.book')</th>
                            <th class="px-4 py-3 uppercase text-sm">@lang('messages.page_count')</th>
                            <th class="px-4 py-3 uppercase text-sm">@lang('messages.author_name')</th>
                            <th class="px-4 py-3 uppercase text-sm">@lang('messages.start_date')</th>
                            <th class="px-4 py-3 uppercase text-sm">@lang('messages.client')</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @if (count($latests) < 1)
                            <tr class="text-center">
                                <td colspan="5" class="px-4 py-3 text-white font-bold"
                                    style="direction: {{ session()->get('locale') === 'ar' ? 'rtl' : '' }}">
                                    @lang('messages.no_rented_books')
                                </td>
                            </tr>
                        @else
                            @foreach ($latests as $issue)
                                <tr class="text-gray-700 text-center">
                                    <td class="px-4 py-3 text-sm w-auto">
                                        <p
                                            class="px-3 py-1 text-sm font-bold text-black py-2 text-center break-normal bg-white leading-tight rounded-full">
                                            {{ $issue->book->title }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm w-auto">
                                        <p
                                            class="px-3 py-1 text-sm font-bold text-black py-2 text-center break-normal bg-white leading-tight rounded-full">
                                            {{ $issue->book->page_count }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm w-auto">
                                        <p
                                            class="px-3 py-1 text-sm font-bold text-black py-2 text-center break-normal bg-white leading-tight rounded-full">
                                            {{ ucwords($issue->book->author->firstname) . ' ' . ucwords($issue->book->author->lastname) }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm w-auto">
                                        <p
                                            class="px-3 py-1 text-sm font-bold text-black py-2 text-center break-normal bg-white leading-tight rounded-full">
                                            {{ date($issue->issue_date) }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm w-auto">
                                        <p
                                            class="px-3 py-1 text-sm font-bold text-black py-2 text-center break-normal bg-white leading-tight rounded-full">
                                            {{ ucwords($issue->client) }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
