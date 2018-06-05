<?php

namespace App\Form\Presenters;

use App\FormPresenter\AbstractPresenter;
use App\FormPresenter\Tab;
use App\FormPresenter\Row;

class PagePresenter extends AbstractPresenter
{

    public function build()
    {
        $this
            ->addTab(function (Tab $tab) {
                $tab->addRow(function (Row $row) {
                    $row
                        ->addField('is_disabled', ['size' => 3]);
                });
                $tab->addRow(function (Row $row) {
                    $row
                        ->addField('custom_attributes[title]', ['size' => 6])
                        ->addField('slug', ['size' => 6]);
                });
                $tab->addRow(function (Row $row) {
                    $row
                        ->addField('custom_attributes[content]');
                });
            }, 'Основное');
        $this->addTab(function (Tab $tab) {
            $tab->addRow(function (Row $row) {
                $row
                    ->addField('custom_attributes[meta_title]', ['size' => 8]);
            });
            $tab->addRow(function (Row $row) {
                $row
                    ->addField('custom_attributes[meta_description]');
            });
        }, 'Meta');
    }
}
