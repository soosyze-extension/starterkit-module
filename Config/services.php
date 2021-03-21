<?php

return [
    'starterkit' => [
        'class' => "SoosyzeExtension\Starterkit\Services\Starterkit",
        'arguments' => ['@query']
    ],
    'starterkit.extend' => [
        'class' => "SoosyzeExtension\Starterkit\Extend",
        'hooks' => [
            'install.user' => 'hookInstallUser',
            'install.menu' => 'hookInstallMenu'
        ]
    ],
    'starterkit.hook.config' => [
        'class' => "SoosyzeExtension\Starterkit\Hook\Config",
        'hooks' => [
            'config.edit.menu' => 'menu'
        ]
    ],
    'starterkit.hook.user' => [
        'class' => "SoosyzeExtension\Starterkit\Hook\User",
        'hooks' => [
            'user.permission.module' => 'hookUserPermissionModule',
            'route.starterkit.index' => 'hookStarterkitShow',
            'route.starterkit.show' => 'hookStarterkitShow',
            'route.starterkit.create' => 'hookStarterkitCreated',
            'route.starterkit.store' => 'hookStarterkitCreated',
            'route.starterkit.edit' => 'hookStarterkitEdited',
            'route.starterkit.update' => 'hookStarterkitEdited',
            'route.starterkit.delete' => 'hookStarterkitDelete'
        ]
    ]
];
