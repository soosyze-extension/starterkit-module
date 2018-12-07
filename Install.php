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
    }

    public function hookInstall($container)
    {
        $this->hookInstallUser($container);
        $this->hookInstallMenu($container);
    }

    public function hookInstallUser($container)
    {
        if ($container->schema()->hasTable('user')) {
            $container->query()->insertInto('permission', [
                    'permission_id',
                    'permission_label'
                ])
                ->values([ 'starterkit.index', 'Voir starterkit' ])
                ->values([ 'starterkit.admin', 'Voir l\'administration' ])
                ->values([ 'starterkit.show', 'Voir le contenu' ])
                ->values([ 'starterkit.create', 'Voir le formulaire d\'ajout' ])
                ->values([ 'starterkit.store', 'Ajouter' ])
                ->values([ 'starterkit.edit', 'Voir le formulaire d\'édition' ])
                ->values([ 'starterkit.update', 'Éditer' ])
                ->values([ 'starterkit.delete', 'Supprimer' ])
                ->execute();

            $container->query()->insertInto('role_permission', [
                    'role_id',
                    'permission_id'
                ])
                ->values([ 1, 'starterkit.index' ])
                ->values([ 2, 'starterkit.index' ])
                ->values([ 3, 'starterkit.index' ])
                ->values([ 3, 'starterkit.admin' ])
                ->values([ 1, 'starterkit.show' ])
                ->values([ 2, 'starterkit.show' ])
                ->values([ 3, 'starterkit.show' ])
                ->values([ 3, 'starterkit.create' ])
                ->values([ 3, 'starterkit.store' ])
                ->values([ 3, 'starterkit.edit' ])
                ->values([ 3, 'starterkit.update' ])
                ->values([ 3, 'starterkit.delete' ])
                ->execute();
        }
    }

    public function hookInstallMenu($container)
    {
        if ($container->schema()->hasTable('menu')) {
            $container->query()->insertInto('menu_link', [ 'title_link', 'link',
                    'menu', 'weight', 'parent' ])
                ->values([
                    '<span class="glyphicon glyphicon-send" aria-hidden="true"></span> Starterkit',
                    'admin/starterkit',
                    'admin-menu',
                    50,
                    -1
                ])
                ->execute();

            $container->query()->insertInto('menu_link', [ 'title_link', 'link',
                    'menu', 'weight', 'parent' ])
                ->values([
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
                ->from('permission')
                ->delete()
                ->where('permission_id', 'like', 'starterkit%')
                ->execute();

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
