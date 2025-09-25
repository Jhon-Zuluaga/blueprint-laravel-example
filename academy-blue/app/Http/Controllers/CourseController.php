<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return view('course.index', [
            'courses' => $courses,
        ]);
    }

    public function create()
    {
        $users = User::where('role', 'instructor')->get();
        $categories = Category::all();
        return view('course.create', compact('users', 'categories'));
    }


    public function store(CourseStoreRequest $request)
    {
        $course = Course::create($request->validated());
        session()->flash('success', 'Registro creado exitosamente');
        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        
        $users = User::where('role', 'instructor')->get();
        $categories = Category::all();

        return view('course.edit', [
            'course' => $course,
            'users' => $users,
            'categories' => $categories
        ]);
    }


    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update($request->validated());
        session()->flash('success', 'Registro actualizado exitosamente');
        return redirect()->route('courses.index');
    }


    public function destroy(Request $request, Course $course)
    {
        $course->delete();
        session()->flash('success', 'Registro eliminado exitosamente');
        return redirect()->route('courses.index');
    }
}
