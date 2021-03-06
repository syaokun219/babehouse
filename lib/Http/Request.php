<?php

class Http_Request {
    private static $_data = null;
    private static $_ready = false;
    private static $_ui_class = null;

    private static function _init() {
        $request_uri = $_SERVER['REQUEST_URI'];
        $query_string = explode('/', $request_uri);
        $cnt = count($query_string);
        self::$_ui_class = "";
        for($i=3; $i<$cnt-1; $i++) {
            self::$_ui_class[] = $query_string[$i];
        }
        $last_uri = explode('?', $query_string[$cnt-1]);
        self::$_ui_class [] = $last_uri[0];
        if (1 < count($last_uri)) {
            $tmp_get = explode('&', $last_uri[1]);
            foreach($tmp_get as $v) {
                $tmp = explode("=", $v);
                self::$_data[$tmp[0]] = $tmp[1];
            }
        }
        foreach($_POST as $k => $v) {
            self::$_data[$k] = $v;
        }
        foreach($_GET as $k => $v) {
            self::$_data[$k] = $v;
        }
        self::$_ready = true;
    }

    public static function getUri() {
        return $_SERVER['REQUEST_URI'];
    }

    public static function getUi() {
        if (!self::$_ready) {
            self::_init();
        }
        return self::$_ui_class;
    }

    public static function get($field, $default_value = null) {
        if (!self::$_ready) {
            self::_init();
        }
        if(isset(self::$_data[$field])) {
            return self::$_data[$field];
        } else {
            return $default_value;
        }
    }

    /**
     * @brief 
     *
     * @return 
     */
    public static function getAll() {
        return self::$_data;
    }

    public static function getUserIp() {
    }

}
