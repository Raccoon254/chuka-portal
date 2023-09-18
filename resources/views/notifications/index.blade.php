<x-app-layout>
    <div class="container flex w-full">

        <section class="z-50">
            @include('admin.sidebar')
        </section>

       <div class="w-full sm:px-2">

           <div class="mb-2 sm:mb-6 p-1 sm:p-6 w-full">
               <a class="tooltip float-right" data-tip="Create a new notification"  href="{{ route('notifications.create') }}">
                   <x-round-button class="hover:bg-base-100" >{!! '<i class="fa-solid fa-plus"></i>' !!}</x-round-button>
               </a>
           </div>

           <!--Check if there are any notifications-->
           @if($notifications->isEmpty())
               <div class="alert rounded mt-3 alert-warning">
                   There are no notifications.
               </div>
              @else
               @foreach($notifications as $notification)
                   <div class="p-1 sm:p-6 shadow bordered border-base-100 rounded mb-4">
                       <h2 class="text-2xl mb-2">{{ $notification->title }}</h2>

                       <div class="block mb-4 sm:hidden">
                           <p>{{ \Illuminate\Support\Str::words($notification->message, 40) }}</p>
                       </div>
                       <div class="hidden sm:block">
                           <p>{{ $notification->message }}</p>
                       </div>

                       <div class="mt-4 z-20 w-full justify-end flex gap-4">

                           <a class="tooltip z-20" data-tip="View {{ $notification->title }}" href="{{ route('notifications.show', $notification->id) }}">
                               <x-round-button class="z-20" >{!! '<i class="fa-solid fa-mountain"></i>' !!}</x-round-button>
                           </a>

                           <a class="tooltip z-20" data-tip="Edit {{ $notification->title }}"  href="{{ route('notifications.edit', $notification->id) }}">
                               <x-round-button >{!! '<i class="fa-solid fa-gear"></i>' !!}</x-round-button>
                           </a>

                           <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="tooltip z-20" data-tip="Delete {{ $notification->title }}">
                               @csrf
                               @method('DELETE')
                               <x-round-button class="z-20" type="submit">{!! '<i class="fa-solid fa-trash"></i>' !!}</x-round-button>
                           </form>


                       </div>

                   </div>
               @endforeach

              @endif
       </div>
    </div>
</x-app-layout>
