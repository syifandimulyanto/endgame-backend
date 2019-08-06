<?php
namespace App\Http\Controllers\API;

use App\Entities\Student;
use App\Http\Controllers\Controller;
use App\Repositories\StudentScheduleChangeRepository;
use App\Validators\StudentScheduleChangeValidator;
use Illuminate\Http\Request;

use DB;
use Datatables;
use Exception;
use Sentinel;
use Validator;
use Auth;

class APIScheduleChangeController extends Controller
{
    /**
     * @var StudentScheduleChangeRepository
     */
    protected $repository;

    /**
     * @var StudentScheduleChangeValidator
     */
    protected $validator;

    /**
     * APIScheduleChangeController constructor.
     *
     * @param StudentScheduleChangeRepository $repository
     * @param StudentScheduleChangeValidator $validator
     */
    public function __construct(StudentScheduleChangeRepository $repository, StudentScheduleChangeValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @SWG\Get(
     *   path="/scheduleChange",
     *   summary="Get user schedule change",
     *   description="-",
     *   tags={"schedule - change"},
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
     *     description="Schedule change data"
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
        $data = $this->repository
            ->with([
                'room', 'schedule',
                'schedule.course', 'schedule.lecture',
                'schedule.room', 'schedule.classes'
            ])
            ->whereHas('schedule.studentSchedule', function ($q) use ($student) {
                $q->where('student_id', $student->id);
            })
            ->get();

        return response()->json($data);
    }
}