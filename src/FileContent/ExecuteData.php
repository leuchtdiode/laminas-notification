<?php
namespace Notification\FileContent;

class ExecuteData
{
	/**
	 * @var array
	 */
	private $files = [];

	/**
	 * @return self
	 */
	public static function create()
	{
		return new self();
	}

	/**
	 * @return array
	 */
	public function getFiles(): array
	{
		return $this->files;
	}

	/**
	 * @param array $files
	 * @return ExecuteData
	 */
	public function setFiles(array $files): ExecuteData
	{
		$this->files = $files;
		return $this;
	}
}