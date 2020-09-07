<?php

use Soosyze\Components\Router\Route as R;

R::useNamespace('SoosyzeExtension\Starterkit\Controller');

R::get('starterkit.index', 'starterkit/index', 'Starterkit@index');
R::get('starterkit.show', 'starterkit/:id', 'Starterkit@show', [':id' => '\d+']);

R::get('starterkit.admin', 'admin/starterkit', 'Starterkit@admin');
R::get('starterkit.create', 'admin/starterkit/create', 'Starterkit@create');
R::post('starterkit.store', 'admin/starterkit/create', 'Starterkit@store');
R::get('starterkit.edit', 'admin/starterkit/:id/edit', 'Starterkit@edit', [':id' => '\d+']);
R::post('starterkit.update', 'admin/starterkit/:id/edit', 'Starterkit@update', [':id' => '\d+']);
R::post('starterkit.delete', 'admin/starterkit/:id/delete', 'Starterkit@delete', [':id' => '\d+']);
