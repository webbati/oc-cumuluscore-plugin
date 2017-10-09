<?php namespace InitBiz\CumulusCore;

// use InitBiz\CumulusCore\Classes\Connector as CumulusConnector;
use InitBiz\CumulusCore\Classes\Helpers;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $require = ['RainLab.UserPlus'];

    public function registerComponents()
    {
        return [
            'InitBiz\CumulusCore\Components\CumulusGuard'       =>  'cumulusGuard',
            'InitBiz\CumulusCore\Components\ModuleGuard'       =>  'moduleGuard',
            'InitBiz\CumulusCore\Components\UserClustersList'  =>  'clustersList',
            'InitBiz\CumulusCore\Components\Menu'               =>  'menu',
            'InitBiz\CumulusCore\Components\MenuItem'               =>  'menuItem',
            'InitBiz\CumulusCore\Components\ClusterDashboard'   =>  'clusterDashboard'
        ];
    }

    public function registerSettings()
    {
        return [
            'modules' => [
                'label'       => 'initbiz.cumuluscore::lang.settings.menu_label',
                'description'       => 'initbiz.cumuluscore::lang.settings.menu_description',
                'category'       => 'initbiz.cumuluscore::lang.settings.menu_category',
                'icon' => 'icon-cubes',
                'url' => \Backend::url('initbiz/cumuluscore/modules'),
                'permissions' => [],
                'order' => 100
            ]
        ];
    }

    public function boot()
    {
    }

    public function register()
    {
        $this->registerConsoleCommand('cumulus.createmodule', 'InitBiz\CumulusCore\Console\CreateModule');
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'componentPage' => [$this, 'findComponentPageUrl']
            ]
        ];
    }

    public function findComponentPageUrl($text)
    {
        return Helpers::findComponentPage($text)->url;
    }
}
