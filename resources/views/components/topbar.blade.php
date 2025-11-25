<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar">
                        @if ($user->profile && $user->profile->path)
                            @php
                                $filename = basename($user->profile->path);
                                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                            @endphp
                            @if (in_array($extension, ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('ticketing_system/storage/app/public/' . $user->profile->path) }}" class="rounded-circle" />
                            @endif
                        @else
                            <img src="{{ asset('ticketing_system/storage/app/public/profiles/profile.png') }}" class="rounded-circle" />
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('masterUser.show', $user->userId) }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        @if (file_exists('storage/uploads/' . $user->image))
                                            <img src="{{ asset('ticketing_system/storage/app/public/profiles/' . $user->image) }}" alt
                                                class="rounded-circle" />
                                        @else
                                            <img src="{{ asset('ticketing_system/storage/app/public/profiles/profile.png') }}" alt
                                                class="rounded-circle" />
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block">{{ $user->nama }}</span>
                                    <small class="text-muted">{{ $user->getRoleNames()->first() }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a href="{{ route('updatePassword') }}" class="dropdown-item">
                            <i class="bx bx-key me-2"></i>
                            <span class="align-middle">Ubah Password</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('form-logout').submit()">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" id="form-logout">@csrf</form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
