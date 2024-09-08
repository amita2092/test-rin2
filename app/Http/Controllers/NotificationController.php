<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreNotificationRequest;

class NotificationController extends Controller
{
    // Display a listing of notifications.
    public function index(Request $request)
    {
        $userId = Auth::id();
        $myNotifications = Notification::where('created_by', $userId)->get();

        
        return view('notification.index', compact('myNotifications'));
    }

    // Display a listing of notifications.
    public function add(Request $request)
    {
        $userId = Auth::id();
        $users = User::where('id', '!=', $userId)->get();
        return view('notification.add', compact('users'));
    }

    public function store(StoreNotificationRequest $request)
    {
        $userId = Auth::id();
        $expirationDays = $request->input('expiration');
        $expirationDate = now()->addDays($expirationDays);
        // Get the list of user IDs from the request
        $selectedUserIds = $request->input('users', []); // Default to empty array if no users are selected
        if(empty($selectedUserIds)) {
            // Redirect or return response as needed
            return redirect()->route('notification.add')->with('error', 'Please select at least one user to notify.');
        }
        // Iterate through each selected user ID
        foreach ($selectedUserIds as $userIdToNotify) {
            // Create a new notification record for each user
            Notification::create(array_merge(
                $request->validated(),
                [
                    'created_by' => $userId, // ID of the user creating the notification
                    'user_id' => $userIdToNotify, // ID of the user to be notified
                    'expiration' => $expirationDate,
                ]
            ));
        }

       // Redirect or return response as needed
       return 
       redirect()->route('notification.index')->with('status', 'Notification created successfully!');
    }

    public function show(Request $request)
    {
        $userId = Auth::id();
        $myNotifications = Notification::where('user_id', $userId)->where('read', '0')->get();

        
        return view('notification.show', compact('myNotifications'));

    }
    
    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);

        if ($notification) {
            $notification->read = 1;
            $notification->save(); // Use save() to persist the changes

            $unreadCount = Notification::where('user_id', Auth::id())->where('read', false)->count();
            return response()->json(['success' => true, 'unreadCount' => $unreadCount]);
        } else {
            return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
        }
    }

    /**
     * Get the unread notifications count for the authenticated user.
     */
    public function getUnreadCount()
    {
        if (Auth::check()) {
            $unreadCount = Notification::where('user_id', Auth::id())->where('read', false)->count();
            return response()->json(['count' => $unreadCount]);
        }

        return response()->json(['count' => 0]);
    }
}
