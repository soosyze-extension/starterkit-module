<?php

namespace Starterkit\Services;

class HookConfig
{
    /**
     * @var \Soosyze\Config
     */
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function menu(&$menu)
    {
        $menu[] = [
            'key'        => 'starterkit',
            'title_link' => 'Starterkit'
        ];
    }

    public function form(&$form, $data)
    {
        return $form->group('start-config-fieldset', 'fieldset', function ($form) use ($data) {
            $form->legend('start-config-legend', 'Starterkit config')
                    ->group('start-start_check-group', 'div', function ($form) use ($data) {
                        $form->checkbox('start_check', 'start_check', [ 'checked' => $data[ 'start_check' ] ])
                        ->label('start-start_check-label', '<span class="ui"></span> Start check.', [
                            'for' => 'start_check'
                        ]);
                    }, [ 'class' => 'form-group' ])
                    ->group('system-start_text-group', 'div', function ($form) use ($data) {
                        $form->label('system-start_text-label', 'Start text')
                        ->text('start_text', 'start_text', [
                            'class'       => 'form-control',
                            'required'    => 1,
                            'placeholder' => 'Text exemple',
                            'value'       => $data[ 'start_text' ]
                        ]);
                    }, [ 'class' => 'form-group' ]);
        })
                ->token()
                ->submit('submit', 'Enregistrer', [ 'class' => 'btn btn-success' ]);
    }

    public function validator(&$validator)
    {
        $validator->setRules([
            'start_check' => '!required|bool',
            'start_text'  => 'required|string|max:255'
        ]);
    }

    public function before(&$validator, &$data)
    {
        $data = [
            'start_check' => $validator->getInput('start_check'),
            'start_text'  => $validator->getInput('start_text')
        ];
    }
}
