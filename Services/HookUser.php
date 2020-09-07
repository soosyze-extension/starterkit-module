<?php

namespace SoosyzeExtension\Starterkit\Services;

class HookUser
{
    public function hookPermission(&$permission)
    {
        $permission[ 'Starterkit' ] = [
            'starterkit.admin'   => t('Administer starterkit'),
            'starterkit.show'    => t('View starterkit content'),
            'starterkit.created' => t('Add starterkit content'),
            'starterkit.edited'  => t('Edit starterkit content'),
            'starterkit.deleted' => t('Delete starterkit content'),
        ];
    }

    public function hookStarterkitShow()
    {
        return [ 'starterkit.admin', 'starterkit.show' ];
    }

    public function hookStarterkitCreated($req)
    {
        return [ 'starterkit.admin', 'starterkit.created' ];
    }

    public function hookStarterkitEdited($id, $req)
    {
        return [ 'starterkit.admin', 'starterkit.edited' ];
    }

    public function hookStarterkitDelete($id, $req)
    {
        return [ 'starterkit.admin', 'starterkit.deleted' ];
    }
}
