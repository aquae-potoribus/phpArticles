<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog; // Замените "YourModel" на имя вашей модели

class DataController extends Controller
{
    public function getAllData()
    {
        $data = Blog::all(); // Получение всех данных из базы данных. Замените "YourModel" на имя вашей модели

        return response()->json($data);
    }
}
