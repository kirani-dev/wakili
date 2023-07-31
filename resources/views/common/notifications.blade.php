<!-- Notification -->
<div class="dropdown">
    <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" style="color: white !important;" id="navbarNotificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
        <i class="bi-bell"></i>
        <span class="btn-status btn-sm-status btn-status-danger"></span>
    </button>

    <div class="dropdown-menu dropdown-menu-end dropdown-card navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="navbarNotificationsDropdown" style="width: 25rem;">
        <!-- Header -->
        <div class="card-header card-header-content-between">
            <h4 class="card-title mb-0">({{ count($notifications) }}) Notifications</h4>

            <!-- Unfold -->
            <div class="dropdown">
                <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle" id="navbarNotificationsDropdownSettings" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi-three-dots-vertical"></i>
                </button>

                @if($notifications->count() > 0)
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="navbarNotificationsDropdownSettings">
                    <span class="dropdown-header">Settings</span>

                    <a class="dropdown-item" href="#">
                        <i class="bi-check2-all dropdown-item-icon"></i> Mark all as read
                    </a>

                </div>
                    @endif
            </div>
            <!-- End Unfold -->
        </div>
        <!-- End Header -->

    @if($notifications->count() > 0)

        <!-- Body -->
        <div class="card-body-height">
            <!-- Tab Content -->
            <div class="tab-content" id="notificationTabContent">

                <ul class="list-group list-group-flush navbar-card-list-group">
                    @foreach($notifications as $notification)
                        <!-- Item -->
                        <li class="list-group-item form-check-select">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="d-flex align-items-center">

                                        <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                            <span class="avatar-initials">{{ $notification->data['sender'] ?? 'S' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Col -->

                                <div class="col ms-n2">
                                    <h5 class="mb-1">{{ $notification->data['subject'] }}</h5>

                                    <blockquote class="blockquote blockquote-sm">
                                        {!! \Illuminate\Support\Str::limit($notification->data['message'],120) !!}
                                    </blockquote>
                                </div>
                                <!-- End Col -->

                                <small class="col-auto text-muted text-cap">{{ $notification->created_at->diffForHumans() }}</small>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <a class="stretched-link" href="{{ url("user/notifications/view-all") }}"></a>
                        </li>
                        <!-- End Item -->
                        @endforeach
                </ul>

            </div>
            <!-- End Tab Content -->
        </div>
        <!-- End Body -->
            <!-- Card Footer -->
            <a class="card-footer text-center" href="#">
                View all notifications <i class="bi-chevron-right"></i>
            </a>
    @endif


        <!-- End Card Footer -->
    </div>
</div>
<!-- End Notification -->
