<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PdfController;
use App\Http\Middleware\CheckBanned;
use App\Livewire\Consultation;
use App\Livewire\Counter;
use App\Livewire\HistoryPatient;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/',Welcome::class)->name('welcome');

Route::get('/count',Counter::class);

Auth::routes();

Route::middleware(['auth',CheckBanned::class])->prefix('/dashboard')->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/','index')->name('dashboard.main');
        Route::get('treatment','treatment')->name('dashboard.treatments');
        Route::get('patient','patient')->name('dashboard.patient');
        Route::get('appointment','appointmentMedic')->name('dashboard.appointment');
        Route::get('staff','staff')->name('dashboard.staff');
        Route::get('report','report')->name('dashboard.report');
        Route::get('report/appointment','reportAppointment')->name('dashboard.reportAppointment');
        Route::get('settings','settings')->name('dashboard.settings');
        Route::post('settings/phone','setPhone')->name('dashboard.setPhone');
        Route::get('settings/phone','getPhone')->name('dashboard.getPhone');
        // Route::post('dashboard/reservation/{reservation}','deleteReservation')->name('dashboard.deleteReservation');
    });
    Route::get('dashboard/consent/{diagnostic}',[PdfController::class,'generateConsent'])->name('consent');
    Route::get('consultation/{reservation}',Consultation::class)->name('dashboard.consultation');
    Route::get('patient/{person}',HistoryPatient::class)->name('dashboard.historyPatient');
    Route::get('/patient/payment/{diagnostic}',[PdfController::class,'generatePayment'])->name('dashboard.payment');
    Route::get('/patient/{person}/history',[PdfController::class,'generateDiagnostic'])->name('dashboard.history');
});

