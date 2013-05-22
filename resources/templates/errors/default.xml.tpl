<?
/**
 * @param string  $error   Ошибка
 * @param string  $message Сообщение
 * @param integer $code    Код ошибки
 * @param boolean $debug   Режим отладки
 */
?>
<?='<?xml version="1.1" encoding="utf-8"?>'?>
<root>
	<code><?=self::escape($code)?></code>
	<error><?=self::escape($error)?></error>
	<message><?=self::escape($message)?></message>
</root>
