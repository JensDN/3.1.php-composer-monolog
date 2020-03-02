<?php
var_dump($_GET);

require_once(__DIR__.'/vendor/autoload.php');
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\NativeMailerHandler;

// Create the logger
$logger = new Logger('MyFirstLogger');
// Now add some handlers
switch($_GET['type']){
    case 'DEBUG':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/info.log', Logger::DEBUG));
        $logger->pushHandler(new BrowserConsoleHandler());
        $logger->debug($_GET['message']);
        break;
    case 'INFO':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/info.log', Logger::INFO));
        $logger->pushHandler(new BrowserConsoleHandler());
        $logger->info($_GET['message']);
        break;
    case 'NOTICE':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/info.log', Logger::NOTICE));
        $logger->pushHandler(new BrowserConsoleHandler());
        $logger->notice($_GET['message']);
        break;
    case 'WARNING':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::WARNING));
        $logger->warning($_GET['message']);
        break;
    case 'ERROR':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::ERROR));
        $logger->pushHandler(new NativeMailerHandler('error@sicko.com' , (string)$_GET['message'] ,'me@me.dev', LOGGER::ERROR));
        $logger->error($_GET['message']);
        break;
    case 'CRITICAL':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::CRITICAL));
        $logger->pushHandler(new NativeMailerHandler('error@sicko.com' , (string)$_GET['message'] ,'me@me.dev', Logger::CRITICAL));
        $logger->critical($_GET['message']);
        break;
    case 'ALERT':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/warning.log', Logger::ALERT));
        $logger->pushHandler(new NativeMailerHandler('error@sicko.com' , (string)$_GET['message'] ,'me@me.dev', Logger::ALERT));
        $logger->alert($_GET['message']);
        break;
    case 'EMERGENCY':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/emergency.log', Logger::EMERGENCY));
        $logger->pushHandler(new NativeMailerHandler('error@sicko.com' , (string)$_GET['message'] ,'me@me.dev', Logger::EMERGENCY));
        $logger->emergency($_GET['message']);
        break;
    default:
        echo 'no error log';
        break;
}

//The secret Koen way is Logger:addrecord();
/*/**
  * {@InheritDoc}
  */
// example:
/* public static function log($message, $level = Logger::INFO, $context = array())
 {
     static $_firstRun = true;
     if ($_firstRun || !static::$_logFileValid) {
         static::_checkLogFile();
         $_firstRun = false;
     }
     //	Get the indent, if any
     $_unindent = ($_newIndent = static::_processMessage($message)) > 0;
     //	Indent...
     if (0 > ($_tempIndent = static::$_currentIndent - ($_unindent ? 1 : 0))) {
         $_tempIndent = 0;
     }
     $_message = str_repeat('  ', $_tempIndent) . $message;
     if (!is_numeric($level)) {
         $level = LoggingLevels::toNumeric($level);
     }
     if (static::$_logger) {
         static::$_logger->addRecord($level, $_message, !is_array($context) ? array() : $context);
     } elseif (static::$_fallbackLogger) {
         static::$_fallbackLogger->addRecord($level, $_message, $context);
     }
     //	Set indent level...
     static::$_currentIndent += $_newIndent;
     //	Anything over a warning returns false so you can chain
     return Logger::WARNING > $level;*/
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logger</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
</head>
<body>
<form method="get">
    <h1>Using Monolog with Composer</h1>

    <input type="text" name="message" placeholder="My log message" class="form-control" required />

    <button type="submit" name="type" value="DEBUG" class="btn btn-info">DEBUG (100): Detailed debug information.</button>
    <button type="submit" name="type" value="INFO" class="btn btn-info">INFO (200): Interesting events. Examples: User logs in, SQL logs.
    </button>
    <button type="submit" name="type" value="NOTICE" class="btn btn-info">NOTICE (250): Normal but significant events.
    </button>
    <button type="submit" name="type" value="WARNING" class="btn btn-warning">WARNING (300): Exceptional occurrences that are not errors. Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
    </button>
    <button type="submit" name="type" value="ERROR" class="btn btn-danger">ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.
    </button>
    <button type="submit" name="type" value="CRITICAL" class="btn btn-danger">CRITICAL (500): Critical conditions. Example: Application component unavailable, unexpected exception.
    </button>
    <button type="submit" name="type" value="ALERT" class="btn btn-danger">ALERT (550): Action must be taken immediately. Example: Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
    </button>
    <button type="submit" name="type" value="EMERGENCY" class="btn btn-dark">EMERGENCY (600): Emergency: system is unusable.
    </button>
</form>

<style>
    button {
        display: block;
        margin: 12px 0px;
    }
</style>








</body>
</html>
