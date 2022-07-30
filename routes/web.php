<?php

Route::get('/', 'Auth\loginController@showLoginForm')->name('login');
Route::get('logout', 'Auth\loginController@logout')->name('logout');


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');


Route::group(['middleware' => ['auth', 'isAdmin']], function(){

    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('admin/today', 'AdminController@getTodayApps')->name('admin.gettodayapps');
    Route::post('admin/donedocapp/{id}', 'AdminController@doneDocApp')->name('admin.donedocapp');
    Route::get('backup', 'AdminController@backUpData')->name('backup');

    ## APPOINTMENTS
    Route::get('patient/{id}/appointment/create', 'AppointmentsController@create')->name('appointment.create');
    Route::post('appointments/search', 'AppointmentsController@search')->name('appointments.search');


    ## FILES
    Route::resource('patient.files', 'FilesController')->except(['index','show'])->names([
        'create' => 'files.create',
        'store' => 'files.store',
        'destroy' => 'files.destroy',
    ]);
    Route::get('files', 'FilesController@index')->name('files.index');
    // Route::get('patient/{id}/files', 'FilesController@show')->name('files.show');


    ## PRESCRIPTIONS
    Route::resource('patient.prescriptions', 'PrescriptionsController')->except(['index'])->names([
        'create' => 'prescriptions.create',
        'store' => 'prescriptions.store',
    ]);
    Route::get('prescription/{id}', 'PrescriptionsController@show')->name('prescriptions.show');
    Route::get('prescriptions', 'PrescriptionsController@index')->name('prescriptions.index');
    // Route::get('patient/{id}/prescriptions', 'PrescriptionsController@patientIndex')->name('patient.prescriptions');
    // Route::post('prescription/update', 'PrescriptionsController@update')->name('prescription.update');
    // Route::post('prescription/delete/{id}', 'PrescriptionsController@destroy')->name('prescriptions.destroy');
    Route::post('prescription/delete/{id}', 'PrescriptionsController@deletePresc')->name('prescriptions.delpresc');

    // Route::get('prescriptions/new', 'PrescriptionsController@new')->name('prescription.new');
    // Route::post('prescriptions/newstore', 'PrescriptionsController@newStore')->name('prescription.newStore');
    Route::post('prescriptions/prescription', 'PrescriptionsController@prescription')->name('prescription.get');

    ## MEDICAL_INFO
    Route::resource('patient.medicalinfo', 'MedicalInfoController')->except(['index','create','edit','show','destroy'])->names([
        'store' => 'medicalinfo.store',
    ]);;
    Route::get('medicalinfo', 'MedicalInfoController@index')->name('medicalinfo.index');
    Route::get('medicalinfo/edit/{id}', 'MedicalInfoController@edit')->name('medicalinfo.edit');
    Route::get('{id}/medicalinfo', 'MedicalInfoController@medicalInfo')->name('medicalinfo.get');
    // Route::get('patient/{id}/medicalinfo/create', 'MedicalInfoController@create')->name('medicalinfo.create');
    // Route::get('patient/{id}/medicalinfo', 'MedicalInfoController@show')->name('medicalinfo.show');
    // Route::delete('patient/{id}/medicalinfo', 'MedicalInfoController@destroy')->name('medicalinfo.destroy');


    ## TEETH
    Route::resource('patient.teeth', 'TeethController')->except(['index','show','create','edit','update'])->names([
        'store' => 'teeth.store',
    ]);
    Route::get('patient/{id}/teeth/edit', 'TeethController@create')->name('teeth.create');
    // Route::get('patient/{id}/teeth', 'TeethController@show')->name('teeth.show');
    Route::get('teeth', 'TeethController@index')->name('teeth.index');
    Route::get('{id}/teeth', 'TeethController@teeth')->name('teeth.get');

    #Users
    Route::get('users', 'UsersController@all')->name('users');
    Route::get('create', 'UsersController@create')->name('user.create');
    Route::post('users', 'UsersController@store')->name('user.store');
    Route::get('users/destroy/{id}', 'UsersController@destroy')->name('user.destroy');

    #Notes
    // Route::get('{id}/note/add', 'NotesController@add')->name('note.add');
    Route::post('{id}/note/store', 'NotesController@store')->name('note.store');
    Route::post('notes/destroy/{id}', 'NotesController@destroy')->name('note.destroy');

});

Route::group(['middleware' => ['auth']], function(){
    ## Home
    Route::get('home', 'HomeController@index')->name('home')->middleware('Mac');
    Route::post('home', 'HomeController@store')->name('home.store');
    Route::get('home/today', 'HomeController@getTodayApps')->name('home.gettodayapps');
    Route::post('home/delapp', 'HomeController@deleteAppointment')->name('home.delapp');
    Route::post('app/endapp', 'HomeController@endAppointment')->name('home.endapp');
    Route::post('home/revisit', 'HomeController@revisit')->name('home.revisit');
    Route::post('home/search', 'HomeController@search')->name('home.search');
    Route::post('home/searchDay', 'HomeController@searchDay')->name('home.searchDay');


    ## PATIENTS
    Route::resource('patients', 'PatientsController')->except(['destroy','update','show']);
    Route::get('patient/{patient}', 'PatientsController@show')->name('patients.show');
    Route::post('patient/destroy', 'PatientsController@destroy')->name('patients.destroy')->middleware('isAdmin');
    Route::post('patient/update', 'PatientsController@update')->name('patients.update');
    Route::post('patient/get', 'PatientsController@patient')->name('patients.get');

    Route::resource('appointments', 'AppointmentsController')->except(['show','create']);

    Route::resource('programs', 'ProgramsController');
    Route::POST('program/update', 'ProgramsController@update')->name('programs.update');
    Route::POST('program/get', 'ProgramsController@getProgram')->name('getProgram');

    Route::resource('sessions', 'SessionsController');
    Route::POST('session/details', 'SessionsController@storeSessionDetails')->name('sessions.store');
    Route::POST('session/file', 'SessionsController@storeFile')->name('store.file');
    Route::get('{id}/sessions/create/','SessionsController@create')->name('sessions.create');

    Route::get('/print','AdminController@print')->name('print');


    #Payments
    // Route::get('payments', 'PaymentsController@all')->name('payments');
    Route::get('payment/create', 'PaymentsController@add')->name('payment.add');
    Route::post('payment', 'PaymentsController@store')->name('payment.store');
});


