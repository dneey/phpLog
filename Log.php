<?php

namespace App;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SlackWebhookHandler;


class Log
{
public static $logger;
public static $channel = '';
public static $logFileName = 'application.log';
public static $slackWebHook = '';
public static $slackChannel = '';
public static $slackSenderName = '';

    public static function setup()
    {
        self::$logger = new Logger('logger');
        if (self::$channel == 'file') {
            $fileHandler = new StreamHandler(__DIR__ . self::$logFileName , Logger::API);
            self::$logger->pushHandler($fileHandler);
        }elseif(self::$channel == 'slack'){
            $webhookUrl = self::$slackWebHookUrl;
            $slackHandler = new SlackWebhookHandler($webhookUrl, self::$slackChannel, self::$slackSenderName, false, 'warning', true, true, Logger::API);
            self::$logger->pushHandler($slackHandler);
        }else{
            $fileHandler = new StreamHandler(__DIR__ . self::$logFileName , Logger::API);
            self::$logger->pushHandler($fileHandler);
        }        
    }

    public static function error($message, $extra = [])
    {
        self::setup();
        self::$logger->error($message, $extra);
    }
    public static function info($message, $extra = [])
    {
        self::setup();
        self::$logger->info($message, $extra);
    }

    public static function notice($message, $extra = [])
    {
        self::setup();
        self::$logger->notice($message, $extra);
    }

    public static function debug($message, $extra = [])
    {
        self::setup();
        self::$logger->notice($message, $extra);
    }
}
