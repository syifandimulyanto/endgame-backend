<?php

namespace App\Http\Controllers\Admin\Master;

use App\Entities\Slider;
use App\Http\Controllers\Controller;
use App\Repositories\SliderRepository;
use App\Validators\SliderValidator;
use Illuminate\Http\Request;
use DataTables;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class SliderController extends Controller
{
    /**
     * @var SliderRepository
     */
    protected $repository;

    /**
     * @var SliderValidator
     */
    protected $validator;

    /**
     * RoomController constructor.
     *
     * @param SliderRepository $repository
     * @param SliderValidator $validator
     */
    public function __construct(SliderRepository $repository, SliderValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.master.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.master.slider.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $body = $request->except(['image']);
            // Save Image if exists
            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/' . date('Y/m');
                $imageName  = time() . '.' . $request->image->getClientOriginalExtension();
                // Move file
                $request->image->move(public_path($uploadPath), $imageName);
                //$request->request->add(['image' => $uploadPath . '/' . $imageName]);
                $body['image'] = $uploadPath . '/' . $imageName;
            }

            $this->validator->with($body)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $model = $this->repository->create($body);

            $response = [
                'message' => 'Data created.',
                'data'    => $model->toArray(),
            ];

            if ($request->wantsJson())
                return response()->json($response);

            return redirect()->route('admin.master.slider.index')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson())
                return response()->json(['error' => true, 'message' => $e->getMessageBag()]);

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin.master.slider.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->repository->find($id);
        if (!$data)
            return redirect()->back()->withErrors('Data not found');

        return view('admin.master.slider.form')->with(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        try {
            $body = $request->except(['image']);
            // Save Image if exists
            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/' . date('Y/m');
                $imageName  = time() . '.' . $request->image->getClientOriginalExtension();
                // Move file
                $request->image->move(public_path($uploadPath), $imageName);
                //$request->request->add(['image' => $uploadPath . '/' . $imageName]);
                $body['image'] = $uploadPath . '/' . $imageName;
            }
            $this->validator->with($body)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $model = $this->repository->update($body, $id);

            $response = [
                'message' => 'Data updated.',
                'data'    => $model->toArray(),
            ];

            if ($request->wantsJson())
                return response()->json($response);

            return redirect()->route('admin.master.slider.index')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson())
                return response()->json(['error' => true, 'message' => $e->getMessageBag()]);

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $model = $this->repository->delete($id);

        if (request()->wantsJson())
            return response()->json(['message' => 'Data deleted.', 'data' => $model]);

        return redirect()->back()->with(['success' => 'Data deleted.']);
    }

    public function datatable(Request $request)
    {
        $models = Slider::all();
        return DataTables::of($models)
            ->addIndexColumn()
            ->editColumn('image', '@if ($image) <a href="{{ url($image) }}" data-popup="lightbox"><img src="{{ url($image) }}" style="height:40px; border-radius:3px"></a> @else No image. @endif')
            ->addColumn('action', function ($row) {
                $formOpen   = '<form action="' . route('admin.master.slider.destroy', $row->id) . '" method="POST"><input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="' . csrf_token() . '">';
                $formClose  = '</form>';

                $edit   = '<a href="' . route('admin.master.slider.edit', $row->id) . '" class="btn border-warning text-primary-600 btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>';
                $delete = '<a type="submit" class="btn border-warning text-danger-600 btn-icon btn-rounded btn-xs delete"><i class="icon-cancel-circle2"></i></a>';

                return '<div class="text-center">' . $formOpen . $edit . $delete . $formClose . '</div>';
            })
            ->rawColumns(['action', 'image'])
            ->toJson();
    }

}

?>