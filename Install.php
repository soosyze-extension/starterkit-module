<?php

namespace Starterkit;

use Queryflatfile\TableBuilder;

class Install
{
    public function install($container)
    {
        /* Ajoute une table et insert des données.
          $container->schema()->createTableIfNotExists('starterkit', function (TableBuilder $table)
          {
          $table->increments('id')
          ->string('field_1')
          ->integer('field_2')->nullable()
          ->boolean('field_3')->valueDefault(false);
          });

          $container->query()->insertInto('starterkit', [ 'field_1', 'field_2' ])
          ->values([ 'value_1', 1 ])
          ->values([ 'value_1', 2 ])
          ->values([ 'value_1', null ])
          ->execute();
          // */
        $container->config()->set('settings.start_check', '');
        $container->config()->set('settings.start_text', '');
    }

    public function hookInstall($container)
    {
        $this->hookInstallUser($container);
        $this->hookInstallMenu($container);
    }

    public function hookInstallUser($container)
    {
        if ($container->schema()->hasTable('user')) {
            $container->query()->insertInto('role_permission', [
                    'role_id',
                    'permission_id'
                ])
                ->values([ 3, 'starterkit.index' ])
                ->values([ 3, 'starterkit.admin' ])
                ->values([ 3, 'starterkit.show' ])
                ->values([ 3, 'starterkit.created' ])
                ->values([ 3, 'starterkit.edited' ])
                ->values([ 3, 'starterkit.delete' ])
                ->values([ 2, 'starterkit.index' ])
                ->values([ 2, 'starterkit.show' ])
                ->values([ 1, 'starterkit.index' ])
                ->values([ 1, 'starterkit.show' ])
                ->execute();
        }
    }

    public function hookInstallMenu($container)
    {
        if ($container->schema()->hasTable('menu')) {
            $container->query()->insertInto('menu_link', [ 'key', 'title_link', 'link',
                    'menu', 'weight', 'parent' ])
                ->values([
                    'starterkit.admin',
                    '<i class="fa fa-send"></i> Starterkit',
                    'admin/starterkit',
                    'admin-menu',
                    50,
                    -1
                ])
                ->execute();

            $container->query()->insertInto('menu_link', [ 'key', 'title_link', 'link',
                    'menu', 'weight', 'parent' ])
                ->values([
                    'starterkit.index',
                    'Starterkit',
                    'starterkit/index',
                    'main-menu',
                    50,
                    -1
                ])
                ->execute();
        }
    }

    public function uninstall($container)
    {
        if ($container->schema()->hasTable('user')) {
            $container->query()
                ->from('role_permission')
                ->delete()
                ->where('permission_id', 'like', 'starterkit%')
                ->execute();
        }

        if ($container->schema()->hasTable('menu')) {
            $container->query()
                ->from('menu_link')
                ->delete()
                ->where('link', 'admin/starterkit')
                ->orWhere('link', 'starterkit/index')
                ->execute();
        }
        /* Supprime une table et ses données.
          $container->schema()->dropTable('starterkit');
          // */
    }
}
