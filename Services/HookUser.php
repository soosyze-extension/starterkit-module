<?php

namespace SoosyzeExtension\Starterkit\Services;

class HookUser
{
    public function hookPermission(&$permission)
    {
        $permission[ 'Starterkit' ] = [
            'starterkit.index'  => 'Voir starterkit',
            'starterkit.admin'  => 'Voir l\'administration',
            'starterkit.show'   => 'Voir le contenu',
            'starterkit.created' => 'Ajouter du contenu',
            'starterkit.edited' => 'Éditer du contenu',
            'starterkit.delete' => 'Supprimer du contenu',
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
