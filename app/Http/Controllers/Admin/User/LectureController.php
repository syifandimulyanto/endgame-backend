<?php

namespace App\Http\Controllers\Admin\User;

use App\Entities\Lecturer;
use App\Http\Controllers\Controller;
use App\Repositories\AccountUserRepository;
use App\Repositories\LectureRepository;
use App\Validators\AccountUserValidator;
use App\Validators\LecturerValidator;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class LectureController extends Controller
{
    protected $repository;
    protected $userRepository;
    protected $validator;
    protected $userValidator;

    /**
     * LectureController constructor.
     *
     * @param LectureRepository $repository
     * @param LecturerValidator $validator
     */
    public function __construct(
            LectureRepository $repository,
            LecturerValidator $validator,
            AccountUserRepository $userRepository,
            AccountUserValidator $userValidator
        )
    {
        $this->repository       = $repository;
        $this->userRepository   = $userRepository;
        $this->validator        = $validator;
        $this->userValidator    = $userValidator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.user.lecture.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.user.lecture.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $defaultPassword = 'stiki-2019';
            $request->request->add(
                [
                    'password' => Hash::make($defaultPassword),
                    'parent_type' => 'lecture'
                ]
            );
            // user data
            $this->userValidator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $userModel = $this->userRepository->create($request->all());

            if (!$userModel)
                throw new \Exception('Cant save user data.');

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $model = $this->repository->create($request->all());

            // update user data
            $request->request->add(['parent_id' => $model->id]);
            if ($model)
                $this->userRepository->update($request->all(), $userModel->id);

            $response = [
                'message' => 'Data created.',
                'data'    => $model->toArray(),
            ];

            if ($request->wantsJson())
                return response()->json($response);

            return redirect()->route('admin.user.lecture.index')->with('message', $response['message']);
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
        return view('admin.user.lecture.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->repository->with(['user'])->find($id);
        if (!$data)
            return redirect()->back()->withErrors('Data not found');

        return view('admin.user.lecture.form')->with(['data' => $data]);
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

            return redirect()->route('admin.user.lecture.index')->with('message', $response['message']);
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
        $models = Lecturer::with(['user'])->get();
        return DataTables::of($models)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $formOpen   = '<form action="' . route('admin.user.lecture.destroy', $row->id) . '" method="POST"><input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="' . csrf_token() . '">';
                $formClose  = '</form>';

                $edit   = '<a href="' . route('admin.user.lecture.edit', $row->id) . '" class="btn border-warning text-primary-600 btn-icon btn-rounded btn-xs"><i class="icon-pencil"></i></a>';
                $delete = '<a type="submit" class="btn border-warning text-danger-600 btn-icon btn-rounded btn-xs delete"><i class="icon-cancel-circle2"></i></a>';

                return '<div class="text-center">' . $formOpen . $edit . $delete . $formClose . '</div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}