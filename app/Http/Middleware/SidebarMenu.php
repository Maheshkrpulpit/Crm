<?php

namespace App\Http\Middleware;

use App\Utils\ModuleUtil;
use App\Models\ModuleSetting;
use Closure;
use Illuminate\Support\Facades\Gate;

class SidebarMenu
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->ajax()) {
            return $next($request);
        }
        /**
         * Sale
         */
        $Module = ['icon' => 'ri-team-line',
            'title' => __('Sales'),
            'code' => 'module__core__module',
            'url' => route('sales.index'),
            'permissions' => [],
            'routes' => ['sales.index'],

        ];
        $___sideBarMenu[] = $Module;

        $users = ['icon' => 'ri-team-line',
            'title' => __('locale.menu.users'),
            'url' => '#',
            'permissions' => [],
            'code' => 'module__core__users',
            'routes' => ['admin.users.*', 'admin.roles.*','showbrands.*'],
            'submenu' => [
                ['url' => route('admin.users.index'), 'permissions' => [], 'title' => __('Users'), 'routes' => ['admin.users.*']],
                ['url' => route('admin.roles.index'), 'permissions' => [], 'title' => __('Roles'), 'routes' => ['admin.roles.*']],
                // ['url' => route('showbrands.index'), 'permissions' => [], 'title' => __('Sale'), 'routes' => ['showbrands.*']],
                // ['url' => route('admin.permissions.index'), 'permissions' => [], 'title' => __('Permissions'), 'routes' => ['admin.permissions.*']],

            ]
        ];
        $___sideBarMenu[] = $users;

        $settings = ['icon' => 'ri-settings-2-line',
            'title' => __('locale.menu.settings'),
            'url' => '#',
            'permissions' => [],
            'routes' => ['general_settings.*', 'sms_setting.*','settings.language.index','system_fields.setting.*', 'settings.payment.index', 'settings.call.migrations','currency'],
            'submenu' => [
                ['url' => route('settings.general'), 'permissions' => [], 'title' => lang('General','Settings'), 'routes' => ['general_settings.*']],
                ['url' => route('settings.sms_setting'), 'permissions' => [], 'title' => lang('SMS','Settings'), 'routes' => ['sms_setting.*']],
                ['url' => route('settings.language.index'), 'permissions' => [], 'title' => lang('Language','Settings'), 'routes' => ['settings.language.index']],
                ['url' => route('settings.system-fields.index'), 'permissions' => [], 'title' => lang('System Fields'), 'routes' => ['system_fields.setting.*']],
                ['url' => route('settings.payment.index'), 'permissions' => [], 'title' => lang('Payment','Settings'), 'routes' => ['settings.payment.index']],
                ['url' => route('settings.call.migrations'), 'permissions' => [], 'title' => lang('Migration','Settings'), 'routes' => ['settings.call.migrations']],
            ]
        ];
        $___sideBarMenu[] = $settings;

        /**
         * Master Management Menu
         */
        $subMenu = [];

        if (Gate::check('brands.access')) {
            $subMenu[] = ['url'=>route('master.brands.index'),'permissions'=>[],'title'=>__('Brand'),'routes'=>['master.brands.*']];
        }
        if (Gate::check('packages.access')) {
            $subMenu[] = ['url'=>route('master.packages.index'),'permissions'=>[],'title'=>__('Package'),'routes'=>['master.packages.*']];
        }
        if (Gate::check('departments.access')) {
            $subMenu[] = ['url'=>route('master.departments.index'),'permissions'=>[],'title'=>__('Department'),'routes'=>['master.departments.*']];
        }
       
        if (Gate::check('master_management.menu')) {
            $___sideBarMenu[] = [
                'icon' => 'ri-sensor-fill',
                'title' => __('locale.menu.master_management'),
                'url' => '#',
                'permissions' => [],
                'routes' => ['master.brands.*','master.packages.*','master.departments.*'],
                'submenu' => $subMenu
            ];
        }

        $Module = ['icon' => 'ri-plug-line',
            'title' => __('locale.menu.modules'),
            'code' => 'module__core__module',
            'url' => route('manage-modules.index'),
            'permissions' => [],
            'routes' => ['manage-modules.index'],

        ];
        $___sideBarMenu[] = $Module;


        $moduleUtil = new ModuleUtil;

        $moduleData = $moduleUtil->getModuleData('modifyAdminMenu');

        foreach ($moduleData as $menu):
            $___sideBarMenu[] = $menu;
        endforeach;

        $___moduleSettings = ModuleSetting::where('status', 1)->pluck('code')->toArray();

        $isRequestAllowded = 1;

        view()->share('___sideBarMenu', $___sideBarMenu);
        view()->share('___moduleSettings', $___moduleSettings);

        $routeName = $request->route()->getName();
        $wholeRoute = explode('.', $routeName);
        $wildRoute = array_pop($wholeRoute);

        $wildRoute = str_replace($wildRoute, '*', $routeName);


        foreach ($___sideBarMenu as $itemMenu):

            if (isset($itemMenu['code']) && (in_array($routeName, $itemMenu['routes']) || in_array($wildRoute, $itemMenu['routes']))):

                if (!in_array($itemMenu['code'], $___moduleSettings)):

                    $isRequestAllowded = 0;

                    break;

                endif;

            endif;

        endforeach;


        if ($isRequestAllowded):

            return $next($request);

        else:

            return redirect()->route('404');

        endif;
    }
}