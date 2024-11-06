<?php

namespace App\Helpers;

class  ComboboxHelper
{

    public function view($id, $required, $values = [], $data = [], $value = null)
    {
        $html = "";
        $html .= '<select class="form-select" id="situacao" name="situacao"';
        $html .= $required ? ' required ' : '';
        $html .= ' >';
        foreach ($data as $item) {
            $html .= '    <option value="' . $item[$values["id"]] . '">' . $item[$values["name"]] . '</option>';
        }
        $html .= '</select>';

        return $html;
    }
}
