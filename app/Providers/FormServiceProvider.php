<?php

namespace App\Providers;

use App\Models\Setting\Setting;
use App\Observers\SettingObserver;
use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Form::component('adminText', 'admin.partials.form.components.text', ['name', 'value', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminTextUnwrapped', 'admin.partials.form.components.text', ['name', 'value', 'attributes', 'labelName', 'wrapped' => false]);

        Form::component('adminTextarea', 'admin.partials.form.components.textarea', ['name', 'value', 'options', 'labelName', 'wrapped' => true]);
        Form::component('adminTextareaUnwrapped', 'admin.partials.form.components.textarea', ['name', 'value', 'options', 'labelName', 'wrapped' => false]);

        Form::component('adminWysiwyg', 'admin.partials.form.components.wysiwyg', ['name', 'value', 'options', 'labelName', 'wrapped' => true]);
        Form::component('adminWysiwygUnwrapped', 'admin.partials.form.components.wysiwyg', ['name', 'value', 'options', 'labelName', 'wrapped' => false]);

        Form::component('adminEmail', 'admin.partials.form.components.email', ['name', 'value', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminEmailUnwrapped', 'admin.partials.form.components.email', ['name', 'value', 'attributes', 'labelName', 'wrapped' => false]);

        Form::component('adminPassword', 'admin.partials.form.components.password', ['name', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminPasswordUnwrapped', 'admin.partials.form.components.password', ['name', 'attributes', 'labelName', 'wrapped' => false]);

        Form::component('adminSelect', 'admin.partials.form.components.select', ['name', 'list', 'selected', 'selectAttributes', 'labelName', 'optionsAttributes', 'optgroupsAttributes', 'wrapped' => true]);
        Form::component('adminSelectUnwrapped', 'admin.partials.form.components.select', ['name', 'list', 'selected', 'selectAttributes', 'labelName', 'optionsAttributes', 'optgroupsAttributes', 'wrapped' => false]);

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

        Form::component('adminImages', 'admin.partials.form.components.images', ['name', 'value', 'multiple', 'type', 'attributes', 'labelName', 'wrapped' => true]);
        Form::component('adminImagesUnwrapped', 'admin.partials.form.components.images', ['name', 'value', 'multiple', 'type', 'attributes', 'labelName', 'wrapped' => false]);
    }
}
