<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\SliderRepository;
use App\Validators\SliderValidator;
use Illuminate\Http\Request;

use DB;
use Datatables;
use Exception;
use Sentinel;
use Validator;
use Auth;

class APISliderController extends Controller
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
     * APISliderController constructor.
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
     * @SWG\Get(
     *   path="/slider",
     *   summary="Get all slider",
     *   description="-",
     *   tags={"slider"},
     *   consumes={"application/x-www-form-urlencoded"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *       name="Authorization",
     *       in="header",
     *       description="User Access Token (eg: Bearer [user token])",
     *       required=true,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Response(
     *     response=200,
     *     description="Notification data"
     *   ),
     *   @SWG\Response(
     *     response="500",
     *     description="Error Message"
     *   )
     * )
     */
    public function index(Request $request)
    {
        $user = Auth::guard('api')->user();
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $data = $this->repository->all();

        return response()->json($data);
    }
}