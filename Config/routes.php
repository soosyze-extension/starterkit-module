<?php

use Soosyze\Components\Router\Route as R;

R::useNamespace('SoosyzeExtension\Starterkit\Controller');

R::get('starterkit.index', 'starterkit/index', 'Starterkit@index');
R::get('starterkit.admin', 'admin/starterkit', 'Starterkit@admin');
R::get('starterkit.show', 'starterkit/:id', 'Starterkit@show', [':id' => '\d']);
R::get('starterkit.create', 'starterkit/item', 'Starterkit@create');
R::post('starterkit.store', 'starterkit/item', 'Starterkit@store');
R::get('starterkit.edit', 'starterkit/:id/edit', 'Starterkit@edit', [':id' => '\d']);
R::post('starterkit.update', 'starterkit/:id/edit', 'Starterkit@update', [':id' => '\d']);
R::post('starterkit.delete', 'starterkit/:id/delete', 'Starterkit@delete', [':id' => '\d']);
