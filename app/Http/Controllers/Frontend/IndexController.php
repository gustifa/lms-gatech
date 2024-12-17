<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseSection;
use App\Models\CourseLecture;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function CourseDetails($id, $slug){
        $course = Course::find($id);
        $goals = Course_goal::where('course_id', $id)->orderBy('id','DESC')->get();

        $instructor_id = $course->instructor_id;
        $instructor_course = Course::where('instructor_id',$instructor_id)->orderBy('id','DESC')->limit(5)->get();
        return view('frontend.course.course_details', compact('course', 'goals', 'instructor_course'));
    }
}
