<?php

namespace SoosyzeExtension\Starterkit\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Soosyze\Components\Http\Redirect;
use Soosyze\Components\Validator\Validator;
use SoosyzeExtension\Starterkit\Form\FormStarterkit;

class Starterkit extends \Soosyze\Controller
{
    public function __construct()
    {
        $this->pathServices = dirname(__DIR__) . '/Config/service.json';
        $this->pathRoutes   = dirname(__DIR__) . '/Config/routes.php';
        $this->pathViews    = dirname(__DIR__) . '/Views/';
    }

    public function index(ServerRequestInterface $req)
    {
        $linkShow = self::router()->getRoute('starterkit.show', [ ':id' => 1 ]);

        return self::template()
                ->view('page', [
                    'title_main' => t('Starterkit home page')
                ])
                ->make('page.content', 'starterkit/content-starterkit-index.php', $this->pathViews, [
                    'link_show' => $linkShow
        ]);
    }

    public function admin(ServerRequestInterface $req)
    {
        $messages = [];
        if (isset($_SESSION[ 'messages' ])) {
            $messages = $_SESSION[ 'messages' ];
            unset($_SESSION[ 'messages' ]);
        }

        return self::template()
                ->getTheme('theme_admin')
                ->view('page', [
                    'title_main' => t('Administer starterkit'),
                    'icon'       => '<i class="fa fa-puzzle-piece" aria-hidden="true"></i>'
                ])
                ->view('page.messages', $messages)
                ->make('page.content', 'starterkit/content-starterkit-admin.php', $this->pathViews, [
                    'link_create' => self::router()->getRoute('starterkit.create'),
                    'link_edit'   => self::router()->getRoute('starterkit.edit', [
                        ':id' => 1
                    ])
        ]);
    }

    public function show($id, ServerRequestInterface $req)
    {
        return self::template()
                ->view('page', [
                    'title_main' => t('Starterkit :id', [ ':id' => $id ]),
                ])
                ->make('page.content', 'starterkit/content-starterkit-show.php', $this->pathViews, [
                    'id' => $id
        ]);
    }

    public function create(ServerRequestInterface $req)
    {
        $values = [];
        if (isset($_SESSION[ 'inputs' ])) {
            $values = $_SESSION[ 'inputs' ];
            unset($_SESSION[ 'inputs' ]);
        }

        $form = (new FormStarterkit([
                'method' => 'post',
                'action' => self::router()->getRoute('starterkit.store')
                ]))
            ->setValues($values)
            ->makeFields();

        $messages = [];
        if (isset($_SESSION[ 'messages' ])) {
            $messages = $_SESSION[ 'messages' ];
            unset($_SESSION[ 'messages' ]);
        }

        return self::template()
                ->getTheme('theme_admin')
                ->view('page', [
                    'title_main' => t('Add Starterkit'),
                    'icon'       => '<i class="fa fa-puzzle-piece" aria-hidden="true"></i>'
                ])
                ->view('page.messages', $messages)
                ->make('page.content', 'starterkit/content-starterkit-form.php', $this->pathViews, [
                    'form' => $form
        ]);
    }

    public function store(ServerRequestInterface $req)
    {
        $validator = $this->setValidator($req);

        if ($validator->isValid()) {
            $_SESSION[ 'messages' ][ 'success' ] = [ t('Your starterkit has been saved.') ];

            return new Redirect(self::router()->getRoute('starterkit.admin'));
        }

        $_SESSION[ 'inputs' ]               = $validator->getInputs();
        $_SESSION[ 'messages' ][ 'errors' ] = $validator->getKeyErrors();

        return new Redirect(self::router()->getRoute('starterkit.create'));
    }

    public function edit($id, ServerRequestInterface $req)
    {
        $values = [ 'title' => 'Example title' ];
        if (isset($_SESSION[ 'inputs' ])) {
            $values = $_SESSION[ 'inputs' ];
            unset($_SESSION[ 'inputs' ]);
        }

        $form = (new FormStarterkit([
                'method' => 'post',
                'action' => self::router()->getRoute('starterkit.edit', [ ':id' => $id ])
                ]))
            ->setValues($values)
            ->makeFields();

        $messages = [];
        if (isset($_SESSION[ 'messages' ])) {
            $messages = $_SESSION[ 'messages' ];
            unset($_SESSION[ 'messages' ]);
        }

        return self::template()
                ->getTheme('theme_admin')
                ->view('page', [
                    'title_main' => t('Edit :id starterkit', [ ':id' => $id ]),
                    'icon'       => '<i class="fa fa-puzzle-piece" aria-hidden="true"></i>'
                ])
                ->view('page.messages', $messages)
                ->make('page.content', 'starterkit/content-starterkit-form.php', $this->pathViews, [
                    'form' => $form
        ]);
    }

    public function update($id, ServerRequestInterface $req)
    {
        $validator = $this->setValidator($req);

        if ($validator->isValid()) {
            $_SESSION[ 'messages' ][ 'success' ] = [ t('Your starterkit has been saved.') ];

            return new Redirect(self::router()->getRoute('starterkit.admin'));
        }

        $_SESSION[ 'inputs' ]               = $validator->getInputs();
        $_SESSION[ 'messages' ][ 'errors' ] = $validator->getKeyErrors();

        return new Redirect(self::router()->getRoute('starterkit.edit', [ ':id' => $id ]));
    }

    public function delete($id, ServerRequestInterface $req)
    {
        return new Redirect(self::router()->getRoute('starterkit.admin'));
    }

    private function setValidator(ServerRequestInterface $req)
    {
        return (new Validator)
                ->setRules([
                    'title'            => 'required|string|max:255',
                    'token_starterkit' => 'token'
                ])
                ->setLabel([
                    'title' => t('Title')
                ])
                ->setInputs($req->getParsedBody());
    }
}
