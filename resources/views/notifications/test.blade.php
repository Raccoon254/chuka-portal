<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @isset($unreadNotifications)
                        <h2>Unread Notifications: {{ $unreadNotifications->count() }}</h2>
                        @foreach ($unreadNotifications as $notification)
                            <section class="flex justify-between shadow items-center mb-2">
                                <div class="p-4 mb-4 bg-blue-100 rounded">
                                    <div class="font-semibold">{{ $notification->title }}</div>
                                    <div class="text-sm">{{ $notification->message }}</div>
                                    <div class="text-xs text-gray-500">{{ $notification->created_at->format('M d, Y H:i A') }}</div>
                                </div>
                                <a class="tooltip tooltip-left mx-6" data-tip="View {{ $notification->title }}" href="{{ route('notifications.show', $notification->id) }}">
                                    <x-round-button class="z-20">{!! '<i class="fa-solid fa-mountain"></i>' !!}</x-round-button>
                                </a>
                            </section>
                        @endforeach
                    @endisset

                    @isset($readNotifications)
                        <h2>Read Notifications: {{ $readNotifications->count() }}</h2>
                        @foreach ($readNotifications as $notification)
                            <section class="flex justify-between shadow items-center mb-2">
                                <div class="p-4 mb-4 bg-gray-100 rounded">
                                    <div class="font-semibold">{{ $notification->title }}</div>
                                    <div class="text-sm">{{ $notification->message }}</div>
                                    <div class="text-xs text-gray-500">{{ $notification->created_at->format('M d, Y H:i A') }}</div>
                                </div>
                                <a class="tooltip tooltip-left mx-6" data-tip="View {{ $notification->title }}" href="{{ route('notifications.show', $notification->id) }}">
                                    <x-round-button class="z-20">{!! '<i class="fa-solid fa-mountain"></i>' !!}</x-round-button>
                                </a>
                            </section>
                        @endforeach
                    @endisset

                    @isset($allNotifications)
                        <h2>All Notifications: {{ $allNotifications->count() }}</h2>
                        @foreach ($allNotifications as $notification)
                            <section class="flex justify-between shadow items-center mb-2">
                                <div class="p-4 mb-4 bg-white rounded">
                                    <div class="font-semibold">{{ $notification->title }}</div>
                                    <div class="text-sm">{{ $notification->message }}</div>
                                    <div class="text-xs text-gray-500">{{ $notification->created_at->format('M d, Y H:i A') }}</div>
                                </div>
                                <a class="tooltip tooltip-left mx-6" data-tip="View {{ $notification->title }}" href="{{ route('notifications.show', $notification->id) }}">
                                    <x-round-button class="z-20">{!! '<i class="fa-solid fa-mountain"></i>' !!}</x-round-button>
                                </a>
                            </section>
                        @endforeach
                    @endisset

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
