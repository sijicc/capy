<button
    id="notifications-bell"
    type="button"
    x-data="{
        onClick() {
            this.shouldPing = false
            this.$dispatch('open-modal', { id: 'database-notifications' })
        },
        shouldPing: false,
    }"
    x-on:click="onClick()"
    x-on:new-notification.window="shouldPing = true"
>
    @svg('heroicon-s-bell', 'h-6 w-6 text-gray-500 transition-colors duration-150 hover:text-gray-800')
    <span
        x-cloak
        :class="{ 'hidden': !shouldPing }"
        class="absolute right-5 top-3 inline-flex animate-ping items-center justify-center rounded-full bg-primary-600 px-1 py-1 text-xs font-bold leading-none text-red-100"
    />
</button>
