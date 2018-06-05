<?php namespace App\Forms\Fields;

class TranslatableTextType extends AbstractTranslatableType
{
    protected function getTemplate()
    {
        return 'admin.partials.form.fields.translatable-text';
    }
}