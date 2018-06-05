<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

abstract class AbstractForm extends Form
{
    public function getPresenters()
    {
        return [];
    }

    public function present($name)
    {
        $presenters = $this->getPresenters();
        $presenter = new $presenters[$name]($this);
        return $presenter->render();
    }
}