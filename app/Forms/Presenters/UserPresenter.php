<?php

namespace App\Forms\Presenters;

use App\FormPresenter\AbstractPresenter;
use App\FormPresenter\Row;
use App\FormPresenter\Tab;

class UserPresenter extends AbstractPresenter
{

    public function build()
    {
        $this->addTab(function (Tab $tab) {
            $tab->addRow(function (Row $row) {
                $row
                    ->addField('first_name', ['size' => 4])
                    ->addField('last_name', ['size' => 4])
                    ->addField('middle_name', ['size' => 4]);
            });
        }, 'Основное');
    }
}
