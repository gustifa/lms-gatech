<?php

namespace App\Http\Controllers\Backend;

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

class CourseController extends Controller
{
    public function AllCourse(){
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id',$id)->orderBy('id','desc')->get();
        return view('instructor.courses.all_course',compact('courses'));
    }

    public function AddCourse(){

        $categories = Category::latest()->get();
        return view('instructor.courses.add_course',compact('categories'));

    }// End Method

    public function GetSubCategory($category_id){

        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);

    }// End Method

    public function StoreCourse(Request $request){

        // $request->validate([
        //     'video' => 'required|mimes:mp4|max:10000',
        // ]);
        $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('course_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('course_image'));
            $img = $img->resize(370,246);
            $img->toPng()->save(base_path('public/upload/course/thambnail/'.$name_gen));
            $save_url = 'upload/course/thambnail/'.$name_gen;

        $video = $request->file('video');
        $videoName = time().'.'.$video->getClientOriginalExtension();
        $video->move(public_path('upload/course/video/'),$videoName);
        $save_video = 'upload/course/video/'.$videoName;

        $course_id = Course::insertGetId([

            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'description' => $request->description,
            'video' => $save_video,

            'label' => $request->label,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'certificate' => $request->certificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,

            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,
            'status' => 1,
            'course_image' => $save_url,
            'created_at' => Carbon::now(),

        ]);

        /// Course Goals Add Form

        $goles = Count($request->course_goals);
        if ($goles != NULL) {
            for ($i=0; $i < $goles; $i++) {
                $gcount = new Course_goal();
                $gcount->course_id = $course_id;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            }
        }
        /// End Course Goals Add Form

        $notification = array(
            'message' => 'Course Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.course')->with($notification);
    }// End Method

    public function EditCourse($id){

        $course = Course::find($id);
        $goals = Course_goal::where('course_id',$id)->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        return view('instructor.courses.edit_course',compact('course','categories','subcategories','goals'));

    }// End Method

    public function UpdateCourse(Request $request){

        $cid = $request->course_id;

           Course::find($cid)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'description' => $request->description,

            'label' => $request->label,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'certificate' => $request->certificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,

            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,

        ]);

        $notification = array(
            'message' => 'Course Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.course')->with($notification);

    }// End Method

    public function UpdateCourseImage(Request $request){

        $course_id = $request->id;
        $oldImage = $request->old_img;

        $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('course_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('course_image'));
            $img = $img->resize(370,246);
            $img->toPng()->save(base_path('public/upload/course/thambnail/'.$name_gen));
            $save_url = 'upload/course/thambnail/'.$name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Course::find($course_id)->update([
            'course_image' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Course Image Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method


    public function UpdateCourseVideo(Request $request){

        $course_id = $request->vid;
        $oldVideo = $request->old_vid;

        $video = $request->file('video');
        $videoName = time().'.'.$video->getClientOriginalExtension();
        $video->move(public_path('upload/course/video/'),$videoName);
        $save_video = 'upload/course/video/'.$videoName;

        if (file_exists($oldVideo)) {
            unlink($oldVideo);
        }

        Course::find($course_id)->update([
            'video' => $save_video,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Course Video Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function DeleteCourse($id){
        $course = Course::find($id);
        unlink($course->course_image);
        unlink($course->video);

        Course::find($id)->delete();

        $goalsData = Course_goal::where('course_id',$id)->get();
        foreach ($goalsData as $item) {
            $item->goal_name;
            Course_goal::where('course_id',$id)->delete();
        }

        $notification = array(
            'message' => 'Course Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method
}