<?php

namespace App\Http\Controllers;

use th;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->where('status', '=', 'active')->get();
        $books = Book::all();
        return view('book-rent', ['users'=>$users, 'books'=>$books]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        $book = Book::findOrFail($request->book_id)->only('status'); 
        
        if($book['status']  != 'in stock'){
            Session::flash('status', 'This book is not available for rent');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-rent');
        }
        else{
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

            if ($count >= 3) {
                Session::flash('status', "Cant rent, user has reach book limits");
                Session::flash('alert-class', 'alert-danger');
                return redirect('book-rent');
            }

            DB::beginTransaction();
            //process insert to rent_logs table
            RentLogs::create($request->all());
            //process update book table
            $book = Book::findOrFail($request->book_id);
            $book->status = 'not available';
            $book->save();
            DB::commit();

            Session::flash('status', 'Rent book success!');
            Session::flash('alert-class', 'alert-success');
            return redirect('book-rent');
        }
    }

    public function bookReturn()
    {
        $users = User::where('id', '!=', 1)->where('status', '=', 'active')->get();
        $books = Book::all();
        $rent_logs = RentLogs::with(['user', 'book'])->get();
        return view('book-return', ['users'=>$users, 'books'=>$books,'rent_logs' => $rent_logs]);
    }

    public function saveReturnBook(Request $request)
    {
        $rent = Rentlogs::where('user_id',$request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null);
        $rentData = $rent->first();
        $countData = $rent->count();

        if($countData == 1){
            $rentData->actual_return_date = Carbon::now()->toDateString();
            $rentData->save();

            $book = Book::findOrFail($request->book_id);
            $book->status = 'in stock';
            $book->save();

            $request->session()->flash('status', 'Book Returned Successfully');
            $request->session()->flash('alert-class', 'alert-success');
            $users = User::where('id', '!=', 1)->where('status', '=', 'active')->get();
            $books = Book::all();
            $rent_logs = RentLogs::with(['user', 'book'])->get();
            return view('book-return', ['users'=>$users, 'books'=>$books,'rent_logs' => $rent_logs]);
        }

        $request->session()->flash('status', 'The book is not curently rent by user');
            $request->session()->flash('alert-class', 'alert-danger');
            $users = User::where('id', '!=', 1)->where('status', '=', 'active')->get();
            $books = Book::all();
            $rent_logs = RentLogs::with(['user', 'book'])->get();
            return view('book-return', ['users'=>$users, 'books'=>$books,'rent_logs' => $rent_logs]);
    }
}
