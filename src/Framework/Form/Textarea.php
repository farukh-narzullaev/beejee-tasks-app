<?php

namespace Framework\Form;

class Textarea extends Element
{
    public function render()
    {
        echo <<<ELEMENT
            <label for="{$this->name}">{$this->getLabelName()}</label>
            <textarea name="{$this->name}" {$this->transformAttributes()}>{$this->getValue()}</textarea>
ELEMENT;
    }
}
