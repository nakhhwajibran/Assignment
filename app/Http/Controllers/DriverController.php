<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Driver;
use App\Repositories\DriverRepository;
use Validator;
use DataTables;

class DriverController extends Controller
{

    protected $model;

    public function __construct(Driver $model)
    {
        $this->model = new DriverRepository($model);
    }


    public function index()
    {
        return view('add.driver');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $driver = $this->model->getFiltered($request->all());
            $driver = $driver->toArray();
            $data = $driver['data'];
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a name="edit" href="' . route("driver.update.page", ["id" => $data["id"]]) . '" class="edit btn btn-primary btn-sm "> Edit </a>';
                    $button .= '<a name="delete" href="' . route("driver.delete", ["id" => $data["id"]]) . '" class="del btn btn-primary btn-sm"> Delete </a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;

        return view('list.driver', compact('name', 'phone', 'address'));
    }

    public function add(Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->only('name', 'phone', 'address');
        $validator = Validator::make($data, [
            'name' => 'required|string|between:5,50',
            'phone' => 'required|integer|check_phone',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['uid'] = $this->generateUid();

        $data['created_by'] = $userId;
        $data['updated_by'] = $userId;

        $sanitizeData = $this->sanitizeData($data);

        $this->model->create($sanitizeData);

        return redirect()->route('driver');
    }

    public function edit($id)
    {
        $data = $this->model->show($id)->toArray();
        return view('edit.driver', compact('data'));
    }

    public function save($id, Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->only('name', 'phone', 'address');
        $validator = Validator::make($data, [
            'name' => 'required|string|between:5,50',
            'phone' => 'required|integer|check_phone',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['updated_by'] = $userId;

        $sanitizeData = $this->sanitizeData($data);

        $this->model->update($sanitizeData, $id);

        return redirect()->route('driver');
    }

    public function delete($id)
    {
        $userId = auth()->user()->id;

        $data['updated_by'] = $userId;

        $data['isDeleted'] = 1;

        $datas = $this->model->update($data, $id);

        return redirect()->route('driver');
    }
}
