<?php

namespace Starterkit\Controller;

use Soosyze\Components\Form\FormBuilder;
use Soosyze\Components\Http\Redirect;
use Soosyze\Components\Validator\Validator;

define('CONFIG_STARTERKIT', MODULES_CONTRIBUED . 'Starterkit' . DS . 'config' . DS);

define('VIEWS_STARTERKIT', MODULES_CONTRIBUED . 'Starterkit' . DS . 'Views' . DS);

class Starterkit extends \Soosyze\Controller
{
    public function __construct()
    {
        $this->pathServices = CONFIG_STARTERKIT . 'service.json';
        $this->pathRoutes   = CONFIG_STARTERKIT . 'routing.json';
    }

    /**
     * Page d'accueil du module.
     */
    public function index($req)
    {
        $linkShow = self::router()->getRoute('starterkit.show', [ ':id' => 1 ]);

        return self::template()
                ->setTheme(false)
                ->view('page', [
                    'title_main' => 'Starterkit index'
                ])
                ->render('page.content', 'page-starterkit-index.php', VIEWS_STARTERKIT, [
                    'link_show' => $linkShow
        ]);
    }

    /**
     * Page d'administration du module.
     */
    public function admin($req)
    {
        $linkCreate = self::router()->getRoute('starterkit.create');
        $linkEdit   = self::router()->getRoute('starterkit.edit', [ ':id' => 1 ]);

        return self::template()
                ->setTheme()
                ->view('page', [
                    'title_main' => 'Starterkit admin',
                ])
                ->render('page.content', 'page-starterkit-admin.php', VIEWS_STARTERKIT, [
                    'link_create' => $linkCreate,
                    'link_edit'   => $linkEdit
        ]);
    }

    /**
     * Page pour voir un contenu du module.
     */
    public function show($id, $req)
    {
        return self::template()
                ->setTheme(false)
                ->view('page', [
                    'title_main' => 'Starterkit content ' . $id,
                ])
                ->render('page.content', 'page-starterkit-show.php', VIEWS_STARTERKIT, [
                    'id' => $id
        ]);
    }

    /**
     * Formulaire de création du module.
     */
    public function create($req)
    {
        $action = self::router()->getRoute('starterkit.store');

        $form = (new FormBuilder([ 'method' => 'post', 'action' => $action ]))
            ->group('menu-link-title-group', 'div', function ($form) {
                $form->label('menu-link-title-label', 'Texte', [
                    'for' => 'text' ])
                ->text('text', 'text', [
                    'class'       => 'form-control',
                    'maxlength'   => 255,
                    'placeholder' => 'Champ d\'exemple',
                    'required'    => 1
                ]);
            }, [ 'class' => 'form-group' ])
            ->token()
            ->submit('submit', 'Enregistrer', [ 'class' => 'btn btn-success' ]);

        return self::template()
                ->setTheme()
                ->view('page', [
                    'title_main' => 'Starterkit create'
                ])
                ->render('page.content', 'form-starterkit-create.php', VIEWS_STARTERKIT, [
                    'form' => $form
        ]);
    }

    /**
     * Fonction de validation et d'ajout du module.
     */
    public function store($req)
    {
        $route = self::router()->getRoute('starterkit.admin');

        return new Redirect($route);
    }

    /**
     * Formulaire d'édition du module.
     */
    public function edit($id, $req)
    {
        $action = self::router()->getRoute('starterkit.edit', [ ':id' => $id ]);

        $form = (new FormBuilder([ 'method' => 'post', 'action' => $action ]))
            ->group('menu-link-title-group', 'div', function ($form) use ($id) {
                $form->label('menu-link-title-label', 'Texte', [
                    'for' => 'text' ])
                ->text('text', 'text', [
                    'class'       => 'form-control',
                    'maxlength'   => 255,
                    'placeholder' => 'Champ d\'exemple',
                    'required'    => 1,
                    'value'       => $id
                ]);
            }, [ 'class' => 'form-group' ])
            ->token()
            ->submit('submit', 'Enregistrer', [ 'class' => 'btn btn-success' ]);

        return self::template()
                ->setTheme()
                ->view('page', [
                    'title_main' => 'Starterkit edit ' . $id
                ])
                ->render('page.content', 'form-starterkit-edit.php', VIEWS_STARTERKIT, [
                    'form' => $form
        ]);
    }

    /**
     * Fonction de validation et modification du module.
     */
    public function update($id, $req)
    {
        $route = self::router()->getRoute('starterkit.admin');

        return new Redirect($route);
    }

    /**
     * Fonction de validation et suppression du module.
     */
    public function delete($id, $req)
    {
        $route = self::router()->getRoute('starterkit.admin');

        return new Redirect($route);
    }
}
