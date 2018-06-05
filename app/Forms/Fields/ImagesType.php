<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class ImagesType extends FormField
{

    protected function getTemplate()
    {
        return 'admin.partials.form.fields.images';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        $options = $this->getOptions();
        $options['images']['type'] = array_get($options, 'images.type', 'main');
        $options['images']['isMultiple'] = array_get($options, 'images.isMultiple', true);
        $options['values'] = $this->parent->getModel()->images()->ofType($options['images']['type'])->defaultOrder()->get();
        return parent::render($options, $showLabel, $showField, $showError);
    }
}