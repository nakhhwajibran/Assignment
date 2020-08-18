<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\Repositories\DestinationRepository;
use App\Destination;
use DataTables;

class DestinationController extends Controller
{
    //

    protected $model;

    public function __construct(Destination $model)
    {
        $this->model = new DestinationRepository($model);
    }

    public function index()
    {
        return view('add.destination');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $destination = $this->model->getFiltered($request->all());
            $destination = $destination->toArray();
            $data = $destination['data'];
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a name="edit" href="' . route("destination.update.page", ["id" => $data["id"]]) . '" class="edit btn btn-primary btn-sm "> Edit </a>';
                    $button .= '<a name="delete" href="' . route("destination.delete", ["id" => $data["id"]]) . '" class="del btn btn-primary btn-sm"> Delete </a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $city = $request->city;
        $state = $request->state;
        $country = $request->country;

        return view('list.destination', compact('city', 'state', 'country'));
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

        return redirect()->route('destination');
    }

    public function edit($id)
    {
        $data = $this->model->show($id)->toArray();
        return view('edit.destination', compact('data'));
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

        return redirect()->route('destination');
    }

    public function delete($id)
    {
        $userId = auth()->user()->id;

        $data['isDeleted'] = true;

        $data['updated_by'] = $userId;

        $this->model->update($data, $id);

        $this->model->delete($id);

        return redirect()->route('destination');
    }
}
