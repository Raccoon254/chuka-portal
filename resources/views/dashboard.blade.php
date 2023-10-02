<x-app-layout>

    <div class="flex h-full">

        <section class="h-full z-30 sticky">
            @include('layouts.sidebar')
        </section>

        <div class="flex-grow py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded shadow-sm">

                    <h2 class="text-xl px-6 py-4 bg-base-200 font-bold mb-4">Basic Information</h2>

                    <section class="flex items-center border-b border-gray-200 flex-col md:flex-row">
                        <div class="w-[300px] px-2">
                            <img src="{{ asset('storage/user_images/QvuwNTVS6Webd005YeZW9Ek4kxM8IlqGXGDpuN48.jpg') }}"
                                 alt="Profile Image"
                                 class="rounded h-full w-full mx-auto">
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap -mx-2">
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Reg. No:</strong> {{ $data['regNo'] }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Name:</strong> {{ $data['name'] }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>ID No:</strong> {{ $data['idNo'] }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Gender:</strong> {{ $data['gender'] }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Address:</strong> {{ $data['address'] }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Email:</strong> {{ $data['email'] }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Date Of Birth:</strong> {{ $data['dob'] }}
                                </div>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                                    <strong>Campus:</strong> {{ $data['campus']}}
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>

            <section class="flex sm:px-6 lg:px-8 flex-col items-center justify-center sm:flex-row mt-8">

                <!-- Academic Information -->
                <div class="flex flex-col w-full rounded overflow-hidden sm:mr-2 sm:w-1/2">
                    <h2 class="text-xl px-6 py-4 bg-base-200 font-bold mb-4">Academic Information</h2>
                    <div class="w-full px-2 mb-4 text-ellipsis">
                        <strong>Current
                            Programme:</strong> {{ str_replace('Bachelor of Science', 'BSc', $data['currentProgramme']) }}
                    </div>
                    <div class="w-full px-2 mb-4">
                        <strong>Attempted Units:</strong> {{ $data['attemptedUnits'] }}
                    </div>
                    <div class="w-full px-2 mb-4">
                        <strong>Registered Units:</strong> {{ $data['registeredUnits'] }}
                    </div>
                </div>

                <!-- Fee Payment -->
                <div class="flex flex-col w-full rounded overflow-hidden sm:ml-2 sm:w-1/2">
                    <h2 class="text-xl px-6 py-4 bg-base-200 font-bold mb-4">Fee Payment</h2>
                    <div class="w-full px-2 mb-4">
                        <strong>Total Billed:</strong> {{ $data['totalBilled'] }}
                    </div>
                    <div class="w-full px-2 mb-4">
                        <strong>Total Paid:</strong> {{ $data['totalPaid'] }}
                    </div>
                    <div class="w-full px-2 mb-4">
                        <strong>Fee Balance:</strong> {{ $data['feeBalance'] }}
                    </div>
                </div>

            </section>

        </div>

    </div>

</x-app-layout>
