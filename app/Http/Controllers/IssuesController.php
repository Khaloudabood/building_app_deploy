<?php

namespace App\Http\Controllers;
use App\User;
use App\Issue;
use Illuminate\Http\Request;
use App\Mail\IssueRequestSubmited;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Imports\IssuesImport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;


class IssuesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth') ->except(['test']);
    }
    //
    public function list()
    {
        //$data['issues'] = Issue::all();

        $data['users'] = User::all();
        return view ('issues.list', $data);
    }

    public function store(Request $request)
    {
      //  return $request();
       $issue = new Issue();
       $issue ->name = $request ->name;
       $issue ->email = $request ->email;
       $issue ->phone = $request ->phone;
       $issue ->msg = $request ->msg;
       $issue ->building_number = $request ->building_number;
       $issue ->apartment_number = $request ->apartment_number;
       $issue ->user_id = Auth::user()->id;
       $issue ->attachment = null;
       $issue->save();

       \Mail::to($issue->email)->send(new IssueRequestSubmited($issue));

       return "Record is created successfully";

    }

    public function test()
    {
        return "This is a test function";
    }

    public function importFromExcel(Request $request)
    {
        //validait file
        Excel::import(new IssuesImport, $request -> excelFile);

        return "imported successfully" ;
    }
}
