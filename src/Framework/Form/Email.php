<?php

namespace Framework\Form;

class Email extends Element
{
    public function render()
    {
        echo <<<ELEMENT
            <label for="{$this->name}">{$this->getLabelName()}</label>
            <input type="email" name="{$this->name}" value="{$this->getValue()}" {$this->transformAttributes()}>
ELEMENT;
    }
}
