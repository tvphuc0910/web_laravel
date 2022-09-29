<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    public function index()
    {
        return view('course.index');
    }
    public function api()
    {

        return DataTables::of(Course::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }


    public function store(StoreRequest $request)
    {
//        $object = new Course();
//        $object->fill($request->validated());
//        $object->save();

        Course::create($request->validated());

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('course.edit', [
           'each' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Course $course)
    {
        $course->update(
            $request->except([
                '_token',
                '_method',
            ])
        );

//        $course->fill($request->except('_token'));
//        $course->save();

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request,$course)
    {
        Course::destroy($course);

        return redirect()->route('courses.index');
    }
}
