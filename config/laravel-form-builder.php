<?php

return [
    'defaults'      => [
        'wrapper_class'       => 'form-group js-form__wrapper',
        'wrapper_error_class' => 'has-error',
        'label_class'         => 'form-label js-form__input-label',
        'field_class'         => 'form-control js-form__input',
        'help_block_class'    => 'help-block',
        'error_class'         => 'invalid-feedback',
        'required_class'      => 'required'

        // Override a class from a field.
        //'text'                => [
        //    'wrapper_class'   => 'form-field-text',
        //    'label_class'     => 'form-field-text-label',
        //    'field_class'     => 'form-field-text-field',
        //]
        //'radio'               => [
        //    'choice_options'  => [
        //        'wrapper'     => ['class' => 'form-radio'],
        //        'label'       => ['class' => 'form-radio-label'],
        //        'field'       => ['class' => 'form-radio-field'],
        //],
    ],
    // Templates
    'form'          => 'laravel-form-builder::form',
    'text'          => 'laravel-form-builder::text',
    'textarea'      => 'laravel-form-builder::textarea',
    'button'        => 'laravel-form-builder::button',
    'buttongroup'   => 'laravel-form-builder::buttongroup',
    'radio'         => 'laravel-form-builder::radio',
    'checkbox'      => 'laravel-form-builder::checkbox',
    'select'        => 'laravel-form-builder::select',
    'choice'        => 'laravel-form-builder::choice',
    'repeated'      => 'laravel-form-builder::repeated',
    'child_form'    => 'laravel-form-builder::child_form',
    'collection'    => 'laravel-form-builder::collection',
    'static'        => 'laravel-form-builder::static',

    // Remove the laravel-form-builder:: prefix above when using template_prefix
    'template_prefix'   => '',

    'default_namespace' => '',

    'custom_fields' => [
        'custom-password' => App\Forms\Fields\CustomPasswordType::class,
        'translatable-text' => App\Forms\Fields\TranslatableTextType::class,
        'translatable-textarea' => App\Forms\Fields\TranslatableTextareaType::class,
        'translatable-wysiwyg' => App\Forms\Fields\TranslatableWysiwygType::class,
        'slug' => App\Forms\Fields\SlugType::class,
        'boolean' => App\Forms\Fields\BooleanType::class,
        'images' => App\Forms\Fields\ImagesType::class,
    ]
];
