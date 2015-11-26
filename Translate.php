<?php

namespace Dreamcoil;

class Translate
{
    private $lang;

    public function setLang($lang)
    {

        $this->lang = $lang;

        setcookie('lang', $lang, time() * 2);

    }

    public function get($key, $lang = null)
    {

        $config = new \Dreamcoil\Config;

        $key = explode('.',$key);

        $fallback = $config->get('fallback_lang');

        if($lang === null)
        {

            if(!file_exists( __DIR__ . '/../files/Translations/' . $fallback . '/'. $key[0] . '.php'))
                return implode('.', $key);

            $lang = include __DIR__ . '/../files/Translations/' . $fallback . '/'. $key[0] . '.php';

            if(isset($lang[$key[1]])) return $lang[$key[1]];

            return implode('.', $key);

        }

        if(!file_exists( __DIR__ . '/../files/Translations/' . $lang . '/'. $key[0] . '.php'))
            return implode('.', $key);

        $lang = include __DIR__ . '/../files/Translations/' . $lang . '/'. $key[0] . '.php';

        if(isset($lang[$key[1]])) return $lang[$key[1]];

        return implode('.', $key);

    }

    public function say($key, $lang = null)
    {

        echo Translate::get($key, $lang);

        return null;

    }

}
