<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\NotificationRepository;
use App\Validators\NotificationValidator;
use Illuminate\Http\Request;

use DB;
use Datatables;
use Exception;
use Sentinel;
use Validator;
use Auth;

class APINotificationController extends Controller
{
    /**
     * @var NotificationRepository
     */
    protected $repository;

    /**
     * @var NotificationValidator
     */
    protected $validator;

    /**
     * APINotificationController constructor.
     *
     * @param NotificationRepository $repository
     * @param NotificationValidator $validator
     */
    public function __construct(NotificationRepository $repository, NotificationValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @SWG\Get(
     *   path="/notification",
     *   summary="Get all notification",
     *   description="-",
     *   tags={"notification"},
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