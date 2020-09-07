<?php

namespace SoosyzeExtension\Starterkit;

use Psr\Container\ContainerInterface;
use Queryflatfile\TableBuilder;

class Installer extends \SoosyzeCore\System\Migration
{
    public function getDir()
    {
        return __DIR__ . '/composer.json';
    }
    
    public function boot()
    {
        $this->loadTranslation('fr', __DIR__ . '/Lang/fr/main.json');
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
          // */
        $ci->config()
            ->set('settings.start_check', '')
            ->set('settings.start_text', '');
    }

    public function seeders(ContainerInterface $ci)
    {
        /* Ajout des données
          $ci->query()
          ->insertInto('starterkit', [ 'field_1', 'field_2' ])
          ->values([ 'value_1', 1 ])
          ->values([ 'value_1', 2 ])
          ->values([ 'value_1', null ])
          ->execute();
          // */
    }

    public function hookInstall(ContainerInterface $ci)
    {
        $this->hookInstallMenu($ci);
        $this->hookInstallUser($ci);
    }

    public function hookInstallMenu(ContainerInterface $ci)
    {
        if ($ci->module()->has('Menu')) {
            $ci->query()
                ->insertInto('menu_link', [
                    'key', 'icon', 'title_link', 'link', 'menu', 'weight', 'parent'
                ])
                ->values([
                    'starterkit.admin', 'fa fa-puzzle-piece', 'Starterkit', 'admin/starterkit',
                    'menu-admin', 50, -1
                ])
                ->values([
                    'starterkit.index', null, 'Starterkit', 'starterkit/index', 'menu-main',
                    50, -1
                ])
                ->execute();
        }
    }

    public function hookInstallUser(ContainerInterface $ci)
    {
        if ($ci->module()->has('User')) {
            $ci->query()
                ->insertInto('role_permission', [ 'role_id', 'permission_id' ])
                ->values([ 3, 'starterkit.admin' ])
                ->values([ 3, 'starterkit.show' ])
                ->values([ 2, 'starterkit.show' ])
                ->values([ 1, 'starterkit.show' ])
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
            $ci->menu()->deleteLinks(function () use ($ci) {
                return $ci->query()
                        ->from('menu_link')
                        ->where('key', 'like', 'starterkit%')
                        ->fetchAll();
            });
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
