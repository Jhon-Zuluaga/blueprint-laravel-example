<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentStoreRequest;
use App\Http\Requests\EnrollmentUpdateRequest;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::all();

        return view('enrollment.index', [
            'enrollments' => $enrollments,
        ]);
    }

    public function create()
    {
        $users = User::where('role', 'student')->get();
        $courses = Course::all();
        return view('enrollment.create', compact('users', 'courses'));
    }

    public function store(EnrollmentStoreRequest $request)
    {
        $enrollment = Enrollment::create($request->validated());
        session()->flash('success', 'Registro creado exitosamente');
        return redirect()->route('enrollments.index');
    }

    public function edit(Enrollment $enrollment)
    {
        $users = User::where('role', 'student')->get();
        $courses = Course::all();
        
        return view('enrollment.edit', [
            'enrollment' => $enrollment,
            'users' => $users,
            'courses' => $courses,
        ]);
    }

    public function update(EnrollmentUpdateRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->validated());
        session()->flash('success', 'Registro actualizado exitosamente');
        return redirect()->route('enrollments.index');
    }

    public function destroy(Request $request, Enrollment $enrollment)
    {
        $enrollment->delete();
        session()->flash('success', 'Registro eliminado exitosamente');
        return redirect()->route('enrollments.index');
    }
}
