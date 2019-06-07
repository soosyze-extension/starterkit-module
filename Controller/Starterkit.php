<?php

namespace SoosyzeExtension\Starterkit\Controller;

use Soosyze\Components\Form\FormBuilder;
use Soosyze\Components\Http\Redirect;
use Soosyze\Components\Validator\Validator;

class Starterkit extends \Soosyze\Controller
{
    public function __construct()
    {
        $this->pathServices = dirname(__DIR__) . '/Config/service.json';
        $this->pathRoutes   = dirname(__DIR__) . '/Config/routing.json';
        $this->pathViews    = dirname(__DIR__) . '/Views/';
    }

    /**
     * Page d'accueil du module.
     */
    public function index($req)
    {
        $linkShow = self::router()->getRoute('starterkit.show', [ ':id' => 1 ]);

        return self::template()
                ->view('page', [
                    'title_main' => 'Starterkit index'
                ])
                ->render('page.content', 'page-starterkit-index.php', $this->pathViews, [
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
                ->getTheme('theme_admin')
                ->view('page', [
                    'title_main' => 'Starterkit admin',
                ])
                ->render('page.content', 'page-starterkit-admin.php', $this->pathViews, [
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
                ->view('page', [
                    'title_main' => 'Starterkit content ' . $id,
                ])
                ->render('page.content', 'page-starterkit-show.php', $this->pathViews, [
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
                ->getTheme('theme_admin')
                ->view('page', [
                    'title_main' => 'Starterkit create'
                ])
                ->render('page.content', 'form-starterkit-create.php', $this->pathViews, [
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
                ->getTheme('theme_admin')
                ->view('page', [
                    'title_main' => 'Starterkit edit ' . $id
                ])
                ->render('page.content', 'form-starterkit-edit.php', $this->pathViews, [
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
