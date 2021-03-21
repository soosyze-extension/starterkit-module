<?php

namespace SoosyzeExtension\Starterkit\Form;

use Soosyze\Components\Form\FormBuilder;

class FormStarterkit extends FormBuilder
{
    protected $values = [ 'title' => '' ];

    public function makeFields()
    {
        return $this->group('starterkit-fieldset', 'fieldset', function ($form) {
            $form->legend('starterkit-legend', t('Fields starterkit'))
                    ->group('title-group', 'div', function ($form) {
                        $form->label('title-label', 'Title')
                        ->text('title', [
                            'class'       => 'form-control',
                            'maxlength'   => 255,
                            'placeholder' => t('Enter title'),
                            'required'    => 1,
                            'value'       => $this->values[ 'title' ]
                        ]);
                    }, [ 'class' => 'form-group' ]);
        })
                ->token('token_starterkit')
                ->submit('submit', t('Save'), [ 'class' => 'btn btn-success' ]);
    }

    public function setValues(array $values)
    {
        $this->values = array_merge($this->values, $values);

        return $this;
    }
}
