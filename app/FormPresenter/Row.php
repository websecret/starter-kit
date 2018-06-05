<?php

namespace App\FormPresenter;

class Row
{
    protected $tab;
    protected $fields = [];

    public function __construct(Tab $tab)
    {
        $this->tab = $tab;
    }

    public function addField($name, $options = [])
    {
        $this->fields[$name] = $options;
        return $this;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function renderFields()
    {
        $fields = [];
        foreach($this->getFields() as $field => $fieldParams) {
            $fields[$field] = [
                'class' => 'col',
            ];
            if ($colSize = array_get($fieldParams, 'size')) $fields[$field]['class'] .= ' col-' . $colSize;
            if ($colSizeSm = array_get($fieldParams, 'size-sm')) $fields[$field]['class'] .= ' col-sm-' . $colSizeSm;
            if ($colSizeMd = array_get($fieldParams, 'size-md')) $fields[$field]['class'] .= ' col-md-' . $colSizeMd;
            if ($colSizeLg = array_get($fieldParams, 'size-lg')) $fields[$field]['class'] .= ' col-lg-' . $colSizeLg;
            if ($colSizeXl = array_get($fieldParams, 'size-xl')) $fields[$field]['class'] .= ' col-xl-' . $colSizeXl;
        }
        return view('admin.partials.form.presenter.fields', [
            'form' => $this->tab->getPresenter()->getForm(),
            'fields' => $fields,
        ]);
    }
}