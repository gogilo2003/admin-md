<?php

namespace Ogilo\AdminMd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class HitsController extends Controller
{
	public function index()
	{

		$res = [
			'hits'=>get_hits()
		];

		return response($res)->header('Content-Type','application/json');
	}
	
	public function browsers(Request $request)
	{
		$hits = DB::table('hits')
						->select(DB::raw('count(*) as browsers, browser'))
						->where('url','NOT LIKE',"%admin%")
						->where('url','NOT LIKE',"%api%")
						->where('url','NOT LIKE',"%public%")
						->where('browser','<>','Unknown Browser')
						->groupBy('browser')
						->get();

		$labels = $hits->pluck('browser');
		$data = $hits->pluck('browsers');
		
		return response(compact('labels','data'))->header('Content-Type','application/json');
	}
	
	public function platforms(Request $request)
	{
		$hits = DB::table('hits')
						->select(DB::raw('count(*) as platforms, platform'))
						->where('url','NOT LIKE',"%admin%")
						->where('url','NOT LIKE',"%api%")
						->where('url','NOT LIKE',"%public%")
						->where('platform','<>','Unknown OS Platform')
						->groupBy('platform')
						->get();

		$labels = $hits->pluck('platform');
		$data = $hits->pluck('platforms');
		
		return response(compact('labels','data'))->header('Content-Type','application/json');
	}

	public function weeklyPlatforms(Request $request)
	{
		$weekly = DB::table('hits')
						->where('url','NOT LIKE',"%admin%")
						->where('url','NOT LIKE',"%api%")
						->where('url','NOT LIKE',"%public%")
						->get();

		$begin = new \DateTime();
		$end = new \DateTime();
		$begin = $begin->modify( '-6 day' );
		$end = $end->modify('+1 day');

		$interval = new \DateInterval('P1D');
		$daterange = new \DatePeriod($begin, $interval ,$end);
		$labels = [];
		foreach($daterange as $date){
		    $labels[] = $date->format("D");
		}

		$datasets = [];
		$platforms = DB::table('hits')->select(DB::raw('distinct(platform)'))->get()->pluck('platform');

		foreach($platforms as $platform){
			$data = [];
			foreach ($daterange as $date) {
				$hits = DB::table('hits')
							->select(DB::raw('count(*) as visits'))
							->where('url','NOT LIKE',"%admin%")
							->where('url','NOT LIKE',"%api%")
							->where('url','NOT LIKE',"%public%")
							->where('platform',$platform)
							->whereDate('created_at',$date->format('Y-m-d'))
							->first();

				$data[] = $hits->visits;
				
			}

			$r = random_int(0, 255);
			$g = random_int(0, 255);
			$b = random_int(0, 255);

			$datasets[]=[
				'label'=>$platform,
				'data' => $data,
				'backgroundColor'=>"rgba($r,$g,$b,0.1)",
				'borderColor'=>"rgb($r,$g,$b)",
				'pointBackgroundColor'=>'#fff',
				'pointBorderColor'=>'#fff'
			];
			
		}
		return response(compact('labels','datasets'))->header('Content-Type','application/json');
	}

}