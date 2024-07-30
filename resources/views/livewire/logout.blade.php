<div>
    <a href="/" wire:click.prevent='logout'
        class="flex py-2 px-4 sm:py-2 lg:px-3 rounded text-white hover:text-red-500 hover:bg-black font-medium bg-red-500 uppercase">
        <span wire:loading.remove>@lang('messages.logout')</span>
        <div wire:loading wire:target="logout">
            <div class="flex items-center justify-center h-6 w-6 animate-spin rounded-full border-4 border-solid border-current border-e-transparent text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] text-white m-auto"
                role="status">
                <span
                    class="!absolute mx-auto !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...
                </span>
            </div>
        </div>
    </a>
</div>
