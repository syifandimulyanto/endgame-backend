<?php

namespace App\Http\Controllers\Admin\Trainer;

use App\Entities\Student;
use App\Http\Controllers\Controller;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.trainer.index')->with([
            'students' => Student::with(['user'])->get()
        ]);
    }
}
