<?php

class JsonHelper {

    public static function json_validator($data)
    {
        return is_string($data) &&
            is_array(json_decode($data, true)) ? true : false;
    }
}