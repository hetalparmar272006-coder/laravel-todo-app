<?php
use App\Http\Contollers\Api\TodoController;

Route::get('/todos',[TodoController::class,'index']);
?>