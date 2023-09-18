<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewNotification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $notifications = Notification::all();

        return view('notifications.index', compact('notifications'));
    }

    public function test(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();

        $unreadNotifications = $user->unreadNotifications();
        $readNotifications = $user->readNotifications();
        $allNotifications = $user->allNotifications();

        return view('notifications.test', compact('unreadNotifications', 'readNotifications', 'allNotifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();
        return view('notifications.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'to' => 'required|array',
        ]);

        //check if the notification exists
        $notification = Notification::where('title', $validatedData['title'])->first();
        if ($notification) {
            return redirect()->route('notifications.index')->with('error', 'Notification already exists.');
        }

        $totalUsers = count($validatedData['to']);

        // Create the notification
        $notification = Notification::create([
            'user_id' => Auth::id(),
            'title' => $validatedData['title'],
            'message' => $validatedData['message'],
            'to' => $validatedData['to'],
            'read_by' => [],
            'total_users' => $totalUsers,
        ]);

        // Send email notifications to selected users
        $users = User::whereIn('id', $validatedData['to'])->get();
        foreach ($users as $user) {
            $user->notify(new NewNotification($notification));
        }

        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $notification = Notification::findOrFail($id);

        $userId = auth()->user()->id;
        $userReadBy = $notification->read_by ?? [];

        if (!in_array($userId, $userReadBy)) {
            $userReadBy[] = $userId;
            $notification->read_by = $userReadBy;
            $notification->save();
        }

        $userIds = $notification->to;
        $users = User::whereIn('id', $userIds)->get();
        return view('notifications.show', compact('notification', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $notification = Notification::findOrFail($id);
        $users = User::all();
        return view('notifications.edit', compact('notification', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $notification = Notification::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'to' => 'required|array',
        ]);

        $notification->update([
            'title' => $validatedData['title'],
            'message' => $validatedData['message'],
            'to' => $validatedData['to'],
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }

    public function markAsRead(Notification $notification): RedirectResponse
    {
        //TODO! mark as read

        return redirect()->route('notifications.show', $notification);
    }

    public function forUser(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $notifications = $user->allNotifications();
        $allNotifications = $notifications->sortByDesc('created_at');
        return view('notifications.user', compact('allNotifications'));
    }

    public function markAsUnread(Notification $notification): RedirectResponse
    {
        $userId = Auth::id();

        $readBy = $notification->read_by ?? [];
        if (in_array($userId, $readBy)) {
            $key = array_search($userId, $readBy);
            unset($readBy[$key]);
            $notification->read_by = $readBy;
            $notification->save();
        }

        return redirect()->route('notifications.user')->with('success', 'Notification marked as unread.');
    }
}
