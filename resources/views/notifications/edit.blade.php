<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl mb-6">Edit Notification</h1>

        <form action="{{ route('notifications.update', $notification->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block mb-2">Title</label>
                <input type="text" id="title" name="title" placeholder="Type here" value="{{ $notification->title }}" required class="input input-bordered input-primary w-full max-w-xs" />
            </div>

            <div class="mb-4">
                <label for="message" class="block mb-2">Message</label>
                <textarea id="message" name="message" class="textarea textarea-secondary w-full h-48" required>{{ $notification->message }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Send To</label>
                <div class="flex items-start space-x-4">
                    <label class="flex items-center">
                        <input type="checkbox" id="select-all" class="mr-2">
                        Select All
                    </label>
                    @foreach($users as $user)
                        <label class="flex items-center">
                            <input type="checkbox" name="to[]" value="{{ $user->id }}" class="mr-2" {{ in_array($user->id, $notification->to) ? 'checked' : '' }}>
                            {{ $user->name }}
                        </label>
                    @endforeach
                </div>
            </div>


            <div class="tooltip" data-tip="Save Data">
                <x-round-button type="submit">{!! '<i class="fa-solid fa-sd-card"></i>' !!}</x-round-button>
            </div>
        </form>
    </div>
</x-app-layout>
