<?php

/**
 * 
 * ClientEngage: ClientEngage TodoMonkey (http://www.clientengage.com)
 * Copyright 2014, ClientEngage (http://www.clientengage.com)
 *
 * You must have purchased a valid license from CodeCanyon in order to have 
 * the permission to use this file.
 * 
 * You may only use this file according to the respective licensing terms 
 * you agreed to when purchasing this item on CodeCanyon.
 * 
 * 
 * 
 *
 * @author          ClientEngage <contact@clientengage.com>
 * @copyright       Copyright 2014, ClientEngage (http://www.clientengage.com)
 * @link            http://www.clientengage.com ClientEngage
 * @since           ClientEngage - TodoMonkey v 1.0
 * 
 */
/**
 * The main configuration file for TodoMonkey
 */

define('TODOMONKEY_CONFIG', APP . 'Config' . DS . 'settings.php');

/**
 * The default TodoMonkey configuration
 */
define('TODOMONKEY_CONFIG_DEFAULT', APP . 'Config' . DS . 'default_settings.php');

/**
 * The TodoMonkey theme directory
 */
define('TODOMONKEY_THEMES', APP . 'webroot' . DS . 'css' . DS . 'todomonkey' . DS . 'themes' . DS);

/**
 * The TodoMonkey uploads directory
 */
define('TODOMONKEY_UPLOADS', APP . WEBROOT_DIR . DS . 'uploads' . DS . 'userfiles' . DS);

define('UPLOADS_AVATAR', APP . WEBROOT_DIR . DS . 'uploads' . DS . 'avatar' . DS);


/**
 * Enumeration of Flash-Message types
 */
final class Flash
{

    /**
     * Indicates that an error occured
     */
    const Error = 'flashmessages/error';

    /**
     * Generic flash style for informational purposes
     */
    const Info = 'flashmessages/info';

    /**
     * Indicates that the performed operation was successful
     */
    const Success = 'flashmessages/success';

    /**
     * Indiates a warning
     */
    const Warning = 'flashmessages/warning';

}

/**
 * Contains all available languages
 */
class AppLanguages
{

    /**
     * Returns an array of all currently available languages
     * @return array
     */
    public static function getAll()
    {
        return array(
            'en-gb' => __('English (British)'),
            'en-us' => __('English (United States)'),
            'deu' => __('German (Germany)'),
                //'por' => __('Portuguese'),
                //'rus' => __('Russian'),
                //'fra' => __('French'),
                //'spa' => __('Spanish'),
                //'dut' => __('Dutch'),
                //'pol' => __('Polish'),
                //'swe' => __('Swedish'),
                //'dan' => __('Danish'),
        );
    }

    /**
     * Sets the locale according to the currently set language
     */
    public static function setLocale()
    {
        $lang = Configure::read('Config.language');

        foreach (self::$dateFormats as $format)
        {
            if (in_array($lang, $format['aliases']))
            {
                setlocale(LC_TIME, $format['locales']);
            }
        }
    }

    /**
     * Contains locale fallbacks and DateTime formats
     * @var array 
     */
    private static $dateFormats = array(
        'en' => array(
            'aliases' => array('en-gb', 'en-us'),
            'locales' => array('en-gb', 'en-us', 'en', 'eng'),
            'default' => '',
            'nice' => '%a, %e. %b. %Y, %H:%M',
            'wordFormat' => 'j/n/y',
            'niceShort' => '%d/%m, %H:%M',
        ),
        'deu' => array(
            'aliases' => array('deu'),
            'locales' => array('deu', 'de_de'),
            'default' => '',
            'nice' => '%a, %e. %b. %Y, %H:%M',
            'wordFormat' => 'j.n.y',
            'niceShort' => '%d/%m, %H:%M',
        ),
        'por' => array(
            'aliases' => array('por'),
            'locales' => array('por', 'Portuguese_Portugal'),
            'default' => '',
            'nice' => '%e %B, %Y, %H:%M',
            'wordFormat' => 'j/n/y',
            'niceShort' => '%d/%m, %H:%M',
        ),
        'rus' => array(
            'aliases' => array('rus'),
            'locales' => array('rus', 'Russian_Russia'),
            'default' => '',
            'nice' => '%d.%m.%Y, %H:%M',
            'wordFormat' => 'j.n.y',
            'niceShort' => '%d.%m., %H:%M',
        ),
    );

    /**
     * Returns the respective DateTime format for the currently set system language
     * @param string $type DateTime format type to return
     * @return string The DateTime format
     */
    public static function getDateFormat($type = 'nice')
    {
        $lang = Configure::read('Config.language');

        foreach (self::$dateFormats as $format)
        {
            if (in_array($lang, $format['aliases']))
            {
                return $format[$type];
            }
        }

        $default = array(
            'nice' => '%d.%m.%Y, %H:%M',
            'wordFormat' => 'j.n.y',
            'niceShort' => '%d.%m., %H:%M'
        );

        return $default['nice'];
    }

}

/**
 * A collection of different DateTime formats
 */
class DateFormats
{

    const Nice = 'nice';
    const NiceShort = 'niceShort';
    const WordFormat = 'wordFormat';

}

/**
 * A collection of app-wide utility functions for working with data types
 */
class AppLib
{

    /**
     * ClientEngage Website Url
     */
    const AppUrl = 'http://www.clientengage.com';

    /**
     * Returns a readily useable CakeEmail object
     * @return CakeEmail
     */
    public static function prepareEmail()
    {
        App::uses('CakeEmail', 'Network/Email');

        $config = array('template' => 'default', 'layout' => 'default');

        if (Configure::read('debug') > 0)
        {
            $config = Hash::merge($config, array('log' => true));
        }

        if (AppConfig::read('Email.transport') == 'smtp')
        {
            $config = Hash::merge($config, array(
                        'host' => AppConfig::read('Email.host'),
                        'port' => AppConfig::read('Email.port'),
                        'username' => AppConfig::read('Email.username'),
                        'password' => AppConfig::read('Email.password'),
                        'transport' => 'Smtp',
            ));
        }

        $email = new CakeEmail($config);

        if (Configure::read('debug') > 0)
        {
            $email->transport('Debug');
        }

        $email->from(AppConfig::read('Email.email'), AppConfig::read('Email.sender'))
                ->emailFormat('both')
                ->setHeaders(array('X-Mailer' => 'ClientEngage Mailer'))
                ->returnPath(AppConfig::read('Email.email'), AppConfig::read('Email.sender'));

        return $email;
    }

}

/**
 * Handles the application configuration
 */
class AppConfig
{

    private static $isSetup = false;

    /**
     * Reads the application configuration
     * @param string $configKey The configuration key to be read
     * @return dynamic The configuration
     */
    public static function read($configKey = null)
    {
        if (!self::$isSetup)
        {
            $config = array();
            $config['Setting'] = self::getRawConfig();

            if (isset($config['Setting']) && is_array($config['Setting']))
            {
                foreach ($config['Setting'] as $k => $val)
                {
                    $cKey = str_replace('-', '.', $k);
                    Configure::write('AppConfig.' . $cKey, $val);
                }
            }

            self::$isSetup = true;
        }

        if ($configKey === null)
        {
            return Configure::read('AppConfig');
        }
        else
        {
            return Configure::read('AppConfig.' . $configKey);
        }
    }

    /**
     * Reads the app's settings and conditionally merges-in any unset 
     * configurations.
     * @return array
     */
    public static function getRawConfig()
    {
        $defaultConfig = require(TODOMONKEY_CONFIG_DEFAULT);
        $userConfig = require(TODOMONKEY_CONFIG);
        foreach ($userConfig as $key => $val)
        {
            if (trim($val) === '')
            {
                unset($userConfig[$key]);
            }
        }
        $config = Hash::merge($defaultConfig, $userConfig);

        return $config;
    }

    public static function useCaptcha()
    {
        return AppConfig::read('System.captcha_publicKey') && AppConfig::read('System.captcha_privateKey');
    }

}

App::uses('AuthComponent', 'Controller/Component');

/**
 * Convenience-wrapper for AuthComponent
 */
class AppAuth extends AuthComponent
{

    public static function isAdmin()
    {
        return self::user('role') === 'admin';
    }

}
