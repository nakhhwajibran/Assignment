<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Source;
use Validator;
use App\Repositories\SourceRepository;
use DataTables;

class SourceController extends Controller
{
    //
    protected $model;

    public function __construct(Source $model)
    {
        $this->model = new SourceRepository($model);
    }


    public function index()
    {
        return view('add.source');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $source = $this->model->getFiltered($request->all());
            $source = $source->toArray();
            $data = $source['data'];
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a name="edit" href="' . route("source.update.page", ["id" => $data["id"]]) . '" class="edit btn btn-primary btn-sm "> Edit </a>';
                    $button .= '<a name="delete" href="' . route("source.delete", ["id" => $data["id"]]) . '" class="del btn btn-primary btn-sm"> Delete </a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $city = $request->city;
        $state = $request->state;
        $country = $request->country;
        return view('list.source', compact('city', 'state', 'country'));
    }

    public function add(Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->only('city', 'state', 'country');
        $validator = Validator::make($data, [
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['uid'] = $this->generateUid();
        $data['created_by'] = $userId;
        $data['updated_by'] = $userId;

        $sanitizeData = $this->sanitizeData($data);

        $this->model->create($sanitizeData);

        return redirect()->route('source');
    }

    public function edit($id)
    {
        $data = $this->model->show($id)->toArray();
        return view('edit.source', compact('data'));
    }

    public function save($id, Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->only('city', 'state', 'country');
        $validator = Validator::make($data, [
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['updated_by'] = $userId;

        $sanitizeData = $this->sanitizeData($data);

        $this->model->update($sanitizeData, $id);

        return redirect()->route('source');
    }

    public function delete($id)
    {
        $userId = auth()->user()->id;

        $data['isDeleted'] = true;

        $data['updated_by'] = $userId;

        $this->model->update($data, $id);

        return redirect()->route('source');
    }
}
