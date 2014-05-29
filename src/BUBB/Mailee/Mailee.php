<?php namespace BUBB\Mailee;

class Mailee
{

	protected $contact;

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

		$mashape_key = \Config::get('mailee::mashape_key');
		$mailee_key = \Config::get('mailee::mailee_key');
		$mailee_subdomain = \Config::get('mailee::mailee_domain');

		$url = 'https://mailee.p.mashape.com/'.$entity.'?api_key='.$mailee_key.'&subdomain='.$mailee_subdomain.'';

		$response = \Unirest::$verb($url, ['X-Mashape-Authorization' => $mashape_key],
			$params
		);

		return $response->body;

	}

}