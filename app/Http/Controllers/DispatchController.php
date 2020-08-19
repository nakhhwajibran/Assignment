<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Repositories\DispatchRepository;
use Illuminate\Support\Facades\Validator;
use App\Exports\CollectionExport;
use App\Dispatch;
use App\Source;
use App\Destination;
use App\Transporter;
use App\Vehicle;
use App\Driver;
use DataTables;
use Excel;

class DispatchController extends Controller
{
    //

    protected $model;

    public function __construct(Dispatch $model)
    {
        $this->model = new DispatchRepository($model);
    }

    public function index()
    {
        $source = Source::all()->toArray();
        $destination = Destination::all()->toArray();
        $driver = Driver::all()->toArray();
        $transporter = Transporter::all()->toArray();
        $vehicle = Vehicle::all()->toArray();
        return view('add.dispatch', compact('source', 'destination', 'driver', 'transporter', 'vehicle'));
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->model->getFiltered($request->all());
            $dispatch = $this->model->getdispatchData($data);
            return DataTables::of($dispatch)
                ->addColumn('action', function ($dispatch) {
                    $button = '<a name="edit" href="' . route("dispatch.update.page", ["id" => $dispatch["id"]]) . '" class="edit btn btn-primary btn-sm "> Edit </a>';
                    $button .= '<a name="delete" href="' . route("driver.delete", ["id" => $dispatch["id"]]) . '" class="del btn btn-primary btn-sm"> Delete </a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $delivery_no = $request->delivery_no;
        $shipment_no = $request->shipment_no;
        $source = $request->source;
        $destination = $request->destination;
        $vehicle = $request->vehicle_no;
        $driver = $request->driver;
        $transporter = $request->transporter;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        return view('list.dispatch', compact('delivery_no', 'shipment_no', 'source', 'destination', 'vehicle', 'driver', 'transporter', 'startDate', 'endDate'));
    }

    public function add(Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'delivery_no' => 'required|numeric|unique:dispatches|check_digits',
            'source_id' => 'required',
            'destination_id' => 'required|integer',
            'vehicle_id' => 'required',
            'address' => 'required|string',
            'transporter_id' => 'required|integer',
            'startDate' => 'required|date',
            'endDate' => "required|date|check_end_date:$request->startDate",
            'driver_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['created_by'] = $userId;
        $data['updated_by'] = $userId;

        $sanitizeData = $this->sanitizeData($data);

        $this->model->create($sanitizeData);

        return redirect()->route('dispatch');
    }

    public function edit($id)
    {
        $data = $this->model->show($id)->toArray();
        $source = Source::all()->toArray();
        $destination = Destination::all()->toArray();
        $driver = Driver::all()->toArray();
        $transporter = Transporter::all()->toArray();
        $vehicle = Vehicle::all()->toArray();
        return view('edit.dispatch', compact('source', 'destination', 'driver', 'transporter', 'vehicle', 'data'));
    }

    public function save($id, Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'source_id' => 'required',
            'destination_id' => 'required|integer',
            'vehicle_id' => 'required',
            'address' => 'required|string',
            'transporter_id' => 'required|integer',
            'startDate' => 'required|date',
            'endDate' => "required|date|check_end_date:$request->startDate",
            'driver_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['updated_by'] = $userId;

        $sanitizeData = $this->sanitizeData($data);

        $this->model->update($sanitizeData, $id);

        return redirect()->route('dispatch');
    }

    public function delete($id)
    {

        $userId = Auth::user()->id;

        $data['isDeleted'] = true;

        $data['updated_by'] = $userId;

        $this->model->update($data, $id);

        $this->model->delete($id);

        return redirect()->route('dispatch');
    }

    public function exportCsv(Request $request)
    {
        $array = array();
        $data = $this->model->getFiltered($request->all());
        $dispatch = $this->model->getdispatchData($data);
        foreach ($dispatch as $k => $d) {
            $array[$k]['delivery_no'] = $d['delivery_no'];
            $array[$k]['shipment_no'] = $d['shipment_no'];
            $array[$k]['source'] = $d['source_city'] . '-' . $d['source_state'];
            $array[$k]['destination'] = $d['destination_city'] . '-' . $d['destination_state'];
            $array[$k]['transporter'] = $d['transporter_name'];
            $array[$k]['vehicle_no'] = $d['vehicle_no'];
            $array[$k]['vehicle_name'] =  $d['vehicle_name'];
            $array[$k]['driver_name'] = $d['driver_name'];
            $array[$k]['driver_phone'] = $d['driver_phone'];
            $array[$k]['startDate'] = $d['startDate'];
            $array[$k]['endDate'] = $d['endDate'];
        }

        return Excel::download(new CollectionExport($array), 'export.xlsx');
    }

    public function getGrid(Request $request)
    {
        $postData = $request->all();
        $postData['skip'] = @$postData['skip'] ? $postData['skip'] : 0;
        $postData['take'] = @$postData['take'] ? $postData['take'] : 10;
        $data = $this->model->getFiltered($postData);
        $dispatch = $this->model->getdispatchData($data);
        $count = count($this->model->all());
        $delivery_no = $request->delivery_no;
        $shipment_no = $request->shipment_no;
        $source = $request->source;
        $destination = $request->destination;
        $vehicle = $request->vehicle;
        $driver = $request->driver;
        $transporter = $request->transporter;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $skip = $request->skip ? $request->skip : 0;
        $take = $request->take ? $request->take : 10;

        return view('list.dispatchGrid', compact('delivery_no', 'shipment_no', 'source', 'destination', 'vehicle', 'driver', 'transporter', 'startDate', 'endDate', 'dispatch', 'take', 'skip', 'count'));
    }


    public function loadMore(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->model->getFiltered($request->all());
            $dispatch = $this->model->getdispatchData($data);
            return response()->json($dispatch);
        }
    }
}
