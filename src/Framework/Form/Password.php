<?php

namespace Framework\Form;

class Password extends Element
{
    public function render()
    {
        echo <<<ELEMENT
            <label for="{$this->name}">{$this->getLabelName()}</label>
            <input type="password" name="{$this->name}" {$this->transformAttributes()}>
ELEMENT;
    }
}
