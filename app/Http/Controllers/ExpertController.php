<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use App\Models\Expert;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;



class ExpertController extends Controller
{
     
   public function expertDashboard()
{
    $expert = Session::get('expert');   
    if (!$expert) {
        return redirect('expert-login');
    }
     
      $quiz = Quiz::whereHas('category', function($q) use ($expert) {
        $q->where('creator', $expert->name);
    })
    ->withCount('Records as quiz_records_count')
    ->get(); 

  $quizzes = Quiz::whereHas('category', function($q) use ($expert) {
        $q->where('creator', $expert->name);
    })
    ->withCount('Records as quiz_records_count')
    ->paginate(10);

    $totalMCQs = Mcq::whereHas('quiz.category', function($q) use ($expert) {
        $q->where('creator', $expert->name);
    })->count(); 
    
    $categories = Category::where('creator', $expert->name)->get();

    return view('expert-detail', compact('expert', 'quizzes', 'totalMCQs' , 'quiz', 'categories'));
}
    function login(Request $request){
 
        $validation = $request->validate([
            "name"=>"required",
            "password"=>"required",
        ]); 

        $expert = Expert::where([
            ['name',"=",$request->name],
            ['password',"=",$request->password],
        ])->first();
      
        if(!$expert){
            $validation = $request->validate([
                "user"=>"required",
            ],[
                "user.required"=>"User does not exist"
            ]); 
        }
       
        Session::put('expert',$expert);
        return redirect('dashboard');

    }

    function dashboard(){
        $expert = Session::get('expert');
        if($expert){
            $users= User::orderBy('id','desc')->paginate(10);
            return view('expert',["name"=>$expert->name,'users'=>$users]);
        }else{
            return redirect('expert-login');
        }
    }

 function categories(){
    $expert = Session::get('expert');
    if($expert){
        $categories = Category::orderBy('id')->paginate(10); // ← get() થી paginate()
        return view('categories', ["name" => $expert->name, "categories" => $categories]);
    } else {
        return redirect('expert-login');
    }
}
    function logout(){
        Session::forget('expert');
        return redirect('expert-login');
    }

    function addCategory(Request $request){
        $validation = $request->validate([
            "category"=>"required | min:3 | unique:categories,name"
        ]);
        $expert = Session::get('expert');
        $category= new Category();
        $category->name=$request->category;
        $category->creator=$expert->name;
       if($category->save()){
       Session::flash('category',"Success : Category ".$request->category . " Added.");
       }
        return redirect("expert-categories");
    }

    function deleteCategory($id){
        
        $isDeleted= Category::find($id)->delete();
        if($isDeleted){
       Session::flash('category',"Success : Category deleted.");
       return redirect("expert-categories");

        }

    }
      function create(){
        $expert = Session::get('expert');
        $categories= Category::get();
        if($expert){
            return view('add-quiz',["name"=>$expert->name,"categories"=>$categories]);
        }else{
            return redirect('expert-login');
        }
      }

  function addQuiz(){
      
        $expert = Session::get('expert');
        $categories= Category::get();
        $totalMCQs=0;
        if($expert){
             $quizName=request('quiz');
             $category_id=request('category_id');

            if($quizName && $category_id && !Session::has('quizDetails')){
                $quiz= new Quiz();
                $quiz->name=$quizName;
                $quiz->category_id=$category_id;
                if($quiz->save()){
                    Session::put('quizDetails',$quiz);
                }

            }else{
                $quiz= Session::get('quizDetails');
                $totalMCQs = $quiz && Mcq::where('quiz_id',$quiz->id)->count();
            }

            return view('add-quiz',["name"=>$expert->name,"categories"=>$categories,"totalMCQs"=>$totalMCQs]);
        }else{
            return redirect('expert-login');
        }
    }

function addMCQs(Request $request) {
    $quiz   = Session::get('quizDetails');
    $expert = Session::get('expert');

    // Session check
    if (!$expert || !$quiz) {
        return redirect('/expert-login')->with('error', 'Session expired. Please login again.');
    }

    // CSV Import
    if ($request->hasFile('csv_file')) {
        $file = $request->file('csv_file');

        $handle = fopen($file->getPathname(), 'r');
        $header = fgetcsv($handle); // skip header row

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 6) continue;

            $mcq = new Mcq();
            $mcq->question    = trim($row[0]);
            $mcq->a           = trim($row[1]);
            $mcq->b           = trim($row[2]);
            $mcq->c           = trim($row[3]);
            $mcq->d           = trim($row[4]);
            $mcq->correct_ans = strtolower(trim($row[5]));
            $mcq->admin_id    = $expert->id;
            $mcq->quiz_id     = $quiz->id;
            $mcq->category_id = $quiz->category_id;
            $mcq->save();
        }

        fclose($handle);

        return redirect()->back()->with('message-success', 'MCQs imported from CSV!');
    }

    // Manual multi-MCQ submission
    $questions = $request->input('questions', []);

    foreach ($questions as $q) {
        if (empty($q['question']) || empty($q['a']) || empty($q['b']) ||
            empty($q['c']) || empty($q['d']) || empty($q['correct_ans'])) {
            continue;
        }

        $mcq = new Mcq();
        $mcq->question    = $q['question'];
        $mcq->a           = $q['a'];
        $mcq->b           = $q['b'];
        $mcq->c           = $q['c'];
        $mcq->d           = $q['d'];
        $mcq->correct_ans = $q['correct_ans'];
        $mcq->admin_id    = $expert->id;
        $mcq->quiz_id     = $quiz->id;
        $mcq->category_id = $quiz->category_id;
        $mcq->save();
    }

    if ($request->submit == "add-more") {
        return redirect()->back()->with('message-success', 'MCQs saved! Add more.');
    } else {
        Session::forget('quizDetails');
        return redirect("/expert-categories");
    }
}

    function endQuiz(){
        Session::forget('quizDetails');
            return redirect("/expert-categories");
    }

    function showQuiz($id,$quizName){
      
        $expert = Session::get('expert');
         $mcqs=Mcq::where('quiz_id',$id)->get();
        if($expert){
            return view('show-quiz',["name"=>$expert->name,"mcqs"=>$mcqs,'quizName'=>$quizName]);
        }else{
            return redirect('expert-login');
        }
    }

    function quizList($id,$category){
        $expert = Session::get('expert');
       if($expert){
        $quizData=Quiz::where('category_id',$id)->get();
           return view('quiz-list',["name"=>$expert->name,"quizData"=>$quizData,'category'=>$category]);
       }else{
           return redirect('expert-login');
       }
    }
}
