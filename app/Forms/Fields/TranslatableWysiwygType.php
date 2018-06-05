<?php namespace App\Forms\Fields;

class TranslatableWysiwygType extends AbstractTranslatableType
{
    protected function getTemplate()
    {
        return 'admin.partials.form.fields.translatable-textarea';
    }

    protected function getTranslatableOptions()
    {
        $options = parent::getTranslatableOptions();
        $options['attr']['class'] .= trim(array_get($options, 'attr.class', '') . ' js-input__wysiwyg');
        return $options;
    }
}