<style>

    .unread-notification
    {
        margin: 20px;
        background-color: #f1f1f1;
        padding:20px;
    }
    .read-notification
    {
        margin: 20px;
        border: '1px solid #f1f1f1';
        padding:20px;
    }
</style>

<section>
<header class="flex justify-between items-center mb-4">
    <div>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Notifications List') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Notifications list sent to me.") }}
        </p>
    </div>

   
</header>

    <body>
        <!-- Check if there are any notifications -->
        @if ($myNotifications->count() > 0)
            @foreach ($myNotifications as $notification)
                @php
                    // 1. Get current DateTime and timestamp
                    $currentDateTime = new DateTime();
                    $currentTimestamp = $currentDateTime->getTimestamp();

                    // 2. Convert a specific DateTime to timestamp
                    $dateTime = new DateTime($notification->expiration);
                    $expirationTimestamp = $dateTime->getTimestamp();
                @endphp

                @if($expirationTimestamp > $currentTimestamp)
                    <div class="unread-notification" data-notification-id="{{ $notification->id }}" onclick="markAsRead(this)">
                        <h2 class="text-lg font-medium text-gray-900">{{ ucfirst($notification->type) }}</h2>
                        <p>{{ $notification->short_text }}</p>
                    </div>
                @endif
            @endforeach
                
                </div>
            @else
                <p class="text-center">No notification found.</p>
            @endif
</body>
<script type="text/javascript">

        function markAsRead(element) {
            var notificationId = $(element).data('notification-id');
            
            $.ajax({
                url: '/notifications/' + notificationId + '/read',
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                success: function(response) {
                    // Optionally, you can remove or update the notification
                    $(element).removeClass('unread-notification').addClass('read-notification');
                    document.getElementById('notification-count').innerText = response.unreadCount;
                },
                error: function(xhr) {
                    console.error('Failed to mark notification as read:', xhr.responseText);
                }
            });
        }
</script>

</section>
