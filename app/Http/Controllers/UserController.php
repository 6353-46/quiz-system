<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Spatie\Browsershot\Browsershot;



use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Contact;
use App\Models\Mcq;
use App\Models\User;
use App\Models\Record;
use App\Models\MCQ_Record;
use App\Mail\VerifyUser;
use App\Mail\UserForgotPassword;


class UserController extends Controller
{
    //
     function about(Request $request){
       $category =Category::count();
       $question=Mcq::count();
       $userCount = User::count();
        return   view('about',['category'=>$category,'question'=>$question,'userCount'=>$userCount])  ;

      }
      function  contact(){
        return view('contact');
      }
        
      function contactStore(Request $request){
         
            
  
        $user=Session::get('user');
        $request->validate([
          'name' => 'required|string|min:3',
          'email' => 'required|email',
          'contact' => 'required|string|size:10',
          'message' => 'required|string|min:10'
        ]);

        if($user){
        
        $contact =new contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->contact = $request->contact;
        $contact->message=$request->message;

        if( $contact->save())
          {
             
            return redirect('contact')->with('message-success', 'Thank you for your message! We will get back to you soon.');
          }

          return redirect('contact')->with('message-error', 'Please login to send message');    
      }
      else{
          
        return redirect('user-signup');

      } 
  }

   function welcome(){
    $categories = Category::withCount('quizzes')->orderBy('quizzes_count','desc')->take(5)->get();
    $quizData = Quiz::withCount('Mcq')->orderBy('mcq_count','desc')->take(5)->get();
    $totalQuizzes = Quiz::count();
    $totalCategories = Category::count();
    return view('welcome', [
        'categories' => $categories,
        'quizData' => $quizData,
        'totalQuizzes' => $totalQuizzes,
        'totalCategories' => $totalCategories,
    ]);
}

    function categories(){

        $categories=Category::withCount('quizzes')->orderBy('quizzes_count','desc')->paginate(4);
   return view('categories-list',['categories'=>$categories]);
      }
 
    function userQuizList($id,$category){
     
        $quizData=Quiz::withCount('Mcq')->where('category_id',$id)->get();
           return view('user-quiz-list',["quizData"=>$quizData,'category'=>$category]);
      
    }

    function startQuiz($id,$name){

        $quizCount =Mcq::where('quiz_id',$id)->count();
        $mcqs =Mcq::where('quiz_id',$id)->get();
        Session::put('firstMCQ',$mcqs[0]);
        $quizName =$name;
        return view('start-quiz',['quizName'=>$quizName,'quizCount'=>$quizCount]);

    }

    function userSignup(Request $request){
      $validate = $request->validate([
        'name'=>'required | min:3',
        'email'=>'required | email | unique:users',
        'password'=>'required | min:3 | confirmed',
      ]);
      $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
      ]);

      // 
      
       $link = Crypt::encryptString($user->email);
       $link = url('/verify-user/'.$link);
      Mail::to($user->email)->send(new VerifyUser($link));

      // 

      if($user){
        Session::put('user',$user);
        if(Session::has('quiz-url')){
         
          $url=Session::get('quiz-url');
          Session::forget('quiz-url');
          return redirect($url)->with('message-success',"User registered successfully, Please check email to verify account ");
        }else{
          return redirect('/')->with('message-success',"User registered successfully, Please check email to verify account ");
        }
        
        
      }
      
}


    function userLogout(){
      Session::forget('user');
      return redirect('/');
    }
    function userSignupQuiz(){
     Session::put('quiz-url',url()->previous());
      return view('user-signup');
    }


    function userLogin(Request $request){
      $validate = $request->validate([
        'email'=>'required | email',
        'password'=>'required',
      ]);

     $user= User::where('email',$request->email)->first();
     if(!$user || !Hash::check($request->password,$user->password)){
      return redirect('user-login')->with('message-error',"User not valid, Please check email and password again");
     }

      if($user){
        Session::put('user',$user);
        if(Session::has('quiz-url')){
         
          $url=Session::get('quiz-url');
          Session::forget('quiz-url');
          return redirect($url);
        }else{
          return redirect('/');
        }
        
        
      }
      
}
function userLoginQuiz(){
  Session::put('quiz-url',url()->previous());
   return view('user-login');
 }
function mcq($id, $name){
    $mcqData = MCQ::find($id);
    
    if(!$mcqData){
        return "MCQ not found";
    }

    $record = new Record();
    $record->user_id = Session::get('user')->id;
    $record->quiz_id = $mcqData->quiz_id;
    $record->status = 1;

    if($record->save()){
        $currentQuiz = [];
        $currentQuiz['totalMcq'] = MCQ::where('quiz_id', $mcqData->quiz_id)->count();
        $currentQuiz['currentMcq'] = 1;
        $currentQuiz['quizName'] = $name;
        $currentQuiz['quizId'] = $mcqData->quiz_id;
        $currentQuiz['recordId'] = $record->id;

        Session::put('currentQuiz', $currentQuiz);

        return view('mcq-page', ['quizName' => $name, 'mcqData' => $mcqData]);
    } else {
        return "Something went wrong";
    }
}
function submitAndNext(Request $request, $id){
     
    $currentQuiz = Session::get('currentQuiz');

    // ✅ Timeout ho ya option null ho — dono allow, but non-timeout + null = error
    $timedOut = $request->input('timed_out') == '1';

    if(is_null($request->option) && !$timedOut){
        return redirect()->back()->with('error', 'Please select an answer before continuing.');
    }
    
    if($currentQuiz['currentMcq'] < $currentQuiz['totalMcq']){
        $currentQuiz['currentMcq'] += 1;
    }
    
    $mcqData = MCQ::where([
        ['id', '>', $id],
        ['quiz_id', '=', $currentQuiz['quizId']]
    ])->first();

    $isExist = MCQ_Record::where([
        ['record_id', '=', $currentQuiz['recordId']],
        ['mcq_id', '=', $request->id],
    ])->count();

    if($isExist < 1){
        $mcq_record = new MCQ_Record;
        $mcq_record->record_id = $currentQuiz['recordId'];
        $mcq_record->user_id = Session::get('user')->id;
        $mcq_record->mcq_id = $request->id;
        $mcq_record->select_answer = $request->option ?? 'none'; // ✅ timeout mein null na jaye
        
        // ✅ Timeout = always wrong, answer diya = check karo
        if($timedOut){
            $mcq_record->is_correct = 0;
        } else {
            $mcqObj = MCQ::find($request->id);
            if($mcqObj && $request->option == $mcqObj->correct_ans){
                $mcq_record->is_correct = 1;
            } else {
                $mcq_record->is_correct = 0;
            }
        }

        if(!$mcq_record->save()){
            return "something went wrong";
        }
    }

    Session::put('currentQuiz', $currentQuiz);

    if($mcqData){
        return view('mcq-page', [
            'quizName' => $currentQuiz['quizName'],
            'mcqData' => $mcqData
        ]);
    } else {
        $resultData = MCQ_record::WithMCQ()
            ->where('record_id', $currentQuiz['recordId'])
            ->get();

        $correctAnswers = MCQ_record::where([
            ['record_id', '=', $currentQuiz['recordId']],
            ['is_correct', '=', 1],
        ])->count();

        $record = Record::find($currentQuiz['recordId']);
        if($record){
            $record->status = 2;
            $record->update();
        }

        return view('quiz-result', [
            'resultData' => $resultData,
            'correctAnswers' => $correctAnswers
        ]);
    }
}

 function userDetails(){
   $quizRecord = Record::WithQuiz()->where('user_id',Session::get('user')->id)->get();
  return view('user-details',['quizRecord'=>$quizRecord]);
 }

 function searchQuiz(Request $request){
  $quizData = Quiz::withCount('Mcq')->where('name','Like','%'.$request->search.'%')->get();
  return view('quiz-search',['quizData'=>$quizData,'quiz'=>$request->search]);
 }
    
 function verifyUser($email){
 echo $orgEmail = Crypt::decryptString($email);
 $user= User::where('email',$orgEmail)->first();
 if($user){
  $user->active=2;

  if($user->save())
  {
    return redirect('/')->with('message-success',"User verified successfully");

  }
 }

 }


 function userForgotPassword(Request $request){

  $link = Crypt::encryptString($request->email);
  $link = url('/user-forgot-password/'.$link);
 Mail::to($request->email)->send(new UserForgotPassword($link));
 return redirect('/')->with('message-success',"Please check email to set new password");
 }

 function userResetForgotPassword($email){
   $orgEmail = Crypt::decryptString($email);
   return view('user-set-forgot-password',['email'=>$orgEmail]);
 }

 function userSetForgotPassword(Request $request){

  $validate = $request->validate([
    'email'=>'required | email |',
    'password'=>'required | min:3 | confirmed',
  ]);

  $user= User::where('email',$request->email)->first();
  if($user){
    $user->password=Hash::make($request->password);
   if( $user->save()){
    return redirect('user-login')->with('message-success',"New password is set, Please login with new Password");
   }
  }

 }

 function certificate(){
  $currentQuiz = Session::get('currentQuiz', []);
  $recordId = $currentQuiz['recordId'] ?? null;
  $correctAnswers = 0;
  $totalQuestions = 0;

  if ($recordId) {
      $correctAnswers = MCQ_Record::where([
          ['record_id', '=', $recordId],
          ['is_correct', '=', 1],
      ])->count();
      $totalQuestions = MCQ_Record::where('record_id', $recordId)->count();
  }

  $data=[];
  $data['quiz']= str_replace('-',' ', $currentQuiz['quizName'] ?? '');
  $data['name']= Session::get('user')['name'];
  $data['score']= $correctAnswers;
  $data['total']= $totalQuestions;
  $data['percentage'] = $totalQuestions ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

  return view('certificate',['data'=>$data]);
 }

 function downloadCertificate(){
  $currentQuiz = Session::get('currentQuiz', []);
  $recordId = $currentQuiz['recordId'] ?? null;
  $correctAnswers = 0;
  $totalQuestions = 0;

  if ($recordId) {
      $correctAnswers = MCQ_Record::where([
          ['record_id', '=', $recordId],
          ['is_correct', '=', 1],
      ])->count();
      $totalQuestions = MCQ_Record::where('record_id', $recordId)->count();
  }

  $data=[];
  $data['quiz']= str_replace('-',' ', $currentQuiz['quizName'] ?? '');
  $data['name']= Session::get('user')['name'];
  $data['score']= $correctAnswers;
  $data['total']= $totalQuestions;
  $data['percentage'] = $totalQuestions ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
  $html = view('download-certificate',['data'=>$data])->render();

  return response(
    Browsershot::html($html)
      ->setOption('waitUntil', 'networkidle0')
      ->setOption('timeout', 60000)
      ->pdf()
  )->withHeaders([
      'Content-Type' => "application/pdf",
      'Content-disposition' => "attachment;filename=certificate.pdf"
  ]);
 }
}
