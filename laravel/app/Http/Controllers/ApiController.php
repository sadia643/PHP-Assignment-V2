<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\Lowercase;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use \Cache;
use Carbon\Carbon;


class ApiController extends Controller
{
    //
	public function index(Request $request)
    {
		$validator = Validator::make($request->all(), [
						'activity' => 'required|integer|gt:0',
						'activityType' => ['required',Rule::in(['miles', 'fuel']),],
						'fuelType' => ['required_if:activityType,fuel',Rule::in(['motorGasoline', 'diesel', 'petrol', 'aviationGasoline', 'jetFuel']),], 
						'mode' => ['required_if:activityType,miles',Rule::in(['dieselCar', 'petrolCar', 'anyCar', 'taxi', 'economyFlight', 
									'businessFlight', 'firstclassFlight', 'anyFlight', 'motorbike', 'bus', 'transitRail']),],
						'country' => ['required', new Lowercase],
						'appTkn' => ['nullable'],
						
					]);
		if ($validator->fails()) 
		{
            return redirect('footprint/show')
                        ->withErrors($validator)
                        ->withInput();
        }else
		{
			if (Cache::has('carbonFootprint')) 
			{
				$footprintResponse = Cache::get('carbonFootprint');
			} else {
				$footprintResponse = $this->getCarbonFootprint($request);
				
			}
			return $footprintResponse;
		}
    }
	
	public function show()
    {
        return view('footprint.show');
    }
	
	public function getCarbonFootprint($request)
	{
			$client = new Client(); //GuzzleHttp\Client
			$url = 'https://api.triptocarbon.xyz/v1/';
			$api_url = $url . 'footprint?' ;
			$iso_code = array("usa", "gbr");
			$country_code = (!in_array($request['country'], $iso_code))?'def':$request['country'];
			$params = 'activity='.$request['activity'].'&activityType='.$request['activityType'].'&fuelType='.$request['fuelType'].'&mode='.$request['mode'].'&country='.$country_code.'&appTkn='.$request['appTkn'];
			//echo $params;exit;
			$response = $client->request('GET', $api_url.$params);
			$statusCode = $response->getStatusCode();
			$body = $response->getBody()->getContents();
			$minutes = Carbon::now()->add(1, 'day');
			Cache::put('carbonFootprint', $body, $minutes); //30 minutes
			return $body;
	}
}
