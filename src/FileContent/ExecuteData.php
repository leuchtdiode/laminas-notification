<?php
namespace Notification\FileContent;

class ExecuteData
{
	private array $files = [];

	public static function create(): self
	{
		return new self();
	}

	public function getFiles(): array
	{
		return $this->files;
	}

	public function setFiles(array $files): ExecuteData
	{
		$this->files = $files;
		return $this;
	}
}