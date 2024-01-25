<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: MIT
 */

class ShBootstrapControls
{
    public static function radio($name, $label, $value, $required = false)
    {
        $id = ShTools::createId(8);
        $attrRequired = $required ? "required" : "";
        return "
            <div class='form-check'>
                <input class='form-check-input' $attrRequired type='radio' name='$name' id='$id' value='$value'>
                <label class='form-check-label' for='$id'>
                    $label
                </label>
            </div>";
    }

    public static function input($name, $label, $value, $placeholder = "", $type = "text", $size="", $required = false) {
        $id = ShTools::createId(8);
        $attrRequired = $required ? "required" : "";
        return "
        <label class='col-auto col-form-label' for='$id'>$label</label>
        <div class='col-auto'>
            <input size='$size' type='$type' $attrRequired class='form-control' id='$id' name='$name' placeholder='$placeholder' value='$value'>
        </div>";
    }
}
