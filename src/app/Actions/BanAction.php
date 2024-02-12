<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class BanAction extends AbstractAction {

    public function getTitle()
    {
        return "Ban";
    }

    public function getIcon()
    {
        return "voyager-terminal";
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-danger pull-right ban'
        ];
    }

    public function getDefaultRoute()
    {
        return route($this->dataType->slug . '.ban', $this->data->{$this->data->getKeyName()});
    }


    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug === 'users';
    }

}