<?php

namespace Framework\Form;

class Checkbox extends Element
{
    public function render()
    {
        $checked = ($this->getValue()) ? 'checked' : '';

        echo <<<ELEMENT
            <input type="checkbox" name="{$this->name}" {$checked} {$this->transformAttributes()}>
            <label for="{$this->name}">{$this->getLabelName()}</label>
ELEMENT;
    }
}
