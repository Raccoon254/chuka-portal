<x-app-layout>
    <div class="flex h-full">

        <section class="h-full z-30 sticky">
            @include('layouts.sidebar')
        </section>

        <div class="flex-grow py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded shadow-sm">

                    <h2 class="text-xl px-6 py-4 bg-gray-300 font-bold mb-4">Basic Information</h2>

                    <section class="flex items-center border-b border-gray-200 flex-col md:flex-row">
                        <div class="w-[300px] px-2">
                            <img src="{{ asset('storage/' . auth()->user()->image->image_path) }}" alt="Profile Image"
                                 class="rounded h-full w-full mx-auto">
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap -mx-2">
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Reg. No:</strong> {{ auth()->user()->reg_no }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Name:</strong> {{ auth()->user()->name }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>ID No:</strong> {{ auth()->user()->id_no }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Gender:</strong> {{ auth()->user()->gender }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Address:</strong> {{ auth()->user()->address }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Email:</strong> {{ auth()->user()->email }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Date Of Birth:</strong> {{ auth()->user()->dob->diffForHumans() }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Campus:</strong> {{ auth()->user()->campus }}
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>

            <section class="flex sm:px-6 lg:px-8 flex-col items-center justify-center sm:flex-row mt-8">

                <!-- Academic Information -->
                <div class="flex flex-col w-full rounded overflow-hidden sm:mr-2 sm:w-1/2">
                    <h2 class="text-xl px-6 py-4 bg-gray-300 font-bold mb-4">Academic Information</h2>
                    <div class="w-full px-2 mb-4">
                        <strong>Current Programme:</strong> {{ auth()->user()->current_programme ??'null' }}
                    </div>
                    <div class="w-full px-2 mb-4">
                        <strong>Attempted Units:</strong> {{ auth()->user()->attempted_units ??'null' }}
                    </div>
                    <div class="w-full px-2 mb-4">
                        <strong>Registered Units:</strong> {{ auth()->user()->registered_units ??'null' }}
                    </div>
                </div>

                <!-- Fee Payment -->
                <div class="flex flex-col w-full rounded overflow-hidden sm:ml-2 sm:w-1/2">
                    <h2 class="text-xl px-6 py-4 bg-gray-300 font-bold mb-4">Fee Payment</h2>
                    <div class="w-full px-2 mb-4">
                        <strong>Total Billed:</strong> {{ auth()->user()->total_billed ??'null' }}
                    </div>
                    <div class="w-full px-2 mb-4">
                        <strong>Total Paid:</strong> {{ auth()->user()->total_paid ??'null' }}
                    </div>
                    <div class="w-full px-2 mb-4">
                        <strong>Fee Balance:</strong> {{ auth()->user()->fee_balance ??'null' }}
                    </div>
                </div>

            </section>

        </div>


    </div>
</x-app-layout>
