<?php

namespace SoosyzeExtension\Starterkit\Hook;

class User implements \SoosyzeCore\User\UserInterface
{
    public function hookUserPermissionModule(array &$permissions)
    {
        $permissions[ 'Starterkit' ] = [
            'starterkit.admin'   => 'Administer starterkit',
            'starterkit.show'    => 'View starterkit content',
            'starterkit.created' => 'Add starterkit content',
            'starterkit.edited'  => 'Edit starterkit content',
            'starterkit.deleted' => 'Delete starterkit content',
        ];
    }

    public function hookStarterkitCreated($req)
    {
        return [ 'starterkit.admin', 'starterkit.created' ];
    }

    public function hookStarterkitDelete($id, $req)
    {
        return [ 'starterkit.admin', 'starterkit.deleted' ];
    }

    public function hookStarterkitEdited($id, $req)
    {
        return [ 'starterkit.admin', 'starterkit.edited' ];
    }

    public function hookStarterkitShow()
    {
        return [ 'starterkit.admin', 'starterkit.show' ];
    }
}
