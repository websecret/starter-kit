<?php

namespace App\FormPresenter;

use Kris\LaravelFormBuilder\Form;

abstract class AbstractPresenter
{
    protected $form;
    protected $tabs = [];

    protected $notFoundTabName = null;

    protected function getNotFoundTabName()
    {
        return 'Основное';
    }

    protected function isNotFoundFieldsRenders()
    {
        return true;
    }

    public function __construct(Form $form, $options = [])
    {
        $this->form = $form;
        $this->notFoundTabName = array_get($options, 'not_found_tab_name', $this->getNotFoundTabName());
    }

    public function getForm()
    {
        return $this->form;
    }

    abstract public function build();

    public function render()
    {

        $this->build();

        if ($this->isNotFoundFieldsRenders()) {
            $this->addNotFoundFields();
        }

        $html = '';

        if(count($this->tabs) > 1) {
            $html .= $this->renderTabsHeader();
            $html .= $this->renderTabsContent();
        } elseif(count($this->tabs)) {
            $html .= head($this->tabs)->renderRows();
        }

        return $html;
    }

    protected function renderTabsHeader()
    {
        return view('admin.partials.form.presenter.tabs-nav', [
            'tabs' => $this->tabs,
        ]);
    }

    protected function renderTabsContent()
    {
        return view('admin.partials.form.presenter.tabs-content', [
            'tabs' => $this->tabs,
        ]);
    }

    protected function addNotFoundFields()
    {

        $fields = array_keys($this->form->getFields());
        $foundFields = array_keys($this->getFieldsList());
        $notFoundFields = array_diff($fields, $foundFields);
        if (count($notFoundFields)) {
            foreach ($notFoundFields as $notFoundField) {
                $this->addTab(function (Tab $tab) use ($notFoundField) {
                    $tab->addRow(function (Row $row) use ($notFoundField) {
                        $row->addField($notFoundField);
                    });
                }, $this->notFoundTabName);
            }
        }
    }

    public function addTab(\Closure $closure, $name)
    {
        if (isset($this->tabs[$name])) {
            $tab = $this->tabs[$name];
        } else {
            $tab = new Tab($this, $name);
            $this->tabs[$name] = $tab;
        }
        return $closure($tab);
    }

    public function getFieldsList()
    {
        $fields = [];
        foreach ($this->tabs as $tabKey => $tab) {
            foreach ($tab->getRows() as $row) {
                foreach ($row->getFields() as $field => $fieldParams) {
                    $fields[$field] = $fieldParams;
                }
            }
        }
        return $fields;
    }
}