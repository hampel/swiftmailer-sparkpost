<?php namespace Hampel\SparkPostDriver;

use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
	public function test_construct_empty()
	{
		$message = new Message();

		$this->assertIsArray($message->getOptions());

		$this->assertNull($message->getStartTime());
		$this->assertNull($message->getOpenTracking());
		$this->assertNull($message->getClickTracking());
		$this->assertNull($message->getTransactional());
		$this->assertNull($message->getIpPool());
		$this->assertNull($message->getCampaignId());
		$this->assertNull($message->getMetaData());
	}

	public function test_setOptions_sets_options()
	{
		$options = [
			'options' => [
				'start_time' => 'foo1',
				'open_tracking' => true,
				'click_tracking' => false,
				'transactional' => true,
				'ip_pool' => 'foo2',
			],
			'campaign_id' => 'foo3',
			'metadata' => [
				'foo' => 'bar'
			]
		];

		$message = new Message();
		$message->setOptions($options);

		$this->assertEquals('foo1', $message->getStartTime());
		$this->assertTrue($message->getOpenTracking());
		$this->assertFalse($message->getClickTracking());
		$this->assertTrue($message->getTransactional());
		$this->assertEquals('foo2', $message->getIpPool());
		$this->assertEquals('foo3', $message->getCampaignId());
		$metadata = $message->getMetaData();
		$this->assertIsArray($metadata);
		$this->assertArrayHasKey('foo', $metadata);
		$this->assertEquals('bar', $metadata['foo']);
	}

	public function test_getOptions_gets_options()
	{
		$message = new Message();
		$message->setStartTime('foo1');
		$message->setOpenTracking(true);
		$message->setClickTracking(false);
		$message->setTransactional(true);
		$message->setIpPool('foo2');
		$message->setCampaignId('foo3');
		$message->setMetaData(['foo' => 'bar']);

		$options = $message->getOptions();

		$this->assertIsArray($options);
		$this->assertArrayHasKey('options', $options);
		$this->assertArrayHasKey('start_time', $options['options']);
		$this->assertArrayHasKey('open_tracking', $options['options']);
		$this->assertArrayHasKey('click_tracking', $options['options']);
		$this->assertArrayHasKey('transactional', $options['options']);
		$this->assertArrayHasKey('ip_pool', $options['options']);
		$this->assertArrayHasKey('campaign_id', $options);
		$this->assertArrayHasKey('metadata', $options);
		$this->assertArrayHasKey('foo', $options['metadata']);

		$this->assertEquals('foo1', $options['options']['start_time']);
		$this->assertTrue($options['options']['open_tracking']);
		$this->assertFalse($options['options']['click_tracking']);
		$this->assertTrue($options['options']['transactional']);
		$this->assertEquals('foo2', $options['options']['ip_pool']);
		$this->assertEquals('foo3', $options['campaign_id']);
		$this->assertEquals('bar', $options['metadata']['foo']);
	}

	public function test_mergeOptions_no_message_options()
	{
		$emptyOptions = [
			'options' => [
				'start_time' => null,
				'open_tracking' => null,
				'click_tracking' => null,
				'transactional' => null,
				'ip_pool' => null,
			],
			'campaign_id' => null,
			'metadata' => null,
		];

		$message = new Message();
		$this->assertEquals($emptyOptions, $message->getOptions());

		$transportOptions = [
			'options' => [
				'start_time' => 'foo1',
				'open_tracking' => false,
				'click_tracking' => true,
				'transactional' => false,
				'ip_pool' => 'foo2',
			],
			'campaign_id' => 'foo3',
			'metadata' => ['foo' => 'bar'],
		];

		$this->assertEquals($transportOptions, $message->mergeOptions($transportOptions));
	}

	public function test_mergeOptions_with_message_options()
	{
		$messageOptions = [
			'options' => [
				'start_time' => 'foo9',
				'open_tracking' => true,
				'click_tracking' => false,
				'transactional' => true,
				'ip_pool' => 'foo8',
			],
			'campaign_id' => 'foo7',
			'metadata' => ['bar' => 'foo'],
		];

		$message = new Message();
		$message->setOptions($messageOptions);
		$this->assertEquals($messageOptions, $message->getOptions());

		$transportOptions = [
			'options' => [
				'start_time' => 'foo1',
				'open_tracking' => false,
				'click_tracking' => true,
				'transactional' => false,
				'ip_pool' => 'foo2',
			],
			'campaign_id' => 'foo3',
			'metadata' => ['foo' => 'bar'],
		];

		$this->assertEquals($messageOptions, $message->mergeOptions($transportOptions));
	}
}