<?php 

namespace App\Traits;
use App\HarvestedPlant;
use PDF;
use Excel;

trait TraitReport {
    public function index()
    {
        if($this->type() == 1) {
            return view('reports/index');
        } else {
            return view('reports/user/index');
        }
    }

    public function generateExcel()
    {
        $date_from = \Request::get('date_from');
        $date_to = \Request::get('date_to');
        $harvested_plants_arr = array(array('Plant', 'Quantity', 'Amount', 'Harvested Date', 'Employee In-charge'));
        $harvested_plants_list = HarvestedPlant::whereBetween('harvested_date', [$date_from, $date_to])->with('plant', 'user', 'user.person')->get()->toArray();
        
        foreach($harvested_plants_list as $harvested_plant) {
            $data = array(
                $harvested_plant['plant']['name'],
                $harvested_plant['quantity'],
                "₱ ". $harvested_plant['amount'],
                date('m/d/Y', strtotime($harvested_plant['harvested_date'])),
                mb_convert_case($harvested_plant['user']['person']['first_name'], MB_CASE_TITLE, "UTF-8") .' '. (!in_array($harvested_plant['user']['person']['middle_name'], ["",null,".","N/A","n/a","NA"]) ? substr(mb_convert_case($harvested_plant['user']['person']['middle_name'], MB_CASE_TITLE, "UTF-8"), 0, 1).'.' : '') .' '. mb_convert_case($harvested_plant['user']['person']['last_name'], MB_CASE_TITLE, "UTF-8")
            );
            array_push($harvested_plants_arr, $data);
        }    
      
        Excel::create('MIFS Report', function($excel) use($harvested_plants_arr) {
            $excel->sheet('Sheet 1', function($sheet) use($harvested_plants_arr) {
                $sheet->fromArray($harvested_plants_arr, null, 'A1', false, false);
            });
        })->download('xlsx');
    }

    public function generatePDF()
    {
        $date_from = \Request::get('date_from');
        $date_to = \Request::get('date_to');
        $harvested_plants_list = HarvestedPlant::whereBetween('harvested_date', [$date_from, $date_to])->with('plant', 'user', 'user.person')->get();
        
        $pdf = PDF::loadView('reports/pdf', ['harvested_plants_list' => $harvested_plants_list]);
        $pdf->setPaper('long', 'portrait');
        return $pdf->stream('Report.pdf');
    }

    public function data()
    {
        try {
            $date_from_to = explode(' to ', \Request::get('date_from_to'));
            $date_from = date('Y-m-d', strtotime($date_from_to[0]));
            $date_to = date('Y-m-d', strtotime($date_from_to[1]));
            
            return view($this->type() == 1 ? 'reports/data' : 'reports/user/data', compact('date_from', 'date_to'));
        } catch(\Exception $e) {
            return response()->json(false);
        }
    }
}