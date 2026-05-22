<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Models\Admin;

use App\Models\Expert;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;


class AdminController extends Controller
{
  function dashboard(){
    $totalUsers   = User::count();
    $totalQuizzes = Quiz::count();
    $totalMcqs    = Mcq::count();

    $topCategory = Category::withCount('quizzes')
        ->orderByDesc('quizzes_count')
        ->first();

    $recentUsers = User::latest()->take(5)->get();

    $topQuizzes = Quiz::withCount('Records as attempts_count')  // ✅ fixed
        ->orderByDesc('attempts_count')                          // ✅ fixed
        ->take(5)
        ->get();

    $last7Days = collect(range(6, 0))->map(function($i) {
        $date = \Carbon\Carbon::now()->subDays($i);
        return [
            'date'  => $date->format('d M'),
            'count' => User::whereDate('created_at', $date->format('Y-m-d'))->count(),
        ];
    });

    $recentAttempts = \App\Models\Record::with(['user', 'quiz'])
        ->latest()
        ->take(10)
        ->get();

    $admin = Session::get('admin');
    if($admin){
        return view('admin-dashboard', [
            "name" => $admin->name
        ] + compact(
            'totalUsers', 'totalQuizzes', 'totalMcqs',
            'topCategory', 'recentUsers',
            'topQuizzes', 'last7Days', 'recentAttempts'
        ));
    } else {
        return redirect('admin-login');
    }
}
    function login(Request $request){
  
        $validation = $request->validate([
            "email"=>"required|email",
            "password"=>"required",
        ]); 

        $admin = Admin::where([
            ['email',"=",$request->email],
            ['password',"=",$request->password],
        ])->first();
      
        if(!$admin){
            $validation = $request->validate([
                "user"=>"required",
            ],[
                "user.required"=>"admin does not exist"
            ]); 
        }
       
        Session::put('admin',$admin);
        return redirect('admin-dashboard');

    }
    
      function users(){
        $admin = Session::get('admin');
        if($admin){
               $users= User::orderBy('id','desc')->paginate(5);
            return view('admin',["name"=>$admin->name,'users'=>$users]);
        }
        else{
            return redirect('admin-login');
        }
    }

    function experts(){
        $admin = Session::get('admin');
        if($admin){
               $experts= Expert::orderBy('id','desc')->paginate(5);
            return view('expertlist',["name"=>$admin->name,'experts'=>$experts]);
       
        }else{
            return redirect('admin-login');
        }
    }
    function logout(){
        Session::forget('admin');
        return redirect('admin-login');
    }   
    function deleteUser($id){
         if(!session('admin')){
            return redirect('admin-login');
        }   

         Expert::destroy($id);
return redirect('admin-experts')->with('success', 'Data deleted  successfully!');
    }   

    function addExpert(Request $request){
        $admin = Session::get('admin');
        if($admin){
            return view('add-expert',["name"=>$admin->name]);
        }else{
            return redirect('admin-login');
        }   
        
    }

     function addExperttodb(Request $request){
        $admin = Session::get('admin');

         if(!$admin){
            return redirect('admin-login');
        }
        $validation = $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:experts",
            "password"=>"required",
        ]); 


         $experts = new Expert();
         
         $experts->name=$request->name;
         $experts->email=$request->email;
         $experts->password=$request->password;
           
         if(  $experts->save())
            {
                return redirect('admin-experts')->with('success', 'Expert added successfully!');
            }
       
       
        return redirect('admin-experts')->with('error', 'Failed to add expert!');
}

}