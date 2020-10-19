<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\Lowercase;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use \Cache;
use Carbon\Carbon;
use App\Models\Footprint;
use App\Util\Triptocarbon;


class ApiController extends Controller
{
    //
protected $footprintResponse;

    public function __construct(Triptocarbon $footprintResponse)
    {
    	$this->Triptocarbon = $footprintResponse;
    }


    public function index(Request $request)
    {
    	// validate parameters
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
				$footprintResponse = $this->Triptocarbon->getCarbonFootprint($request);
				$minutes = Carbon::now()->add(1, 'day'); // 1 day
				Cache::put('carbonFootprint', $footprintResponse, $minutes);
				$footprint_object = new Footprint(['carbonFootprint' => $footprintResponse]);
				$footprint_object->save();
			}
			//dd($footprintResponse);
			return view('footprint.show', compact('footprintResponse'));
		}
    }
		
	public function show()
    {
        return view('footprint.show');
    }
}