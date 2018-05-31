<?php

namespace App\FormRenderers;

use Kris\LaravelFormBuilder\Form;

abstract class AbstractRenderer
{
    protected $form;

    protected $notFoundTabName = 'Основное';

    public function __construct(Form $form, $options = [])
    {
        $this->form = $form;
        $this->notFoundTabName = array_get($options, 'not_found_tab_name', $this->notFoundTabName);
    }

    public function build()
    {
        return [];
    }

    public function render()
    {
        $data = $this->build();

        $data = $this->addNotFoundFieldsToData($data);

        $tabs = $this->getTabs($data);

        $tabs = $this->addRowsToTabs($tabs);

        if (count($tabs) > 1) {
            return $this->buildTabsHtml($tabs);
        } elseif (count($tabs)) {
            return $tabs[array_keys($tabs)[0]]['rowsHtml'];
        }
        return '';
    }

    protected function addNotFoundFieldsToData($data)
    {
        $fields = array_keys($this->form->getFields());
        $foundFields = [];
        foreach ($data as $tabKey => $tabData) {
            foreach (array_get($tabData, 'rows', []) as $rowKey => $row) {
                foreach ($row as $field => $fieldParams) {
                    $foundFields[] = $field;
                }
            }
        }
        $notFoundFields = array_diff($fields, $foundFields);
        if (count($notFoundFields)) {
            $notFoundRows = [];
            foreach ($notFoundFields as $notFoundField) {
                $notFoundRows[] = [
                    $notFoundField => [],
                ];
            }
            $notFoundTabKey = null;
            foreach ($data as $tabKey => $tabData) {
                if (array_get($tabData, 'title') == $this->notFoundTabName) {
                    $notFoundTabKey = $tabKey;
                    break;
                }
            }
            if ($notFoundTabKey === null) {
                $notFoundTabKey = count($data);
            }
            $data[$notFoundTabKey]['title'] = array_get($data, $notFoundTabKey . '.title', $this->notFoundTabName);
            $data[$notFoundTabKey]['rows'] = array_merge(array_get($data, $notFoundTabKey . '.rows', []), $notFoundRows);
        }
        return $data;
    }

    protected function getTabs($data)
    {
        $tabs = [];
        foreach ($data as $tabKey => $tabData) {
            $tabTitle = array_get($tabData, 'title', '');
            $tabSlug = str_slug($tabTitle) . str_random();
            $tabs[$tabSlug] = [
                'title' => $tabTitle,
                'rowsHtml' => '',
                'rows' => array_get($tabData, 'rows', []),
            ];
        }
        return $tabs;
    }

    protected function addRowsToTabs($tabs)
    {
        foreach ($tabs as $tabSlug => $tabData) {
            foreach ($tabData['rows'] as $rowKey => $row) {
                $rowHtml = '<div class="row">';
                foreach ($row as $field => $fieldParams) {
                    $colClass = 'col';
                    if ($colSize = array_get($fieldParams, 'size')) $colClass .= ' col-' . $colSize;
                    if ($colSizeSm = array_get($fieldParams, 'size-sm')) $colClass .= ' col-sm-' . $colSizeSm;
                    if ($colSizeMd = array_get($fieldParams, 'size-md')) $colClass .= ' col-md-' . $colSizeMd;
                    if ($colSizeLg = array_get($fieldParams, 'size-lg')) $colClass .= ' col-lg-' . $colSizeLg;
                    if ($colSizeXl = array_get($fieldParams, 'size-xl')) $colClass .= ' col-xl-' . $colSizeXl;
                    $colHtml = '<div class="' . $colClass . '">' . form_rows($this->form, [$field]) . '</div>';
                    $rowHtml .= $colHtml;
                }
                $rowHtml .= '</div>';
                $tabs[$tabSlug]['rowsHtml'] .= $rowHtml;
            }
        }
        return $tabs;
    }

    protected function buildTabsHtml($tabs)
    {
        $html = '<ul class="nav nav-tabs mb-4" role="tablist">';
        $tabKey = 0;
        foreach ($tabs as $tabSlug => $tabData) {
            $html .= '<li class="nav-item">';
            $html .= '<a class="nav-link ' . ($tabKey == 0 ? 'active' : '') . '" data-toggle="tab" href="#' . $tabSlug . '" role="tab">' . $tabData['title'] . '</a>';
            $html .= '</li>';
            $tabKey++;
        }
        $html .= '</ul>';

        $html .= '<div class="tab-content">';
        $tabKey = 0;
        foreach ($tabs as $tabSlug => $tabData) {
            $html .= '<div class="tab-pane fade ' . ($tabKey == 0 ? 'show active' : '') . '" id="' . $tabSlug . '">';
            $html .= $tabData['rowsHtml'];
            $html .= '</div>';
            $tabKey++;
        }
        $html .= '</div>';
        return $html;
    }
}