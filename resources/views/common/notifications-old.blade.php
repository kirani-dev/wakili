<button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bell icon-lg "></i>
    <span class="badge bg-danger rounded-pill">{{ $notifications->count() }}</span>
</button>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

    <div class="p-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0"> {{ $notifications->count() }} New Notifications </h6>
            </div>

        </div>
    </div>

    @if($notifications->count() > 0)

    <div data-simplebar style="max-height: 230px;">
            @foreach($notifications as $notification)
        <a href="{{ url("user/notifications/view-all?tab=unread") }}" class="text-reset notification-item">
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <img src="{{ url('backend') }}/assets/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">{{ $notification->data['subject'] }}</h6>
                    <div class="font-size-13 text-muted">
                        <p class="mb-1">
                            {!! \Illuminate\Support\Str::limit($notification->data['message'],120) !!}
                        </p>
                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>{{ $notification->created_at->diffForHumans() }}</span></p>
                    </div>
                </div>
            </div>
        </a>
            @endforeach
    </div>

    <div class="p-2 border-top d-grid">
        <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ url("user/notifications/view-all") }}">
            <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
        </a>
    </div>
    @endif

</div>
