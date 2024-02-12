<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class BanAction extends AbstractAction
{

    /**
     * [Description for getTitle]
     *
     * @return string
     * 
     */
    public function getTitle(): string
    {
        return "Ban";
    }

    /**
     * [Description for getIcon]
     *
     * @return string
     * 
     */
    public function getIcon(): string
    {
        return "voyager-terminal";
    }

    /**
     * [Description for getAttributes]
     *
     * @return array<string,string>
     * 
     */
    public function getAttributes(): array
    {
        return [
            'class' => 'btn btn-sm btn-danger pull-right ban'
        ];
    }

    /**
     * [Description for getDefaultRoute]
     *
     * @return string
     * 
     */
    public function getDefaultRoute(): string
    {
        return route($this->dataType->slug . '.ban', $this->data->{$this->data->getKeyName()});
    }


    /**
     * [Description for shouldActionDisplayOnDataType]
     *
     * @return bool
     * 
     */
    public function shouldActionDisplayOnDataType(): bool
    {
        return $this->dataType->slug === 'users';
    }
}
