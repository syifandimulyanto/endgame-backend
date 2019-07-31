<?php

namespace App\Http\Controllers\Admin\Core;

use App\Entities\Menu;
use App\Entities\Room;
use App\Http\Controllers\Controller;
use App\Libraries\MenuLib;
use App\Repositories\MenuRepository;
use App\Validators\MenuValidator;
use Illuminate\Http\Request;
use DataTables;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class MenuController extends Controller
{
    /**
     * @var MenuRepository
     */
    protected $repository;

    /**
     * @var MenuValidator
     */
    protected $validator;

    /**
     * RoomController constructor.
     *
     * @param MenuRepository $repository
     * @param MenuValidator $validator
     */
    public function __construct(MenuRepository $repository, MenuValidator $validator)
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
//        $menus = Menu::with(['children'])->whereNull('parent_id')->get();
        $menus = Menu::with(['children'])->get();
        return view('admin.core.menu.index')->with(['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view('admin.core.menu.form')->with(['menus' => $menus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $latest = Menu::orderBy('sort', 'DESC')->first();
            if ($latest)
                $request->request->add(['sort' => $latest->sort + 1]);

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $model = $this->repository->create($request->all());

            $response = [
                'message' => 'Data created.',
                'data'    => $model->toArray(),
            ];

            if ($request->wantsJson())
                return response()->json($response);

            return redirect()->route('admin.core.menu.index')->with('message', $response['message']);
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
        return view('admin.core.menu.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Menu::find($id);
        if (!$data)
            return redirect()->back()->withErrors('Data not found');

        $menus = Menu::all();
        return view('admin.core.menu.form')->with(['data' => $data, 'menus' => $menus]);
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

            return redirect()->route('admin.core.menu.index')->with('message', $response['message']);
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
}

?>