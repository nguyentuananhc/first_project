<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Input;
use App\Player;
use DB;
use Session;
use Excel;

class CSVController extends Controller
{
    public function importExport()
    {
        return view('importExport');
    }
    public function downloadExcel($type)
    {
        $query = DB::table('players')
        ->join('vouchers', 'players.voucher_id', '=', 'vouchers.id')
        ->select('players.name', 'players.phone_number', 'players.created_at' , 'players.score', 'vouchers.name as vouchers')
        ->get()->toArray();
        $data = [];
        foreach($query as $key=>$value){
            $item = array(
                'Tên' => $value->name,
                'SĐT' => $value->phone_number,
                'Điểm Số' => $value->score,
                'Ngày Tạo' => $value->created_at,
                'Loại Voucher' => $value->vouchers,
            );
            array_push($data, $item);
        }
        return Excel::create('customer', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}