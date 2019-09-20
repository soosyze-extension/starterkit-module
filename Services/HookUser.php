<?php

namespace SoosyzeExtension\Starterkit\Services;

class HookUser
{
    public function hookPermission(&$permission)
    {
        $permission[ 'Starterkit' ] = [
            'starterkit.index'   => t('View'),
            'starterkit.admin'   => t('Administrator'),
            'starterkit.show'    => t('View content'),
            'starterkit.created' => t('Add content'),
            'starterkit.edited'  => t('Edit'),
            'starterkit.delete'  => t('Delete'),
        ];
    }

    public function hookStarterkitCreated($req)
    {
        return 'starterkit.created';
    }

    public function hookStarterkitEdited($id, $req)
    {
        return 'starterkit.edited';
    }
}
