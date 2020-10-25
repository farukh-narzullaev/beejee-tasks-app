<?php

namespace Framework\Form;

class Text extends Element
{
    public function render()
    {
        echo <<<ELEMENT
            <label for="{$this->name}">{$this->getLabelName()}</label>
            <input type="text" name="{$this->name}" value="{$this->getValue()}" {$this->transformAttributes()}>
ELEMENT;
    }
}
