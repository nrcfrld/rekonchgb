@php
$links = [
    [
        "href" => "dashboard",
        "text" => "Dashboard",
        "is_multi" => false,
    ],
    [
        "href" => [
            [
                "section_text" => "User",
                "section_logo" => "fas fa-users",
                "section_list" => [
                    ["href" => "user", "text" => "Data User"],
                    ["href" => "user.new", "text" => "Buat User"]
                ],
                "section_role" => [0]
            ],
            [
                "section_text" => "Master Data",
                "section_logo" => "fas fa-table",
                "section_list" => [
                    ["href" => "reason-code", "text" => "Reason Code"],
                    ["href" => "level", "text" => "Level Chargeback"],
                    ["href" => "principal", "text" => "Prinsipal"],
                ],
                "section_role" => [0, 1]
            ],
            [
                "section_text" => "Chargeback",
                "section_logo" => "fas fa-file-invoice",
                "section_list" => [
                    ["href" => "chargeback", "text" => "Data Chargeback"],
                    ["href" => "chargeback.new", "text" => "Buat Data"],
                ],
                "section_role" => [0,1]
            ]
        ],
        "text" => "Main Menu",
        "is_multi" => true,
    ],
];
$navigation_links = array_to_object($links);
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-store fa-2x"></i>
            </a>
        </div>
        @foreach ($navigation_links as $link)
        <ul class="sidebar-menu">
            <li class="menu-header">{{ $link->text }}</li>
            @if (!$link->is_multi)
            <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route($link->href) }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @else
                @foreach ($link->href as $section)
                    @php
                    $routes = collect($section->section_list)->map(function ($child) {
                        return Request::routeIs($child->href);
                    })->toArray();

                    $is_active = in_array(true, $routes);
                    @endphp
                    @if (in_array(auth()->user()->role, $section->section_role))
                    <li class="dropdown {{ ($is_active) ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                            <i class="{{ $section->section_logo }}"></i> <span>{{ $section->section_text }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($section->section_list as $child)
                                <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a class="nav-link" href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                @endforeach
            @endif
        </ul>
        @endforeach
    </aside>
</div>
