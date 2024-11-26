<?php
namespace Notification\Channel\Handler;

class MicrosoftPowerAutomate implements Handler
{
	const MAXIMUM_TEXT_LENGTH = 6000;

	public function handle(HandleData $data): void
	{
		$options = $data->getOptions();
		$content = $data->getData();

		foreach ($content as $item)
		{
			if (!($text = $this->sanitizeText($item)))
			{
				continue;
			}

			$ch = curl_init();

			$body = json_encode([
				'text' => $text,
			]);

			curl_setopt($ch, CURLOPT_URL, $options['hook']);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt(
				$ch,
				CURLOPT_HTTPHEADER,
				[
					'Content-Type: application/json',
				]
			);
			curl_setopt(
				$ch,
				CURLOPT_POSTFIELDS,
				$body
			);

			if (($proxy = $options['proxy'] ?? null))
			{
				curl_setopt($ch, CURLOPT_PROXY, $proxy);
			}

			curl_exec($ch);

			curl_close($ch);
		}
	}

	private function sanitizeText(string $text): string
	{
		return strlen($text) > self::MAXIMUM_TEXT_LENGTH
			? substr($text, 0, self::MAXIMUM_TEXT_LENGTH - 3) . '...'
			: $text;
	}
}