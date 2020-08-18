<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Vehicle;
use App\Repositories\VehicleRepository;
use Validator;
use DataTables;

class VehicleController extends Controller
{
    protected $model;

    public function __construct(Vehicle $model)
    {
        $this->model = new VehicleRepository($model);
    }

    public function index()
    {
        return view('add.vehicle');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $vehicle = $this->model->getFiltered($request->all());
            $vehicle = $vehicle->toArray();
            $data = $vehicle['data'];
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a name="edit" href="' . route("vehicle.update.page", ["id" => $data["id"]]) . '" class="edit btn btn-primary btn-sm "> Edit </a>';
                    $button .= '<a name="delete" href="' . route("vehicle.delete", ["id" => $data["id"]]) . '" class="del btn btn-primary btn-sm"> Delete </a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $vehicle_no = $request->vehicle_no;
        $vehicle_name = $request->vehicle_name;
        $vehicle_model = $request->vehicle_model;
        return view('list.vehicle', compact('vehicle_no', 'vehicle_name', 'vehicle_model'));
    }

    public function add(Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->all();
        $data['vehicle_no'] = strtoupper($data['vehicle_no']);
        $validator = Validator::make($data, [
            'vehicle_no' => 'required|string|check_vehicle',
            'vehicle_name' => 'required|string',
            'vehicle_model' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['uid'] = $this->generateUid();
        $data['created_by'] = $userId;
        $data['updated_by'] = $userId;

        $sanitizeData = $this->sanitizeData($data);

        $this->model->create($sanitizeData);

        return redirect()->route('vehicle');
    }
    public function edit($id)
    {
        $data = $this->model->show($id)->toArray();
        return view('edit.vehicle', compact('data'));
    }

    public function save($id, Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->only('vehicle_no', 'vehicle_name', 'vehicle_model');
        $data['vehicle_no'] = strtoupper($data['vehicle_no']);
        $validator = Validator::make($data, [
            'vehicle_no' => 'required|string|check_vehicle',
            'vehicle_name' => 'required|string',
            'vehicle_model' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['updated_by'] = $userId;

        $sanitizeData = $this->sanitizeData($data);

        $this->model->update($sanitizeData, $id);

        return redirect()->route('vehicle');
    }

    public function delete($id)
    {
        $userId = auth()->user()->id;

        $data['isDeleted'] = true;

        $data['updated_by'] = $userId;

        $this->model->update($data, $id);

        return redirect()->route('vehicle');
    }
}
