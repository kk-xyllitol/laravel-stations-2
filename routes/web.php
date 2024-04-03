<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReservationController;

// Movie
// 一覧ページ（管理者）
Route::get('/admin/movies', [MovieController::class, 'adminMovies']);
// 作成ページ（管理者）
Route::get('/admin/movies/create', [MovieController::class, 'create']);
// 作成（管理者）
Route::post('/admin/movies/store', [MovieController::class, 'store']);
// 詳細ページ（管理者）
Route::get('/admin/movies/{id}', [MovieController::class, 'adminDetail']);

// 編集ページ（管理者）
Route::get('/admin/movies/{id}/edit', [MovieController::class, 'edit']);
// 更新（管理者）
Route::patch('/admin/movies/{id}/update', [MovieController::class, 'update']);
// 削除（管理者）
Route::delete('/admin/movies/{id}/destroy', [MovieController::class, 'destroy']);

// Schedule
// 一覧ページ（管理者）
Route::get('/admin/schedules', [ScheduleController::class, 'show']);
// 詳細ページ（管理者）
Route::get('/admin/schedules/{id}', [ScheduleController::class, 'detail']);
// 作成ページ（管理者）
Route::get('/admin/movies/{id}/schedules/create', [ScheduleController::class, 'create'])->name('schedule.create');
// 作成（管理者）
Route::post('/admin/movies/{id}/schedules/store', [ScheduleController::class, 'store']);
// 編集ページ（管理者）
Route::get('/admin/schedules/{scheduleId}/edit', [ScheduleController::class, 'edit']);
// 更新（管理者）
Route::patch('/admin/schedules/{id}/update', [ScheduleController::class, 'update']);
// 削除（管理者）
Route::delete('/admin/schedules/{id}/destroy', [ScheduleController::class, 'destroy']);

// Reservation
// 一覧ページ（管理者）
Route::get('/admin/reservations', [ReservationController::class, 'show'])->name('admin.reservations');
// 作成ページ（管理者）
Route::get('/admin/reservations/create', [ReservationController::class, 'adminCreate'])->name('admin.reservations.create');
// 作成（管理者）
Route::post('/admin/reservations', [ReservationController::class, 'adminStore'])->name('admin.reservations.post');
// 詳細・編集ページ（管理者）
Route::get('/admin/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('admin.reservations.edit');
// 更新（管理者）
Route::patch('/admin/reservations/{id}', [ReservationController::class, 'update'])->name('admin.reservations.update');
// 削除（管理者）
Route::delete('/admin/reservations/{id}', [ReservationController::class, 'destroy'])->name('admin.reservations.destroy');


// ログイン必要
  // Movie
  // 一覧ページ
  Route::get('/movies', [MovieController::class, 'movies'])->name('movie.show');
  // 詳細ページ
  Route::get('/movies/{id}', [MovieController::class, 'detail'])->name('movie.detail');

  // Sheet
  // 一覧ページ
  Route::get('/sheets', [SheetController::class, 'show']);
  // 座席一覧ページ
  Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets', [SheetController::class, 'reservation'])->name('sheets.reservation');

  // Reservation
  // 座席予約ページ
  Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create', [ReservationController::class, 'create'])->name('reservation.create');
  // 予約
  Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservation.store');
