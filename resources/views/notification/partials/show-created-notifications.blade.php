<section>
<header class="flex justify-between items-center mb-4">
    <div>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Notifications List') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Notifications list created by me.") }}
        </p>
    </div>

    <!-- Button to redirect to notification.add page -->
    <x-primary-button>
        <a href="{{ route('notification.add') }}">
            Add Notification
        </a>
    </x-primary-button>
</header>

    <body>
        <!-- Check if there are any notifications -->
        @if ($myNotifications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Short Text</th>
                                <th>Created By</th>
                                
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myNotifications as $notification)
                                <tr>
                                    <td>{{ $notification->type }}</td>
                                    <td>{{ $notification->short_text }}</td>
                                    <td>{{ $notification->creator->name }}</td>
                                    
                                    <td>{{ $notification->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">No notification found.</p>
            @endif
</body>

</section>
