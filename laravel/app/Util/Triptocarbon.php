<?php
namespace App\Util;

use GuzzleHttp\Client;

class Triptocarbon
{
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function all()
	{
		return $this->endpointRequest('/v1/footprint');
	}

	public function getCarbonFootprint($request)
	{
			$api_url = '/v1/footprint?' ;
			$iso_code = array("usa", "gbr");
			$country_code = (!in_array($request['country'], $iso_code))?'def':$request['country'];
			$params = 'activity='.$request['activity'].'&activityType='.$request['activityType'].'&fuelType='.$request['fuelType'].'&mode='.$request['mode'].'&country='.$country_code.'&appTkn='.$request['appTkn'];
			//echo $params;exit;
			$url = $api_url.$params;
			return $this->endpointRequest($url);
	}

	public function endpointRequest($url)
	{
		try {
			$response = $this->client->request('GET', $url);
		} catch (\Exception $e) {
            return [];
		}

		return $this->response_handler($response->getBody()->getContents());
	}

	public function response_handler($response)
	{
		if ($response) {
			return $response;
		}
		
		return [];
	}

}