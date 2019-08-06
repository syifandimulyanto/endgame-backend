<?php
namespace App\Http\Controllers\API;

use App\Entities\Attendance;
use App\Entities\Student;
use App\Entities\StudentSchedule;
use App\Http\Controllers\Controller;
use App\Repositories\AttendanceRepository;
use App\Validators\AttendanceValidator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use DB;
use Datatables;
use Sentinel;
use Validator;
use Auth;

class APIScheduleAttendController extends Controller
{
    /**
     * @var AttendanceRepository
     */
    protected $repository;

    /**
     * @var AttendanceValidator
     */
    protected $validator;

    /**
     * APIScheduleAttendController constructor.
     *
     * @param AttendanceRepository $repository
     * @param AttendanceValidator $validator
     */
    public function __construct(AttendanceRepository $repository, AttendanceValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @SWG\Get(
     *   path="/attend",
     *   summary="Get user schedule attend",
     *   description="-",
     *   tags={"schedule - attend"},
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
     *     description="Schedule attend data"
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
                'studentSchedule', 'studentSchedule.student', 'studentSchedule.schedule',
                'studentSchedule.schedule.course', 'studentSchedule.schedule.lecture',
                'studentSchedule.schedule.room', 'studentSchedule.schedule.classes'
            ])
            ->whereHas('studentSchedule.student', function ($q) use ($student) {
                $q->where('id', $student->id);
            })
            ->get();

        return response()->json($data);
    }

    /**
     * @SWG\Post(
     *   path="/attend",
     *   summary="Schedule attend",
     *   description="-",
     *   tags={"schedule - attend"},
     *   consumes={"application/x-www-form-urlencoded"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *       name="nrp",
     *       in="formData",
     *       description="Student nrp",
     *       required=true,
     *       type="string",
     *       format="string",
     *       @SWG\Items(type="string"),
     *       collectionFormat="multi"
     *   ),
     *
     *   @SWG\Parameter(
     *       name="datetime",
     *       in="formData",
     *       description="Schedule date time",
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
    public function store(Request $request)
    {
        try {
            $dateTime = Carbon::parse($request->datetime);
            $student = Student::where('nrp', $request->nrp)->first();
            if (!$student)
                return response()->json('Student Not found', 409);

            $day = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            $schedule = StudentSchedule::selectRaw('student_schedules.id as studentSchedule, schedules.*')
                                        ->join('schedules', 'student_schedules.schedule_id', '=', 'schedules.id')
                                        ->where('student_schedules.student_id', $student->id)
                                        ->whereRaw('schedules.start_date <= DATE(NOW())')
                                        ->whereRaw('schedules.end_date >= DATE(NOW())')
                                        ->whereRaw('schedules.start_time <= "'. $dateTime->format('H:i:s') . '"')
                                        ->whereRaw('schedules.end_time >= "'. $dateTime->format('H:i:s') . '"')
                                        ->where('schedules.day', array_search(strtolower(date('l')), $day))
                                        ->first();

            $attend = [
                'student_schedule_id' => $schedule->studentSchedule,
                'date' => $dateTime->format('Y-m-d H:i:s')
            ];

            $checkAttend = Attendance::where('student_schedule_id', $schedule->studentSchedule)
                                    ->whereRaw('DATE(attendances.date) = "' . $dateTime->format('Y-m-d') .'"')
                                    ->first();

            if ($checkAttend)
                return response()->json('Duplicate attend', 409);

            $this->validator->with($attend)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $model = $this->repository->create($attend);

            $response = [
                'message' => 'Data created.',
                'data'    => $model->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessageBag()]);
        }
    }
}