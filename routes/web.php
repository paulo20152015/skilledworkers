<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/admin/logout','AdminController@logout');
Route::post('/company/logout','CompanyLogicController@logout');
Route::post('/applicant/logout','ApplicantLogicController@logout');
Route::post('/global/all-cities','GlobalLogicContoller@returnCities');
Route::post('/global/towns','GlobalLogicContoller@returnTowns');
Route::post('/global/specializations','GlobalLogicContoller@returnSpecializations');
Route::post('/global/get-posts','GlobalLogicContoller@getPosts');
Route::post('/applicant/register','ApplicantLogicController@register');
Route::post('/applicant/login','ApplicantLogicController@login');
//admin
Route::post('/admin/resetCode','AdminController@resetCode');//forgot request code
Route::post('/admin/resetPass','AdminController@resetPass');//reset pass
//company
Route::post('/company/resetCode','CompanyLogicController@resetCode');//forgot request code
Route::post('/company/resetPass','CompanyLogicController@resetPass');//reset pass
//applicant
Route::post('/applicant/resetCode','ApplicantLogicController@resetCode');//forgot request code
Route::post('/applicant/resetPass','ApplicantLogicController@resetPass');//reset pass

Route::post('/applicant/returnResume','GlobalLogicContoller@returnResume');
Route::post('/applicant/singleViewData','GlobalLogicContoller@applicantViewData');

Route::post('/company/returnCompanyDetails','GlobalLogicContoller@returnCompanyDetails');
Route::post('/admin/company/returnEmployees','GlobalLogicContoller@employment_record_company');//
Route::post('/admin/addSpecialization','AdminController@addSpecialization');
//guest routes
Route::middleware(['guest'])->group(function(){
    Route::post('/admin/login','AdminController@login');
    Route::post('/company/login','CompanyLogicController@login');
    Route::get('/',function(){return view('index');})->name('index');
});

//admin routes
Route::middleware(['auth:admin'])->group(function(){
    Route::get('/admin/archive','AdminPagesController@archive');
    Route::get('/admin','AdminPagesController@index');
    Route::get('/admin/job-post-cat','AdminPagesController@jobPostCategories');
    Route::get('/admin/Admins','AdminPagesController@adminsPage')->middleware('AdminAuthority');
    Route::patch('/admin/admins-archive/{id}','AdminController@archiveAdmin')->middleware('AdminAuthority');
    Route::post('/admin/store','AdminController@store')->middleware('AdminAuthority');
    Route::post('/admin/filter','AdminController@adminFilter')->middleware('AdminAuthority');
    Route::post('/admin/update/{id}','AdminController@update')->middleware('AdminAuthority');
    Route::post('/admin/data','AdminController@getAdminData');
    Route::post('/admin/updateself-pass','AdminController@updatePass');
    Route::post('/admin/updateself','AdminController@updateNumber');
    //companies routes
    Route::get('/admin/companies','AdminPagesController@companies');
    Route::get('/admin/company/{id}','AdminPagesController@company');
    Route::post('/admin/companies/data','AdminController@returnCompaniesData');
    Route::post('/admin/companies/create','AdminController@createCompany');
    Route::patch('/admin/company-archive/{id}','AdminController@archiveCompany');
    //applicants routes
    Route::get('/admin/applicants','AdminPagesController@applicants');
    Route::get('/admin/applicant/{id}','AdminPagesController@applicant');
    Route::post('/admin/applicants','AdminController@getApplicants');
    Route::get('/admin/account','AdminPagesController@account_settings');
    Route::patch('/admin/applicant-archive/{id}','AdminController@archiveApplicant');
    Route::patch('/admin/applicant-ApprovedOrReject/{id}','AdminController@approvedReject');
    //specialization town city routes
    
    Route::post('/admin/addCity','AdminController@addCity');
    Route::post('/admin/specialization','AdminController@getSpecialization');
    Route::post('/admin/city','AdminController@getCity');
    Route::post('/admin/updateSpecialization/{id}','AdminController@updateSpecialization');
    Route::post('/admin/updateCity/{id}','AdminController@updateCity');
    Route::post('/admin/town/{id}','AdminController@getTown');
    Route::post('/admin/updateTown/{id}','AdminController@updateTown');
    Route::post('/admin/addtown/{id}','AdminController@addTown');
});


//user routes
Route::middleware(['auth:web'])->group(function(){
    Route::get('/welcome',function(){
        return view('index');
    });
});

//company routes
Route::middleware(['auth:company'])->group(function(){
    Route::get('/company','CompanyPagesController@index');
    Route::get('/company/job_posts','CompanyPagesController@job_posts');
    Route::get('/company/job_post/{id}','CompanyPagesController@job_post');
    Route::get('/company/applicant/{id}','CompanyPagesController@applicant');
    Route::get('/company/post_archive','CompanyPagesController@post_archive');//post archive page
    Route::get('/company/account','CompanyPagesController@account_setting');
    Route::get('/company/employment','CompanyPagesController@employment');
    Route::post('/company/data','CompanyLogicController@getCompanyData');
    Route::post('/company/all-data','CompanyLogicController@getAllcompanyData');
    Route::post('/company/updateself-pass','CompanyLogicController@updatePass');
    Route::post('/company/updateself','CompanyLogicController@updateNumber');
    Route::post('/company/upload-logo','CompanyLogicController@uploadlogo');
    Route::post('/company/save-profile','CompanyLogicController@saveProfile');
    Route::post('/company/job-posts','CompanyLogicController@returnJobPosts');// cant find
    Route::patch('/company/post-archive/{id}','CompanyLogicController@archivePost');
    Route::post('/company/post_create','CompanyLogicController@createPost');//creating a post
    Route::patch('/company/post_update','CompanyLogicController@updatePost');//creating a post
    Route::post('/company/getSinglePost','CompanyLogicController@getSinglePost');//viewing post single
    Route::post('/company/specializationDoesnt','CompanyLogicController@getSpecializationDoesnt');//specialization doesnt
    Route::post('/company/specializationHas','CompanyLogicController@getSpecializationHas');//specialization has
    Route::post('/company/desOrCreate','CompanyLogicController@desOrCreate');//create or delete specialization
    Route::post('/company/job_post_applicants','CompanyLogicController@job_post_applicants');//create or delete specialization
    Route::post('/company/ApproveApplicant','CompanyLogicController@ApproveApplicant');//qualified applicant
    Route::post('/company/NotApproved','CompanyLogicController@NotApproved');//unqualified applicant
    Route::post('/company/pending','CompanyLogicController@pending');//unqualified applicant
    Route::post('/company/hireApplicant/{id}','CompanyLogicController@hireApplicant');//unqualified applicant
    Route::post('/company/returnEmployees','CompanyLogicController@returnEmployees');//
    Route::post('/company/employment/{id}','CompanyLogicController@deleteEmployment');//delete employment
    Route::post('/company/employmentContract/{id}','CompanyLogicController@endEmployment');//end employment
    Route::post('/company/rateEmployee/{id}','CompanyLogicController@rateEmployee');//make rating to employee
    Route::post('/company/getApplicantRatingsByCompany/{id}','CompanyLogicController@getApplicantRatingsByCompany');//get rating to employee by company
    Route::post('/company/updateApplicantRating/{id}','CompanyLogicController@updateApplicantRating');//update arating
    Route::post('/company/ratings','CompanyLogicController@getCompanyRatings');//get all company ratings route
});
//applicant routes
Route::middleware(['auth:applicant'])->group(function(){
    Route::get('/applicant','ApplicantPagesController@index');
    Route::get('/applicant/myAccount','ApplicantPagesController@account');
    Route::get('/applicant/post/{id}','ApplicantPagesController@job_post')->middleware('can:approved_applicants,App\Applicant_account');
    Route::post('/applicant/post','ApplicantLogicController@getJobPost')->middleware('can:approved_applicants,App\Applicant_account');
    Route::get('/applicant/companies','ApplicantPagesController@companies')->middleware('can:approved_applicants,App\Applicant_account');
    Route::get('/applicant/company/{id}','ApplicantPagesController@company')->middleware('can:approved_applicants,App\Applicant_account');
    Route::get('/applicant/employment','ApplicantPagesController@employment')->middleware('can:approved_applicants,App\Applicant_account');
    Route::post('/applicant/companies/data','AdminController@returnCompaniesData');//return company data list
    Route::post('/applicant/profile_data','ApplicantLogicController@profileData');
    Route::post('/applicant/account_data','ApplicantLogicController@account_data');
    Route::post('/applicant/updatePersonalData','ApplicantLogicController@updatePersonalData');
    Route::post('/applicant/uploadImage','ApplicantLogicController@uploadImage');
    Route::post('/applicant/changePass','ApplicantLogicController@changePass');
    Route::post('/applicant/uploadResume','ApplicantLogicController@uploadResume');
    Route::post('/applicant/updateResume','ApplicantLogicController@updateResume');
    Route::post('/applicant/specializationDoesnt','ApplicantLogicController@getSpecializationDoesnt');
    Route::post('/applicant/specializationHas','ApplicantLogicController@getSpecializationHas');
    Route::post('/applicant/desOrCreate','ApplicantLogicController@desOrCreate');
    Route::post('/applicant/createJobApplication/{post_id}','ApplicantLogicController@createJobApplication');
    Route::post('/applicant/deleteJobApplication/{post_id}','ApplicantLogicController@deleteJobApplication');
    Route::post('/applicant/employmentStat','ApplicantLogicController@ifEmployed');
    Route::post('/applicant/employmentRecords','ApplicantLogicController@returnEmploymentRecord');
    Route::post('/applicant/getCompanyRatingsByApplicant/{id}','ApplicantLogicController@getCompanyRatingsByApplicant');
    Route::post('/applicant/rateCompany/{id}','ApplicantLogicController@rateCompany');
    Route::post('/applicant/updateCompanyRating/{id}','ApplicantLogicController@updateCompanyRating');
    Route::post('/applicant/ratings','ApplicantLogicController@getApplicantRatings');//get all applicant ratings route
    Route::post('/applicant/applicationHistory','ApplicantLogicController@getApplicationPost');//get all applicant ratings route
});