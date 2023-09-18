<x-app-layout>
    <div class="flex">

        <section class="h-full z-30 sticky">
            @include('layouts.sidebar')
        </section>

        <section class="px-4 py-6 w-full">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-xs sm:rounded-lg">
                        <div class="p-6">

                            @isset($allNotifications)
                                @if($allNotifications->count() == 0)
                                    <center class="font-semibold text-2xl">No Notifications</center>
                                @else
                                    <center class="font-semibold text-2xl">All
                                        Notifications: {{ $allNotifications->count() }}</center>
                                    @foreach ($allNotifications as $notification)
                                        <section
                                            class="flex justify-between shadow items-center border-b border-gray-200 mb-2 {{ $notification->isReadByUser(Auth::id()) ? 'border-orange-600' : '' }}">
                                            <div class="px-4 pt-4 mb-4">
                                                <div
                                                    class="font-semibold uppercase text-xl">{{ $notification->title }}</div>
                                                <div class="text-sm">{{ $notification->message }}</div>
                                                <section class="flex items-center mt-3 gap-3">
                                                    <div
                                                        class="text-xs italic badge {{ $notification->isReadByUser(Auth::id()) ? 'badge-warning' : 'badge-error' }}">
                                                        {{ $notification->isReadByUser(Auth::id()) ? 'Read' : 'Unread' }}
                                                    </div>
                                                    <div
                                                        class="text-xs badge text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                                                </section>
                                            </div>

                                            <a class="tooltip tooltip-left mx-6"
                                               data-tip="View {{ $notification->title }}"
                                               href="{{ route('notifications.show', $notification->id) }}">
                                                <x-round-button
                                                    class="z-20 {{ $notification->isReadByUser(Auth::id()) ? 'ring-orange-600 btn-primary' : '' }}">{!! '<i class="fa-solid fa-mountain"></i>' !!}</x-round-button>
                                            </a>
                                        </section>
                                    @endforeach
                                @endempty
                            @endisset

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="h-full z-30 sticky">
            @include('layouts.stabilizer-sidebar')
        </section>
    </div>
</x-app-layout>
