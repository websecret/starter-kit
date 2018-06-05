<?php

namespace App\FormPresenter;

class Tab
{
    protected $presenter;
    protected $name;
    protected $slug;

    protected $rows = [];

    public function __construct(AbstractPresenter $presenter, $name = null)
    {
        $this->presenter = $presenter;
        $name = is_null($name) ? 'Данные' : $name;
        $this->name = $name;
        $this->slug = str_slug($name) . '-' . str_random();
    }

    public function getPresenter()
    {
        return $this->presenter;
    }

    public function addRow(\Closure $closure)
    {
        $row = new Row($this);
        $this->rows[] = $row;
        return $closure($row);
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function renderRows()
    {
        return view('admin.partials.form.presenter.rows', [
            'rows' => $this->rows,
        ]);
    }
}