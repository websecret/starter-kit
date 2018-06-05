<?php namespace App\Forms\Fields;

class TranslatableTextareaType extends AbstractTranslatableType
{
    protected function getTemplate()
    {
        return 'admin.partials.form.fields.translatable-textarea';
    }
}