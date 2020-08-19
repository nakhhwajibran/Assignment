<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Transporter;
use App\Repositories\TransporterRepository;
use Validator;
use DataTables;

class TransporterController extends Controller
{
    //
    protected $model;

    public function __construct(Transporter $model)
    {
        $this->model = new TransporterRepository($model);
    }


    public function index()
    {
        return view('add.transporter');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $transporter = $this->model->getFiltered($request->all());
            $transporter = $transporter->toArray();
            $data = $transporter['data'];
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a name="edit" href="' . route("transporter.update.page", ["id" => $data["id"]]) . '" class="edit btn btn-primary btn-sm "> Edit </a>';
                    $button .= '<a name="delete" href="' . route("transporter.delete", ["id" => $data["id"]]) . '" class="del btn btn-primary btn-sm"> Delete </a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $name = $request->name;
        return view('list.transporter', compact('name'));
    }

    public function add(Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->only('name');

        $validator = Validator::make($data, [
            'name' => 'required|string|between:5,50|regex:/^([^0-9]*)$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }

        $data['uid'] = $this->generateUid();
        $data['created_by'] = $userId;
        $data['updated_by'] = $userId;

        $sanitizeData = $this->sanitizeData($data);

        $this->model->create($sanitizeData);

        return redirect()->route('transporter');
    }

    public function edit($id)
    {
        $data = $this->model->show($id)->toArray();
        return view('edit.transporter', compact('data'));
    }

    public function save($id, Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string|regex:/^([^0-9]*)$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['updated_by'] = $userId;

        $sanitizeData = $this->sanitizeData($data);

        $this->model->update($sanitizeData, $id);

        return redirect()->route('transporter');
    }

    public function delete($id)
    {
        $userId = auth()->user()->id;

        $data['isDeleted'] = true;

        $data['updated_by'] = $userId;

        $this->model->update($data, $id);

        return redirect()->route('transporter');
    }
}
