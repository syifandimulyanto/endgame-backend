<?php
namespace App\Http\Controllers\API;

use App\Entities\Student;
use App\Http\Controllers\Controller;
use App\Repositories\SchedulingStudentRepository;
use App\Validators\SchedulingStudentValidator;
use Illuminate\Http\Request;

use DB;
use Datatables;
use Exception;
use Sentinel;
use Validator;
use Auth;

class APIScheduleController extends Controller
{
    /**
     * @var SchedulingStudentRepository
     */
    protected $repository;

    /**
     * @var SchedulingStudentValidator
     */
    protected $validator;

    /**
     * StudentController constructor.
     *
     * @param SchedulingStudentRepository $repository
     * @param SchedulingStudentValidator $validator
     */
    public function __construct(SchedulingStudentRepository $repository, SchedulingStudentValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @SWG\Get(
     *   path="/schedule",
     *   summary="Get user schedule",
     *   description="-",
     *   tags={"Schedule"},
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
     *     description="Schedule data"
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
        $student = Student::where('id', $user->parent_id)->first();
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $data = $this->repository
            ->with(['schedule', 'schedule.course', 'schedule.room', 'schedule.classes', 'schedule.lecture', 'schedule.lecture.user'])
            ->findByField('student_id', $student->id);

        return response()->json($data);
    }
}