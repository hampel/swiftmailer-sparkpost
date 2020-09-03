<?php namespace Hampel\SparkPostDriver;

class Message extends \Swift_Message
{
	/** @var string */
	protected $start_time;

	/** @var bool */
	protected $open_tracking;

	/** @var bool */
	protected $click_tracking;

	/** @var bool */
	protected $transactional;

	/** @var string */
	protected $ip_pool;

	/** @var string */
	protected $campaign_id;

	/** @var array */
	protected $metadata;

	public function __construct($subject = null, $body = null, $contentType = null, $charset = null, $options = [])
	{
		parent::__construct($subject, $body, $contentType, $charset);
		$this->setOptions($options);
	}

	/**
	 * @param string $start_time
	 */
	public function setStartTime($start_time)
	{
		$this->start_time = strval($start_time);
	}

	/**
	 * @return string|null
	 */
	public function getStartTime()
	{
		return $this->start_time;
	}

	/**
	 * @param bool $open_tracking
	 */
	public function setOpenTracking($open_tracking)
	{
		$this->open_tracking = boolval($open_tracking);
	}

	/**
	 * @return bool|null
	 */
	public function getOpenTracking()
	{
		return $this->open_tracking;
	}

	/**
	 * @param bool $click_tracking
	 */
	public function setClickTracking($click_tracking)
	{
		$this->click_tracking = boolval($click_tracking);
	}

	/**
	 * @return bool|null
	 */
	public function getClickTracking()
	{
		return $this->click_tracking;
	}

	/**
	 * @param bool $transactional
	 */
	public function setTransactional($transactional)
	{
		$this->transactional = boolval($transactional);
	}

	/**
	 * @return bool|null
	 */
	public function getTransactional()
	{
		return $this->transactional;
	}

	/**
	 * @param string $ip_pool
	 */
	public function setIpPool($ip_pool)
	{
		$this->ip_pool = strval($ip_pool);
	}

	/**
	 * @return string|null
	 */
	public function getIpPool()
	{
		return $this->ip_pool;
	}

	/**
	 * @param string $campaign_id
	 */
	public function setCampaignId($campaign_id)
	{
		$this->campaign_id = substr(strval($campaign_id), 0, 64);
	}

	/**
	 * @return string|null
	 */
	public function getCampaignId()
	{
		return $this->campaign_id;
	}

	/**
	 * @param array $metadata
	 */
	public function setMetaData(array $metadata)
	{
		$this->metadata = $metadata;
	}

	/**
	 * @return array|null
	 */
	public function getMetaData()
	{
		return $this->metadata;
	}

	/**
	 * @param array $options
	 */
	public function setOptions(array $options)
	{
		if (!empty($options))
		{
			if (isset($options['options']['start_time'])) $this->start_time = $options['options']['start_time'];
			if (isset($options['options']['open_tracking'])) $this->open_tracking = $options['options']['open_tracking'];
			if (isset($options['options']['click_tracking'])) $this->click_tracking = $options['options']['click_tracking'];
			if (isset($options['options']['transactional'])) $this->transactional = $options['options']['transactional'];
			if (isset($options['options']['ip_pool'])) $this->ip_pool = $options['options']['ip_pool'];
			if (isset($options['campaign_id'])) $this->campaign_id = $options['campaign_id'];
			if (isset($options['metadata'])) $this->metadata = $options['metadata'];
		}
	}

	/**
	 * @return array option array
	 */
	public function getOptions()
	{
		return [
			'options' => [
				'start_time' => $this->start_time ?? null,
				'open_tracking' => $this->open_tracking ?? null,
				'click_tracking' => $this->click_tracking ?? null,
				'transactional' => $this->transactional ?? null,
				'ip_pool' => $this->ip_pool ?? null,
			],
			'campaign_id' => $this->campaign_id ?? null,
			'metadata' => $this->metadata ?? null,
		];
	}

	/**
	 * @param array $transportOptions default options
	 *
	 * @return array options with message options taking precedence over default transport options
	 */
	public function mergeOptions(array $transportOptions)
	{
		return [
			'options' => [
				'start_time' => $this->start_time ?? ($transportOptions['options']['start_time'] ?? null),
				'open_tracking' => $this->open_tracking ?? ($transportOptions['options']['open_tracking'] ?? null),
				'click_tracking' => $this->click_tracking ?? ($transportOptions['options']['click_tracking'] ?? null),
				'transactional' => $this->transactional ?? ($transportOptions['options']['transactional'] ?? null),
				'ip_pool' => $this->ip_pool ?? ($transportOptions['options']['ip_pool'] ?? null),
			],
			'campaign_id' => $this->campaign_id ?? ($transportOptions['campaign_id'] ?? null),
			'metadata' => $this->metadata ?? ($transportOptions['metadata'] ?? null),
		];
	}
}
