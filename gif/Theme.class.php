<?php
/**
 * Created by PhpStorm.
 * User: MorBro
 * Date: 2020/4/8
 * Time: 21:30
 * Desc: 主题
 */

const THEME_DEFAULT = 0;

class Theme {

    private static $_themes;

    function get_theme($theme){
        self::$_themes = [
            '0'=> './theme/countdown.png',
            '1'=> './theme/countdown2.png',
        ];
        return isset(self::$_themes[$theme]) ? self::$_themes[$theme] : self::$_themes[THEME_DEFAULT];
    }
}