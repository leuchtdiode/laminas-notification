<?php
namespace Notification\Channel\Handler;

use Exception;

class Mattermost implements Handler
{
	const MAXIMUM_TEXT_LENGTH = 4000;

	/**
	 * @param HandleData $data
	 * @throws Exception
	 */
	public function handle(HandleData $data)
	{
		$options = $data->getOptions();
		$content = $data->getData();

		foreach ($content as $item)
		{
			$ch = curl_init();

			$body = json_encode(
				[
					'text' => $this->sanitizeText($item)
				]
			);

			curl_setopt($ch, CURLOPT_URL, $options['hook']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt(
				$ch,
				CURLOPT_HTTPHEADER,
				[
					'Content-Type: application/json',
					'Content-Length: ' . strlen($body)
				]
			);
			curl_setopt(
				$ch, CURLOPT_POSTFIELDS,
				$body
			);

			curl_exec($ch);

			curl_close($ch);
		}
	}

	/**
	 * @param $text
	 *
	 * @return string
	 */
	private function sanitizeText($text)
	{
		return strlen($text) > self::MAXIMUM_TEXT_LENGTH
			? substr($text, 0, self::MAXIMUM_TEXT_LENGTH - 3) . '...'
			: $text;
	}
}