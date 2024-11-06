<?php

namespace App\Helpers;

class  TextSelectedHelper
{

    public function view($values = [], $data = [], $value = null)
    {
        $html = "";
        foreach ($data as $item) {
            if ($item[$values["id"]] == $value)
                $html .= $item[$values["name"]];
        }

        return $html;
    }
}
