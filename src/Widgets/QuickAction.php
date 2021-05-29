<?php

/**
 * This file is part of the pdAdmin package.
 *
 * @package     pd-admin
 * @license     LICENSE
 * @author      Ramazan APAYDIN <apaydin541@gmail.com>
 * @link        https://github.com/appaydin/pd-admin
 */

namespace App\Widgets;

use Pd\WidgetBundle\Builder\Item;
use Pd\WidgetBundle\Event\WidgetEvent;
use Symfony\Component\HttpFoundation\Request;

/**
 * Quick Action Widget.
 *
 * @author Ramazan APAYDIN <apaydin541@gmail.com>
 */
class QuickAction
{
    /**
     * Build Widgets.
     */
    public function builder(WidgetEvent $event): void
    {
        // Get Widget Container
        $widgets = $event->getWidgetContainer();

        // Action Button
        $items = [
            'action_account' => [
                'name' => 'nav_account',
                'description' => 'admin_account_desc',
                'route' => 'admin.account_list',
                'icons' => 'user-shield',
                'linkClass' => 'btn btn-primary',
            ],
            'action_group' => [
                'name' => 'nav_group',
                'description' => 'accouunt_group_list_title',
                'route' => 'admin.group_list',
                'icons' => 'users-cog',
                'linkClass' => 'btn btn-primary',
            ],
            'action_settings' => [
                'name' => 'settings_general',
                'description' => 'settings_general_desc',
                'route' => 'admin.config_general',
                'icons' => 'cogs',
                'linkClass' => 'btn btn-secondary',
            ],
        ];

        // Add Widgets
        $widgets
            ->addWidget(
                (new Item('quick_action'))
                    ->setGroup('admin')
                    ->setName('widget.quick_action.name')
                    ->setDescription('widget.quick_action.description')
                    ->setTemplate('admin/widgets/quickAction.html.twig')
                    ->setRole(['ROLE_WIDGET_QUICKACTION'])
                    ->setConfigProcess(static function (Request $request) use ($items) {
                        if (($id = $request->get('id')) && isset($items[$id])) {
                            return [$id => $items[$id]];
                        }

                        return false;
                    })
                    ->setData(static function ($config) use ($items) {
                        return ['items' => $items];
                    })
                    ->setOrder(0)
            );
    }
}
