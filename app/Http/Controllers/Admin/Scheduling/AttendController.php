<?php

namespace App\Http\Controllers\Admin\Scheduling;

use App\Entities\Attendance;
use App\Entities\Schedule;
use App\Http\Controllers\Controller;
use App\Repositories\AttendanceRepository;
use App\Repositories\ScheduleRepository;
use App\Validators\ScheduleValidator;
use Illuminate\Http\Request;
use DataTables;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class AttendController extends Controller
{
    /**
     * @var ScheduleRepository
     */
    protected $repository;

    /**
     * ScheduleController constructor.
     *
     * @param ScheduleRepository $repository
     */
    public function __construct(AttendanceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.attend.index');
    }

    public function datatable(Request $request)
    {
        $models = Attendance::with(['studentSchedule', 'studentSchedule.student.user', 'studentSchedule.schedule.course', 'studentSchedule.schedule.lecture.user'])->get();
        return DataTables::of($models)
            ->addIndexColumn()
            ->addColumn('attend_at', function ($row) {
                return '<div class="text-center">' . $row->date . '</div>';
            })
            ->addColumn('schedule_time_start_end', function ($row) {
                return '<div class="text-center">' . $row->studentSchedule->schedule->start_time . ' - '. $row->studentSchedule->schedule->end_time  . '</div>';
            })
            ->addColumn('lecture_name', function ($row) {
                return $row->studentSchedule->schedule->lecture->user->first_name . ' ' . $row->studentSchedule->schedule->lecture->user->last_name;
            })
            ->addColumn('student_name', function ($row) {
                return $row->studentSchedule->student->user->first_name . ' ' . $row->studentSchedule->student->user->last_name;
            })
            ->addColumn('image', function ($row) {
                $image = url('uploads/attend/' . $row->studentSchedule->student->nrp . '-' . $row->id . '.jpg');
                return '<a href="'. $image .'" data-popup="lightbox"><img src="'.$image.'" style="height:40px; border-radius:3px"></a>';
            })
            ->rawColumns(['attend_at', 'schedule_time_start_end', 'image'])
            ->toJson();
    }
}
