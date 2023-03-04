<?php

namespace App\Http\Controllers\admin\SaleEvent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function App\Helpers\checkEvent;

class Sale extends Controller
{
    public function index(Request $request)
    {

        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        checkEvent();
        $event = DB::table('event')->get();
        $username = $request->session()->get('username');
        $posSidebar = "Event";
        $posSubSidebar = "Sale";

        return view('Admin.SaleEvent.sale', compact('event', 'username', 'posSidebar', 'posSubSidebar'));
    }

    public function addEvent(Request $request)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        $eventDate = DB::table('event')
            ->get();

        if (count($eventDate) == 0) {
            $dataArray = $request->all();
            $dataKey = array_keys($request->all());

            DB::table('event')->insert([
                'name_event' => $request->nameEvent,
                'start_event' => date("Y-m-d", strtotime($request->dateStart)),
                'end_event' => date("Y-m-d", strtotime($request->dateEnd)),
                'status' => (int) $request->statusEvent,
                'create_at' => now(),
                'update_at' => now()
            ]);

            $id = DB::table('event')
                ->select('idevent')
                ->where('name_event', '=', $request->nameEvent)
                ->get();

            for ($i = 5; $i < count($dataArray); $i++) {
                DB::table('discount')->insert([
                    'event_idevent' => $id[0]->idevent,
                    'discount' => (int) $dataArray[$dataKey[$i]],
                    'create_at' => now(),
                    'update_at' => now()
                ]);
            }
            return redirect('/admin/sale')->with('success', "Succesfuly for create new sale");
        } else {
            return redirect('/admin/sale')->with('failed', "Failed create event beacuse event is already exit's");
        }
    }

    public function editEvent(Request $request, $id)
    {
        
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        $checkData =  DB::table('product_discount')->get();
        if(count($checkData) == 0){
            $haveItem = true;
        }else{
            $haveItem = false;
        }

        checkEvent();
        $event = DB::table('event')
            ->where('idevent', '=', $id)
            ->get();

        $username = $request->session()->get('username');
        $posSidebar = "Event";
        $posSubSidebar = "Sale";

        foreach ($event as $item) {
            $idevent = $item->idevent;
            $name_event = $item->name_event;
            $start_event = date_format(date_create($item->start_event), 'd F Y');
            $end_event = date_format(date_create($item->end_event), 'd F Y');
            $status = (int)$item->status;
        }

        $discount = DB::table('discount')
            ->select('discount')
            ->where('event_idevent', '=', $id)
            ->get();

        $discountDate = DB::table('discount')
            ->select('create_at')
            ->where('event_idevent', '=', $id)
            ->limit(1)
            ->get();

        return view('Admin.SaleEvent.editSale', compact('event', 'username', 'posSidebar', 'posSubSidebar', 'idevent', 'name_event', 'start_event', 'end_event', 'discount', 'discountDate', 'status', 'haveItem'));
    }

    public function saveEvent(Request $request)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        $dataArray = $request->all();
        $dataKey = array_keys($request->all());

        DB::table('event')
            ->where('idevent', $request->idEvent)
            ->update([
                'name_event' => $request->nameEvent,
                'start_event' => date('Y-m-d', strtotime($request->dateStart)),
                'end_event' => date('Y-m-d', strtotime($request->dateEnd)),
                'status' => (int) $request->statusEvent,
                'update_at' => now()
            ]);

        $checkData =  DB::table('product_discount')->get();

        if (count($checkData) == 0) {
            DB::table('discount')
                ->where('event_idevent', '=', $request->idEvent)
                ->delete();
        } else {
            DB::table('product_discount')
                ->where('discount_event_idevent', '=', $request->idEvent)
                ->delete();

            DB::table('discount')
                ->where('event_idevent', '=', $request->idEvent)
                ->delete();
        }

        for ($i = 7; $i < count($dataArray); $i++) {
            DB::table('discount')
                ->insert([
                    'event_idevent' => $request->idEvent,
                    'discount' => (int) $dataArray[$dataKey[$i]],
                    'create_at' => $request->createAt,
                    'update_at' => now()
                ]);
        }

        return redirect('/admin/sale')->with('success', "Succesfuly for update sale $request->nameEvent");
    }

    public function deleteEvent(Request $request, $id)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        $productDiscountCurrent = DB::table('product_discount')->where('discount_event_idevent', '=', $id)->get();
        if (count($productDiscountCurrent) != 0) {
            DB::table('product_discount')->where('discount_event_idevent', '=', $id)->delete();
        }

        $discountCurrent = DB::table('discount')->where('event_idevent', '=', $id)->get();
        if (count($discountCurrent) != 0) {
            DB::table('discount')->where('event_idevent', '=', $id)->delete();
        }

        DB::table('event')->where('idevent', '=', $id)->delete();

        return redirect('/admin/sale')->with('success', "Succesfuly for delete event sale");
    }

    public function viewEvent(Request $request, $id)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        $event = DB::table('event')->where('idevent', $id)->get();
        $discount = DB::table('discount')->where('event_idevent', $id)->get();
        $data = [];
        array_push($data, $event, $discount);

        return $data;
    }
}
