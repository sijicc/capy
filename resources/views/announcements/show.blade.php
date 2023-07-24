<x-auth-layout>
    <x-card>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ $announcement->title }}
            </h2>
            {{ $announcement->created_at->format("Y-m-d H:i:s") }}
            <a href="{{ route("users.show", $announcement->user) }}" class="text-primary-500 hover:underline">
                {{ $announcement->user->name }}
            </a>
        </x-slot>

        <div class="mt-4">
            <p class="text-gray-600">
                {!! $announcement->content !!}
            </p>
        </div>
    </x-card>
</x-auth-layout>
