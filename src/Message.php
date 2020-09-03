<?php namespace Hampel\SparkPostDriver;

class Message extends \Swift_Message
{
	protected $sparkPostOptions = [];

	public function __construct($subject = null, $body = null, $contentType = null, $charset = null, $options = [])
	{
		parent::__construct($subject, $body, $contentType, $charset);
		$this->sparkPostOptions = $options;
	}

	public function setStartTime($start_time)
	{
		$this->sparkPostOptions['options']['start_time'] = strval($start_time);
	}

	public function getStartTime()
	{
		return $this->sparkPostOptions['options']['start_time'] ?? null;
	}

	public function setOpenTracking($open_tracking)
	{
		$this->sparkPostOptions['options']['open_tracking'] = boolval($open_tracking);
	}

	public function getOpenTracking()
	{
		return $this->sparkPostOptions['options']['open_tracking'] ?? null;
	}

	public function setClickTracking($click_tracking)
	{
		$this->sparkPostOptions['options']['click_tracking'] = boolval($click_tracking);
	}

	public function getClickTracking()
	{
		return $this->sparkPostOptions['options']['click_tracking'] ?? null;
	}

	public function setTransactional($transactional)
	{
		$this->sparkPostOptions['options']['transactional'] = boolval($transactional);
	}

	public function getTransactional()
	{
		return $this->sparkPostOptions['options']['transactional'] ?? null;
	}

	public function setIpPool($ip_pool)
	{
		$this->sparkPostOptions['options']['ip_pool'] = strval($ip_pool);
	}

	public function getIpPool()
	{
		return $this->sparkPostOptions['options']['ip_pool'] ?? null;
	}

	public function setCampaignId($campaign_id)
	{
		$this->sparkPostOptions['campaign_id'] = substr(strval($campaign_id), 0, 64);
	}

	public function getCampaignId()
	{
		return $this->sparkPostOptions['campaign_id'] ?? null;
	}

	public function setMetaData(array $metadata)
	{
		$this->sparkPostOptions['metadata'] = $metadata;
	}

	public function getMetaData()
	{
		return $this->sparkPostOptions['metadata'] ?? null;
	}
	
	public function setOptions(array $options)
	{
		$this->sparkPostOptions = array_merge($this->sparkPostOptions, $options);
	}

	public function getOptions()
	{
		return $this->sparkPostOptions;
	}
}
