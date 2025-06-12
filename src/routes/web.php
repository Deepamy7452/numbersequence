<?php

use Illuminate\Support\Facades\Route;
use Amy\Numbersequence\Http\Controllers\NumberSequenceController;
 Route::group(['prefix' => 'number-seq', 'middleware' => ['web', 'auth']], function () {
        Route::any('/sequence-list', [NumbersequenceController::class, 'index'])->name('sequence.list')->middleware('check.any.permissions:Number Sequence List View,Number Sequence List Full Access');
        Route::any('/sequence-add', [NumbersequenceController::class, 'addSeq'])->name('sequence.add')->middleware('can:Number Sequence List Full Access');
        Route::any('/sequence-map', [NumbersequenceController::class, 'indexMap'])->name('sequence.map')->middleware('check.any.permissions:Number Sequence Map View,Number Sequence Map Full Access');
        Route::any('/store-numbersequence', [NumbersequenceController::class, 'storeSeq'])->name('store.numbersequence')->middleware('can:Number Sequence List Full Access');
        Route::any('/numbersequence-map', [NumbersequenceController::class, 'mapSeq'])->name('numbersequence.map')->middleware('can:Number Sequence Map Full Access');
        Route::any('/sequence-delete', [NumbersequenceController::class, 'delete_Seq'])->name('sequence.delete')->middleware('can:Number Sequence List Full Access');
        Route::any('/sequence-log-details/{id}', [NumbersequenceController::class, 'showLogdata'])->name('sequence-log.details')->middleware('can:Number Sequence List Full Access');
    });
