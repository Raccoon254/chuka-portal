<x-app-layout>
    <div class="container mx-auto p-6">

        <h1 class="text-3xl mb-6">{{ $notification->title }}</h1>
        <p>{{ $notification->message }}</p>

            <form action="{{ route('notifications.markAsUnread', $notification->id) }}" method="POST">
                @csrf
                <x-round-button type="submit" class="tooltip tooltip-right" data-tip="Mark as Unread">
                    {!! '<i class="fa-solid fa-envelope-open"></i>' !!}
                </x-round-button>
            </form>

        @can('manage-products')
            <div class="mt-6">
                <a class="tooltip" data-tip="Edit {{ $notification->title }}"  href="{{ route('notifications.edit', $notification->id) }}">
                    <x-round-button >{!! '<i class="fa-solid fa-gear"></i>' !!}</x-round-button>
                </a>
            </div>

            <div class="mt-6">
                <h2 class="text-2xl mb-6">Sent To</h2>
                <div class="grid grid-cols-1 gap-4">
                    @foreach($users as $user)
                        <div class="bg-white shadow-md p-4 rounded-lg flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="text-lg font-medium">{{ $user->name }}</div>
                            </div>
                            <div class="text-gray-500">{{ $user->email }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endcan
    </div>
</x-app-layout>
