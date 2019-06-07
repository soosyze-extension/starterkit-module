<?php

namespace SoosyzeExtension\Starterkit;

use Psr\Container\ContainerInterface;
use Queryflatfile\TableBuilder;

class Install implements \SoosyzeCore\System\Migration
{

    public function getComposer()
    {
        return __DIR__ . '/composer.json';
    }
    
    public function install(ContainerInterface $ci)
    {
        /* Ajoute une table et insert des données.
          $ci->schema()
             ->createTableIfNotExists('starterkit', function (TableBuilder $table) {
                $table->increments('id')
                ->string('field_1')
                ->integer('field_2')->nullable()
                ->boolean('field_3')->valueDefault(false);
              });

          $ci->query()
            ->insertInto('starterkit', [ 'field_1', 'field_2' ])
            ->values([ 'value_1', 1 ])
            ->values([ 'value_1', 2 ])
            ->values([ 'value_1', null ])
            ->execute();
          // */
        $ci->config()
            ->set('settings.start_check', '')
            ->set('settings.start_text', '');
    }

    public function seeders( ContainerInterface $ci )
    {

    }

    public function hookInstall(ContainerInterface $ci)
    {
        $this->hookInstallUser($ci);
        $this->hookInstallMenu($ci);
    }

    public function hookInstallUser(ContainerInterface $ci)
    {
        if ($ci->module()->has('User')) {
            $ci->query()
                ->insertInto('role_permission', [ 'role_id', 'permission_id' ])
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

    public function hookInstallMenu(ContainerInterface $ci)
    {
        if ($ci->module()->has('Menu')) {
            $ci->query()
                ->insertInto('menu_link', [ 
                    'key', 'title_link', 'link', 'menu', 'weight', 'parent' 
                ])
                ->values([
                    'starterkit.admin',
                    '<i class="fa fa-puzzle-piece"></i> Starterkit',
                    'admin/starterkit',
                    'admin-menu',
                    50,
                    -1
                ])
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

    public function uninstall(ContainerInterface $ci)
    {
        /* Supprime une table et ses données.
          $container->schema()->dropTable('starterkit');
          // */
    }

    public function hookUninstall(ContainerInterface $ci)
    {
        $this->hookUninstallMenu($ci);
        $this->hookUninstallUser($ci);
    }

    public function hookUninstallMenu(ContainerInterface $ci)
    {
        if ($ci->module()->has('Menu')) {
            $ci->query()
                ->from('menu_link')
                ->delete()
                ->where('link', 'admin/starterkit')
                ->orWhere('link', 'like', 'starterkit/%')
                ->execute();
        }
    }
    
    public function hookUninstallUser(ContainerInterface $ci)
    {
        if ($ci->module()->has('User')) {
            $ci->query()
                ->from('role_permission')
                ->delete()
                ->where('permission_id', 'like', 'starterkit%')
                ->execute();
        }
    }
}
