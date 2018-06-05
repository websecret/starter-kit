<?php namespace App\Forms;

use App\Form\Presenters\PagePresenter;
use Illuminate\Validation\Rule;

class PageForm extends AbstractForm
{
    public function getPresenters()
    {
        return [
            'admin' => PagePresenter::class,
        ];
    }

    public function buildForm()
    {
        $this
            ->add('is_disabled', 'boolean', [
                'rules' => [
                    'required',
                ],
            ])
            ->add('custom_attributes[title]', 'translatable-text', [
                'label' => __('labels.title'),
                'rules' => [
                    'required',
                ],
            ])
            ->add('slug', 'slug', [
                'slug' => [
                    'from' => ['custom_attributes[title]'],
                    'locked' => $this->getModel()->exists,
                ],
                'rules' => [
                    'required',
                    Rule::unique('pages')->ignoreModel($this->getModel()),
                ],
            ])
            ->add('custom_attributes[content]', 'translatable-wysiwyg', [
                'label' => __('labels.content'),
                'rules' => [
                    'required',
                ],
            ])
            ->add('custom_attributes[meta_title]', 'translatable-text', [
                'label' => __('labels.meta_title'),
            ])
            ->add('custom_attributes[meta_description]', 'translatable-textarea', [
                'label' => __('labels.meta_description'),
            ]);
    }
}