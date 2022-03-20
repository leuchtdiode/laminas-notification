<?php
namespace Notification\Channel\Handler;

use Exception;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Smtp as SmtpTransport;
use Laminas\Mail\Transport\SmtpOptions;

class Smtp implements Handler
{
	public function handle(HandleData $data): void
	{
		$options = $data->getOptions();
		$content = $data->getData();

		$message = new Message();
		$message->setSubject($options['subject']);
		$message->setEncoding('UTF-8');
		$message->setBody(implode(PHP_EOL . PHP_EOL, $content));
		$message->setTo($options['recipients']);
		$message->setFrom($options['from']['email'], $options['from']['name']);

		try
		{
			$transport = new SmtpTransport(
				new SmtpOptions($options['transportOptions'])
			);

			$transport->send($message);
		}
		catch (Exception $ex)
		{
			error_log($ex->getMessage());
		}
	}
}