<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Compattana ltd.,',
    'title_prefix' => '',
    'title_postfix' => ' | Compattana ltd.,',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '',
    'logo_img' => 'logo-compat.png',
    'logo_img_class' => 'brand-image pl-4',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Technoair Service+',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */


    'classes_body' => 'text-sm layout-fixed sidebar-mini',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => 'nav-flat',
    'classes_topnav' => 'navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',


    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fa-duotone nav-icon fa-fw fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => false,
    'password_reset_url' => false,
    'password_email_url' => false,
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'text' => 'แก้ไขข้อมูลส่วนตัว',
            'route' => 'profiles.index',
            'icon' => 'fa-duotone nav-icon fa-fw fa-user-edit',
            'topnav_user' => true,
        ],

        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'text' => 'แดชบอร์ด',
            'url' => 'home',
            'active' => ['home', '/', 'dashboard'],
            'icon' => ' nav-icon fa-fw fa-duotone fa-gauge-max mr-2',
        ],//แดชบอร์ด
        [
            'text' => 'ตารางงาน',
            'route' => 'calendars.index',
//            'active' => [''],
            'icon' => ' nav-icon fa-fw fa-duotone fa-calendar-lines-pen mr-2',
        ],//แดชบอร์ด
        ['header' => 'ดำเนินการ',  'can' => 'agreement-view'],
        [
            'text' => 'เปิดสัญญา',
            'route' => 'agreements.index',
            'active' => ['*agreements*'],
            'icon' => 'fa-duotone nav-icon fa-fw fa-file-contract mr-2',
            'can' => 'agreement-view'
        ],//เปิดสัญญา
//        [
//            'text' => 'PM',
//            'route' => 'maintenances.index',
//            'active' => ['*maintenance*'],
//            'icon' => 'fa-duotone nav-icon fa-fw fa-tasks mr-2',
//        ],//เปิดสัญญา
        ['header' => 'สำหรับช่าง' , 'can' => 'technical-view'],
        [
            'text' => 'PM',
            'url' => '#',
            'icon' => 'fa-duotone nav-icon fa-fw fa-tasks mr-2',
            'can' => 'technical-view',
            'submenu' => [
                [
                    'text' => 'ลงเวลา',
                    'url' => 'schedules?type=' . \App\Models\MaintenanceSchedule::TYPE_MAINTENANCE_PM,
                    'active' => ['*schedules?type=maintenance_pm*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-circle-small mr-2',
                ],//เปิดสัญญา
                [
                    'text' => 'Maintenance',
                    'url' => 'maintenances?status=' . \App\Models\MaintenanceSchedule::STATUS_PENDING . '?type=' . \App\Models\TechnicianReport::TYPE_MAINTENANCE_PM,
                    'active' => ['*?status=pending*', '*schedules_pm*', '*maintenances*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-circle-small mr-2',
                ],//เปิดสัญญา
            ]
        ],
        [
            'text' => 'นอกเหนือ PM',
            'url' => '#',
            'icon' => 'fa-duotone nav-icon fa-fw fa-file-signature mr-2',
            'can' => 'technical-view',
            'submenu' => [
                [
                    'text' => 'ทั้งหมด',
                    'url' => 'schedules_other?type=general',
                    'active' => ['*?type=general*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-circle-small mr-2',
                ],//
                [
                    'text' => 'นอก Contract',
                    'url' => 'maintenance_reports?type=' . \App\Models\TechnicianReport::TYPE_NO_CONTRACT,
                    'active' => ['*maintenance_reports?type=no_contract*', '*&type=no_contract*', '*create?type=no_contract*', '*edit?type=no_contract*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-angle-right mr-2',
                ],//
                [
                    'text' => 'Emergency',
                    'url' => 'maintenance_reports?type=' . \App\Models\TechnicianReport::TYPE_EMERGENCY,
                    'active' => ['*maintenance_reports?type=emergency*', '*&type=emergency*', '*create?type=emergency*', '*edit?type=emergency*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-angle-right mr-2',
                ],//
                [
                    'text' => 'ติดตั้ง',
                    'url' => 'maintenance_reports?type=' . \App\Models\TechnicianReport::TYPE_INSTALL,
                    'active' => ['*maintenance_reports?type=install*', '*&type=install*', '*create?type=install*', '*edit?type=install*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-angle-right mr-2',
                ],//
                [
                    'text' => 'Rework',
                    'url' => 'maintenance_reports?type=' . \App\Models\TechnicianReport::TYPE_REWORK,
                    'active' => ['*maintenance_reports?type=rework*', '*&type=rework*', '*create?type=rework*', '*edit?type=rework*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-angle-right mr-2',
                ],//
                [
                    'text' => 'งานอื่นๆ',
                    'url' => 'maintenance_reports?type=' . \App\Models\MaintenanceSchedule::TYPE_OTHER,
                    'active' => ['*maintenance_reports?type=other*', '*&type=other*', '*create?type=other*', '*edit?type=other*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-angle-right mr-2',
                ],//
            ]
        ],
        ['header' => 'ข้อมูลทั่วไป', 'can' => 'general-view'],
        [
            'text' => 'ลูกค้า',
            'route' => 'customers.index',
            'active' => ['*customer*'],
            'icon' => 'fa-duotone nav-icon fa-fw fa-user mr-2',
//            'can' => 'customer-view'
        ],//ลูกค้า
        [
            'text' => 'สินค้า',
            'route' => 'products.index',
            'active' => ['*products*'],
            'icon' => 'fa-duotone nav-icon fa-fw fa-box mr-2',
//            'can' => 'product-view'
        ],//เปิดสัญญา
//        [
//            'text' => 'Product Serials',
//            'route' => 'product_serials.index',
//            'active' => ['*product_serials*'],
//            'icon' => 'fa-duotone nav-icon fa-fw fa-boxes mr-2',
//        ],//Product Serials
        [
            'text' => 'อะไหล่',
            'route' => 'product_parts.index',
            'active' => ['*product_parts*'],
            'icon' => 'fa-duotone nav-icon fa-fw fa-screwdriver-wrench mr-2',
//            'can' => 'product-part-view'
        ],//Product Parts
        [
            'text' => 'ข้อมูลประกอบใบรายงาน',
            'url' => '#',
            'icon' => 'fa-duotone nav-icon fa-fw fa-cogs mr-2',
            'submenu' => [
                [
                    'text' => 'อาการ Compressor',
                    'route' => 'compressors.index',
                    'active' => ['*compressors*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-circle-small mr-2',
                ],//อาการ Compressor
                [
                    'text' => 'อาการ Dryer',
                    'route' => 'dryers.index',
                    'active' => ['*dryers*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-circle-small mr-2',
                ],//อาการ Dryer
                [
                    'text' => 'Reading/Measuring',
                    'route' => 'product_models.index',
                    'active' => ['*product_models*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-circle-small mr-2',
                ],//Product Models
                [
                    'text' => 'Inspection',
                    'route' => 'inspections.index',
                    'active' => ['*inspections*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-circle-small mr-2',
                ],//Inspection
            ],
        ],
        ['header' => 'รายงาน', 'can' => 'report-view'],
        [
            'text' => 'การเข้าซ่อมบำรุง',
            'url' => 'reports_pm?customer_id=all&type=all&date_start=' . \Carbon\Carbon::now()->translatedFormat(thaidate('j F Y')).'&date_start_submit=' . \Carbon\Carbon::now().'&date_end='.\Carbon\Carbon::now()->translatedFormat(thaidate('j F Y')).'&date_end_submit=' . \Carbon\Carbon::now(),
            'route' => 'reports_pm.index',
            'active' => ['*reports_pm*'],
            'icon' => 'fa-duotone nav-icon fa-fw fa-file-chart-column mr-2',
            'can' => 'report-view'
        ],//Product Parts
        ['header' => 'ตั้งค่าระบบ'],
        [
            'text' => 'สำหรับเจ้าหน้าที่',
            'url' => '#',
            'icon' => 'fa-duotone nav-icon fa-fw fa-user-cog mr-2',
            'submenu' => [
                [
                    'text' => 'ข้อมูลผู้ใช้งาน',
                    'route' => 'admins.index',
                    'icon' => 'fa-duotone nav-icon fa-fw fa-circle-small mr-2',
                    'active' => ['*admins*']
                ],//จัดการข้อมูลพนักงาน
                [
                    'text' => 'พนักงานฝ่ายซ่อมบำรุง',
                    'route' => 'technicians.index',
//            'active' => [''],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-circle-small mr-2',
                ],//พนักงานฝ่ายซ่อมบำรุง
//                [
//                    'text' => 'ประวัติการใช้งานระบบ',
//                    'route' => 'activities.index',
//                    'icon' => 'fa-duotone nav-icon fa-fw fa-user-tag mr-2',
//                    'active' => ['*activities*']
//                ], //กิจกรรม activities
                [
                    'text' => 'บทบาทการใช้งาน',
                    'route' => 'roles.index',
                    'active' => ['*roles*'],
                    'icon' => 'fa-duotone nav-icon fa-fw fa-circle-small mr-2',
                    'can' => 'role-per-view'
                ],//บทบาทการใช้งาน
//                [
//                    'text' => 'จัดการสิทธิ์การใช้งาน',
//                    'icon_color' => 'warning',
//                    'route' => 'permissions.index',
//                    'active' => ['*permissions*'],
//                    'icon' => 'fa-duotone nav-icon fa-fw fa-key mr-2',
//                ],//จัดการสิทธิ์การใช้งาน
            ]
        ],//สำหรับเจ้าหน้าที่
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'pickadatejs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/picker.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/picker.date.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/picker.time.js',
                ],

                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => ' https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/translations/th_TH.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/themes/default.css',
                ],

                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/themes/default.date.css',
                ],

                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/themes/default.time.css',
                ],

            ],
        ],
        'custom-file-input' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.1.1/bs-custom-file-input.min.js'
                ]
            ]
        ],
        'Dropzone' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://unpkg.com/dropzone@5/dist/min/dropzone.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'css/my-dropzone.css',
                ],
            ],
        ],
        'Jqueryui' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js',
                ],
            ],
        ],
        'jQueryValidation' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/localization/messages_th.min.js',
                ],
            ],
        ],
        'full-calendars' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css',
                ],
            ],
        ],
        'multiple-select' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js'
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js'
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css'
                ],
            ]
        ],
        'i-check' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css'
                ],
            ]
        ],
        'Datepicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
                ],
            ],
        ],
        'Datetimepicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css',
                ],

            ],
        ],
        'Jquery' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js',
                ],
            ],
        ],
        'bootstrapSwitch' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css',
                ],
            ],
        ],
        'bs-stepper' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css',
                ],

            ],
        ],
        'momentjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
                ],
            ],
        ],
        'daterangpicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
