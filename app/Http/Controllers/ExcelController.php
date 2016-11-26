<?php
namespace App\Http\Controllers;

use Input;
use DB;
use Excel;
use App\Models\Excelitems;

class ExcelController extends Controller
{
	public function importExport()
	{
		return view('importExport');
	}
	public function downloadExcel($type)
	{
		$data = Item::get()->toArray();
		return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}
	public function importExcel()
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data)){
				foreach ($data as $key => $value) {
					if ($value->title == 'Dana Cadangan Resiko'){
						$title = $value->title;
						$description = $value->description;

						$insert[] = [
								'title' => $title, 
								'description' => $description
						];
					}					
				}
				dd($insert);
			}
		}
		return back();
	}
}