<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $bookCount = Book::count();
        $categoryCount =Category::count();
        $userCount = User::count();
        $rent_logs = RentLogs::with(['user', 'book'])->get();

        return view('dashboard',['book_count' => $bookCount,'category' => $categoryCount,'user_count' => $userCount, 'rent_logs' => $rent_logs]);
    }
}
