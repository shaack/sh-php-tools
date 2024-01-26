<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: MIT
 */

class ShBootstrapControls
{
    public static function radio($name, $label, $value, $required = true)
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

    public static function input($name, $label, $value, $placeholder = "", $type = "text", $size="", $required = true) {
        $attrRequired = $required ? "required" : "";
        return "
        <div class='row gx-2'>
            <label class='col-auto col-form-label' for='$name'>$label</label>
            <div class='col-auto'>
                <input size='$size' type='$type' $attrRequired class='form-control' id='$name' name='$name' placeholder='$placeholder' value='$value'>
            </div>
        </div>";
    }

    public static function select($name, $label, $options, $value, $required = true) {
        $id = ShTools::createId(8);
        $attrRequired = $required ? "required" : "";
        $optionsHtml = "";
        foreach ($options as $optionValue => $optionLabel) {
            $optionsHtml .= "<option value='$optionValue'>$optionLabel</option>";
        }
        $html = "";
        if($label !== null) {
            $html .= "<label for='$name' class='form-label'>$label</label>";
        }
        $html .= "
        <select class='form-select' name='$name' id='$name' $attrRequired>
            <option value=''></option>
            $optionsHtml
        </select>";
        return $html;
    }
}
