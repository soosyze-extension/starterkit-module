<?php

namespace SoosyzeExtension\Starterkit\Controller;

use Soosyze\Components\Form\FormBuilder;
use Soosyze\Components\Http\Redirect;
use Soosyze\Components\Http\ServerRequest;
use Soosyze\Components\Validator\Validator;

class Starterkit extends \Soosyze\Controller
{
    public function __construct()
    {
        $this->pathServices = dirname(__DIR__) . '/Config/service.json';
        $this->pathRoutes   = dirname(__DIR__) . '/Config/routes.php';
        $this->pathViews    = dirname(__DIR__) . '/Views/';
    }

    public function index(ServerRequest $req)
    {
        $linkShow = self::router()->getRoute('starterkit.show', [ ':id' => 1 ]);

        return self::template()
                ->view('page', [
                    'title_main' => t('Starterkit index')
                ])
                ->make('page.content', 'page-starterkit-index.php', $this->pathViews, [
                    'link_show' => $linkShow
        ]);
    }

    public function admin(ServerRequest $req)
    {
        $linkCreate = self::router()->getRoute('starterkit.create');
        $linkEdit   = self::router()->getRoute('starterkit.edit', [ ':id' => 1 ]);

        return self::template()
                ->getTheme('theme_admin')
                ->view('page', [
                    'title_main' => t('Starterkit admin'),
                ])
                ->make('page.content', 'page-starterkit-admin.php', $this->pathViews, [
                    'link_create' => $linkCreate,
                    'link_edit'   => $linkEdit
        ]);
    }

    public function show($id, ServerRequest $req)
    {
        return self::template()
                ->view('page', [
                    'title_main' => 'Starterkit content ' . $id,
                ])
                ->make('page.content', 'page-starterkit-show.php', $this->pathViews, [
                    'id' => $id
        ]);
    }

    public function create(ServerRequest $req)
    {
        $action = self::router()->getRoute('starterkit.store');

        $form = (new FormBuilder([ 'method' => 'post', 'action' => $action ]))
            ->group('start-config-fieldset', 'fieldset', function ($form) {
                $form->legend('start-config-legend', t('Starterkit config'))
                ->group('title-group', 'div', function ($form) {
                    $form->label('title-label', 'Title', [
                        'for' => 'title'
                    ])
                    ->text('title', [
                        'class'       => 'form-control',
                        'maxlength'   => 255,
                        'placeholder' => 'Field example',
                        'required'    => 1
                    ]);
                }, [ 'class' => 'form-group' ]);
            })
            ->token('starterkit_create')
            ->submit('submit', t('Save'), [ 'class' => 'btn btn-success' ]);

        return self::template()
                ->getTheme('theme_admin')
                ->view('page', [
                    'title_main' => t('Starterkit create')
                ])
                ->make('page.content', 'form-starterkit-create.php', $this->pathViews, [
                    'form' => $form
        ]);
    }

    public function store(ServerRequest $req)
    {
        $route = self::router()->getRoute('starterkit.admin');

        return new Redirect($route);
    }

    public function edit($id, ServerRequest $req)
    {
        $action = self::router()->getRoute('starterkit.edit', [ ':id' => $id ]);

        $form = (new FormBuilder([ 'method' => 'post', 'action' => $action ]))
            ->group('title-group', 'div', function ($form) use ($id) {
                $form->label('title-label', 'Title', [
                    'for' => 'title'
                ])
                ->text('title', [
                    'class'       => 'form-control',
                    'maxlength'   => 255,
                    'placeholder' => 'Field example',
                    'required'    => 1,
                    'value'       => $id
                ]);
            }, [ 'class' => 'form-group' ])
            ->token('starterkit_edit')
            ->submit('submit', t('Save'), [ 'class' => 'btn btn-success' ]);

        return self::template()
                ->getTheme('theme_admin')
                ->view('page', [
                    'title_main' => t('Starterkit edit :id', [ ':id' => $id ])
                ])
                ->make('page.content', 'form-starterkit-edit.php', $this->pathViews, [
                    'form' => $form
        ]);
    }

    public function update($id, ServerRequest $req)
    {
        $route = self::router()->getRoute('starterkit.admin');

        return new Redirect($route);
    }

    public function delete($id, ServerRequest $req)
    {
        $route = self::router()->getRoute('starterkit.admin');

        return new Redirect($route);
    }
}
