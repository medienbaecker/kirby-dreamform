<?php

namespace tobimori\Dreamform\Models;

use Exception;
use Kirby\Cms\App;
use Kirby\Content\Content;
use Kirby\Toolkit\Str;

trait SubmissionMetadata
{
	/**
	 * Returns the metadata content object
	 */
	public function metadata(): Content
	{
		return $this->content()->get('dreamform_sender')->toObject();
	}

	/**
	 * Updates the metadata for the submission
	 */
	public function updateMetadata(array $data): static
	{
		return $this->updateAndSave([
			'dreamform_sender' => $this->metadata()->update($data)->toArray()
		]);
	}

	/**
	 * Collects metadata for the submission
	 */
	public function collectMetadata(): static
	{
		$datapoints = App::instance()->option('tobimori.dreamform.metadata.collect', []);

		foreach ($datapoints as $type) {
			if (method_exists($this, 'collect' . Str::camel($type))) {
				$this->{'collect' . Str::camel($type)}();
				continue;
			}

			throw new Exception('[DreamForm] Unknown metadata type: ' . $type);
		}

		return $this;
	}

	protected function collectIp(): void
	{
		$this->updateMetadata(['ip' => App::instance()->visitor()->ip()]);
	}

	protected function collectUserAgent(): void
	{
		$this->updateMetadata(['userAgent' => App::instance()->visitor()->userAgent()]);
	}
}
