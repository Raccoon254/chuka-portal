<x-app-layout>
    <div class="flex">

        <section class="h-full z-30 sticky">
            @include('layouts.sidebar')
        </section>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</x-app-layout>
