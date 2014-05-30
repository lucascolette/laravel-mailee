<?php namespace BUBB\Mailee;

class Mailee
{

	protected $contact;

	protected $mashape_key;

	protected $mailee_key;

	protected $mailee_domain;

	public function __construct()
	{
		$this->mashape_key = \Config::get('mailee::mashape_key');
		$this->mailee_key = \Config::get('mailee::mailee_key');
		$this->mailee_domain = \Config::get('mailee::mailee_domain');
	}

	/**
	 * createContact
	 * Create a new contact
	 * 
	 * @param  array $params
	 */
	public function createContact($params)
	{

		$this->setContact($this->createResponse('post', 'contacts', $params));

		return $this;

	}

	/**
	 * setContact
	 */
	private function setContact($contact)
	{
		return $this->contact = $contact;
	}

	/**
	 * getContact
	 */
	private function getContact()
	{
		return $this->contact;
	}

	/**
	 * attachToList
	 * Attach the current contact to a list
	 * @param  string $list
	 */
	public function attachToList($list)
	{

		$params = ['list' => $list];
		$this->createResponse('put', 'contacts/'.$this->getContact()->id.'/list_subscribe', $params);

		return $this;

	}

	/**
	 * setConfig
	 * Set the configs on the fly
	 */
	public function setConfig($config)
	{
		$this->mailee_key = $config['mailee_key'];
		$this->mailee_domain = $config['mailee_domain'];

		return $this;
	}

	/**
	 * getMashapeKey
	 */
	public function getMashapeKey()
	{
		return $this->mashape_key;
	}

	/**
	 * getMaileeKey
	 */
	public function getMaileeKey()
	{
		return $this->mailee_key;
	}

	/**
	 * getMaileeDomain
	 */
	public function getMaileeDomain()
	{
		return $this->mailee_domain;
	}

	/**
	 * createResponse
	 * Call to Mashape API
	 * 
	 * @param  string $verb
	 * @param  string $entity
	 * @param  array $params
	 * @return Response
	 */
	private function createResponse($verb, $entity, $params)
	{

		$mashape_key = $this->getMashapeKey();
		$mailee_key = $this->getMaileeKey();
		$mailee_subdomain = $this->getMaileeDomain();

		$url = 'https://mailee.p.mashape.com/'.$entity.'?api_key='.$mailee_key.'&subdomain='.$mailee_subdomain.'';

		$response = \Unirest::$verb($url, ['X-Mashape-Authorization' => $mashape_key],
			$params
		);

		return $response->body;

	}

}