<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {

        Form::macro('adminLabel', function ($name, $value = null, $options = array(), $escape_html = true) {
            if(!$value) {
                $value = str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $name);
                if(starts_with($value, 'filter.')) {
                    $value = str_replace_first('filter.', '', $value);
                }
                $value = __('labels.' . $value);
            }
            return Form::label($name, $value, $options, $escape_html);
        });

        Form::component('adminText', 'admin.partials.form.components.text', ['name', 'value', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminTextUnwrapped', 'admin.partials.form.components.text', ['name', 'value', 'attributes', 'labelName', 'wrapped' => false]);

        Form::component('adminFile', 'admin.partials.form.components.file', ['name', 'value', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminFileUnwrapped', 'admin.partials.form.components.file', ['name', 'value', 'attributes', 'labelName', 'wrapped' => false]);

        Form::component('adminTextarea', 'admin.partials.form.components.textarea', ['name', 'value', 'options', 'labelName', 'wrapped' => true]);
        Form::component('adminTextareaUnwrapped', 'admin.partials.form.components.textarea', ['name', 'value', 'options', 'labelName', 'wrapped' => false]);

        Form::component('adminWysiwyg', 'admin.partials.form.components.wysiwyg', ['name', 'value', 'options', 'labelName', 'wrapped' => true, 'extended' => false]);
        Form::component('adminWysiwygUnwrapped', 'admin.partials.form.components.wysiwyg', ['name', 'value', 'options', 'labelName', 'wrapped' => false, 'extended' => false]);

        Form::component('adminExtendedWysiwyg', 'admin.partials.form.components.wysiwyg', ['name', 'value', 'options', 'labelName', 'wrapped' => true, 'extended' => true]);
        Form::component('adminExtendedWysiwygUnwrapped', 'admin.partials.form.components.wysiwyg', ['name', 'value', 'options', 'labelName', 'wrapped' => false, 'extended' => true]);

        Form::component('adminEmail', 'admin.partials.form.components.email', ['name', 'value', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminEmailUnwrapped', 'admin.partials.form.components.email', ['name', 'value', 'attributes', 'labelName', 'wrapped' => false]);

        Form::component('adminPassword', 'admin.partials.form.components.password', ['name', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminPasswordUnwrapped', 'admin.partials.form.components.password', ['name', 'attributes', 'labelName', 'wrapped' => false]);

        Form::component('adminSelect', 'admin.partials.form.components.select', ['name', 'list', 'selected', 'selectAttributes', 'labelName', 'optionsAttributes', 'optgroupsAttributes', 'ajax' => false, 'wrapped' => true]);
        Form::component('adminSelectUnwrapped', 'admin.partials.form.components.select', ['name', 'list', 'selected', 'selectAttributes', 'labelName', 'optionsAttributes', 'optgroupsAttributes', 'ajax' => false, 'wrapped' => false]);

        Form::component('adminSelectMultiple', 'admin.partials.form.components.select-multiple', ['name', 'list', 'selected', 'selectAttributes', 'labelName', 'optionsAttributes', 'optgroupsAttributes', 'ajax' => false, 'wrapped' => true]);
        Form::component('adminSelectMultipleUnwrapped', 'admin.partials.form.components.select-multiple', ['name', 'list', 'selected', 'selectAttributes', 'labelName', 'optionsAttributes', 'optgroupsAttributes', 'ajax' => false, 'wrapped' => false]);

        Form::component('adminAjaxSelect', 'admin.partials.form.components.select', ['name', 'link', 'list', 'selected', 'selectAttributes', 'labelName', 'optionsAttributes', 'optgroupsAttributes', 'ajax' => true, 'wrapped' => true]);
        Form::component('adminAjaxSelectUnwrapped', 'admin.partials.form.components.select', ['name', 'link', 'list', 'selected', 'selectAttributes', 'labelName', 'optionsAttributes', 'optgroupsAttributes', 'ajax' => true, 'wrapped' => false]);

        Form::component('adminAjaxSelectMultiple', 'admin.partials.form.components.select-multiple', ['name', 'link', 'list', 'selected', 'selectAttributes', 'labelName', 'optionsAttributes', 'optgroupsAttributes', 'ajax' => true, 'wrapped' => true]);
        Form::component('adminAjaxSelectMultipleUnwrapped', 'admin.partials.form.components.select-multiple', ['name', 'link', 'list', 'selected', 'selectAttributes', 'labelName', 'optionsAttributes', 'optgroupsAttributes', 'ajax' => true, 'wrapped' => false]);

        Form::component('adminCheckboxes', 'admin.partials.form.components.checkboxes', ['name', 'list', 'values', 'options', 'labelName', 'wrapped' => true]);
        Form::component('adminCheckboxesUnwrapped', 'admin.partials.form.components.checkboxes', ['name', 'list', 'values', 'options', 'labelName', 'wrapped' => false]);

        Form::component('adminRadios', 'admin.partials.form.components.radios', ['name', 'list', 'value', 'options', 'labelName', 'wrapped' => true]);
        Form::component('adminRadiosUnwrapped', 'admin.partials.form.components.radios', ['name', 'list', 'value', 'options', 'labelName', 'wrapped' => false]);

        Form::component('adminBoolean', 'admin.partials.form.components.boolean', ['name', 'value', 'options', 'labelName', 'wrapped' => true]);
        Form::component('adminBooleanUnwrapped', 'admin.partials.form.components.boolean', ['name', 'value', 'options', 'labelName', 'wrapped' => false]);

        Form::component('adminTranslatableText', 'admin.partials.form.components.translatable-text', ['name', 'value', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminTranslatableTextUnwrapped', 'admin.partials.form.components.translatable-text', ['name', 'value', 'attributes', 'labelName', 'wrapped' => false]);

        Form::component('adminTranslatableTextarea', 'admin.partials.form.components.translatable-textarea', ['name', 'value', 'options', 'labelName', 'wrapped' => true]);
        Form::component('adminTranslatableTextareaUnwrapped', 'admin.partials.form.components.translatable-textarea', ['name', 'value', 'options', 'labelName', 'wrapped' => false]);

        Form::component('adminTranslatableWysiwyg', 'admin.partials.form.components.translatable-wysiwyg', ['name', 'value', 'options', 'labelName', 'wrapped' => true]);
        Form::component('adminTranslatableWysiwygUnwrapped', 'admin.partials.form.components.translatable-wysiwyg', ['name', 'value', 'options', 'labelName', 'wrapped' => false]);

        Form::component('adminSlug', 'admin.partials.form.components.slug', ['name', 'value', 'from', 'locked', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminSlugUnwrapped', 'admin.partials.form.components.slug', ['name', 'value', 'from', 'locked', 'attributes', 'labelName', 'wrapped' => false]);

        Form::macro('carbonDate', function ($name, $value = null, $options = []) {
            $value = Form::getValueAttribute($name, $value);
            if (!is_null($value)) {
                $value = ($value instanceof Carbon) ? $value->format($options['data-date-time-carbon-format']) : $value;
            }
            return Form::text($name, $value, $options);
        });
        Form::component('adminDate', 'admin.partials.form.components.date', ['name', 'value', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminDateUnwrapped', 'admin.partials.form.components.date', ['name', 'value', 'attributes', 'labelName', 'wrapped' => false]);
        Form::component('adminDateTime', 'admin.partials.form.components.date-time', ['name', 'value', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminDateTimeUnwrapped', 'admin.partials.form.components.date-time', ['name', 'value', 'attributes', 'labelName', 'wrapped' => false]);
        Form::component('adminTime', 'admin.partials.form.components.time', ['name', 'value', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminTimeUnwrapped', 'admin.partials.form.components.time', ['name', 'value', 'attributes', 'labelName', 'wrapped' => false]);

        Form::component('adminImages', 'admin.partials.form.components.images', ['name', 'value', 'multiple', 'type', 'customAttributes', 'labelName', 'wrapped' => true]);
        Form::component('adminImagesUnwrapped', 'admin.partials.form.components.images', ['name', 'value', 'multiple', 'type', 'customAttributes', 'labelName', 'wrapped' => false]);

        Form::component('adminFiles', 'admin.partials.form.components.files', ['name', 'value', 'multiple', 'labelName', 'wrapped' => true]);
        Form::component('adminFilesUnwrapped', 'admin.partials.form.components.files', ['name', 'value', 'multiple', 'labelName', 'wrapped' => false]);
    }
}
