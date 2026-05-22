<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;



Route::get('/',[UserController::class,'welcome']);
Route::get('user-quiz-list/{id}/{category}',[UserController::class,'userQuizList']);
Route::get('start-quiz/{id}/{name}',[UserController::class,'startQuiz']);
// Route::view('user-signup','user-signup');
Route::post('user-signup',[UserController::class,'userSignup']);
Route::get('user-logout',[UserController::class,'userLogout']);
Route::get('user-signup-quiz',[UserController::class,'userSignupQuiz']);

Route::get('categories-list',[UserController::class,'categories']);
Route::get('certificate',[UserController::class,'certificate']);
Route::get('download-certificate',[UserController::class,'downloadCertificate']);

Route::get('about',[UserController::class,'about']);

Route::get('contact',[UserController::class,'contact']);

Route::post('contact',[UserController::class,'contactStore']);

Route::get('user-login',function(){
    if(!session()->has('user')){
       return view('user-login');
    }else{
        return redirect('/');
    }
});
Route::get('user-signup',function(){
    if(!session()->has('user')){
       return view('user-signup');
    }else{
        return redirect('/');
    }
});
// Route::view('user-login','user-login');
Route::post('user-login',[UserController::class,'userLogin']);
Route::get('user-login-quiz',[UserController::class,'userLoginQuiz']);
Route::get('search-quiz',[UserController::class,'searchQuiz']);




Route::middleware('CheckUserAuth')->group(function(){
    Route::get('user-details',[UserController::class,'userDetails']);
    Route::post('submit-next/{id}',[UserController::class,'submitAndNext']);
    Route::get('mcq/{id}/{name}',[UserController::class,'mcq']);
});

Route::view('expert-login','expert-login');

Route::post('expert-login',[ExpertController::class,'login']);


Route::middleware('CheckExpertAuth')->group(function(){
    Route::get('dashboard',[ExpertController::class,'dashboard']);
Route::get('expert-categories',[ExpertController::class,'categories']);
Route::get('expert-logout',[ExpertController::class,'logout']);
Route::post('add-category',[ExpertController::class,'addCategory']);
Route::get('category/delete/{id}',[ExpertController::class,'deleteCategory']);
Route::get('/expert/dashboard', [ExpertController::class, 'expertDashboard']);

Route::get('add-quiz',[ExpertController::class,'addQuiz']);
Route::post('add-mcq',[ExpertController::class,'addMCQs']);
Route::get('end-quiz',[ExpertController::class,'endQuiz']);
Route::get('show-quiz/{id}/{quizName}',[ExpertController::class,'showQuiz']);
Route::get('quiz-list/{id}/{category}',[ExpertController::class,'quizList']);
});




                          
Route::view('admin-login','adminlogin');

Route::post('/admin-login',[AdminController::class,'login']);

Route::middleware('CheckAdminAuth')->group(function(){
    Route::get('admin-users',[AdminController::class,'users']);
    Route::get("admin-experts",[AdminController::class,'experts']);
    Route::get('admin-logout',[AdminController::class,'logout']);
    Route::get('delete-expert/{id}',[AdminController::class,'deleteUser']);

    Route::get('admin-add-expert',[AdminController::class,'addExpert']);
    Route::post('/admin-add-expert',[AdminController::class,'addExperttodb']);
   Route::get("admin-dashboard",[AdminController::class,'dashboard']);
});

// Add a route for Google OAuth authentication
Route::get('/auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('auth.google');

// Add a route for Google OAuth callback
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');


