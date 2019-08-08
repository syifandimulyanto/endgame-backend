<?php 

namespace App\Http\Controllers\Admin\Master;

use App\Entities\ProgramStudy;
use App\Http\Controllers\Controller;
use App\Repositories\ProgramStudyRepository;
use App\Validators\ProgramStudyValidator;
use Illuminate\Http\Request;
use DataTables;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProgramStudyController extends Controller 
{
    /**
     * @var RoomRepository
     */
    protected $repository;

    /**
     * @var RoomValidator
     */
    protected $validator;

    /**
     * RoomController constructor.
     *
     * @param RoomRepository $repository
     * @param RoomValidator $validator
     */
    public function __construct(ProgramStudyRepository $repository, ProgramStudyValidator $validator)
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
        return view('admin.master.program-study.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        return view('admin.master.program-study.form');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store(Request $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $model = $this->repository->create($request->all());

            $response = [
                'message' => 'Data created.',
                'data'    => $model->toArray(),
            ];

            if ($request->wantsJson())
                return response()->json($response);

            return redirect()->route('admin.master.program-study.index')->with('message', $response['message']);
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
        return view('admin.master.program-study.show');
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

        return view('admin.master.program-study.form')->with(['data' => $data]);
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

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $model = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Data updated.',
                'data'    => $model->toArray(),
            ];

            if ($request->wantsJson())
                return response()->json($response);

            return redirect()->route('admin.master.program-study.index')->with('message', $response['message']);
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
        $models = ProgramStudy::all();
        return DataTables::of($models)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $formOpen   = '<form action="' . route('admin.master.program-study.destroy', $row->id) . '" method="POST"><input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="' . csrf_token() . '">';
                $formClose  = '</form>';

                $edit   = '<a href="' . route('admin.master.program-study.edit', $row->id) . '" class="btn border-warning text-primary-600 btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>';
                $delete = '<a type="submit" class="btn border-warning text-danger-600 btn-icon btn-rounded btn-xs delete"><i class="icon-cancel-circle2"></i></a>';

                return '<div class="text-center">' . $formOpen . $edit . $delete . $formClose . '</div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

}

?>