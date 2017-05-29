<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use File;
use Redirect;
use Validator;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;

class ErrorLogController extends Controller {
        
    protected $kelaspath = 'errorlog';
    
    public function index()
    {
        try{
            $id = Auth::user()->getId();

            if($id != 1){
                return Redirect::back();
            }
            $logs = LaravelLogViewer::all();
            
            return view('admins.'.$this->kelaspath.'.index',compact('logs'));
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function destroy()
    {
        try{
            $logs = LaravelLogViewer::all();
            $current_file = LaravelLogViewer::getFileName();
            $file = LaravelLogViewer::pathToLogFile($current_file);
            File::delete($file);
            return Redirect::route('admins.'.$this->kelaspath.'.index')->with('sucessmessage', 'File telah berhasil di hapus.');
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

    public function download()
    {
        try{
            $logs = LaravelLogViewer::all();
            $current_file = LaravelLogViewer::getFileName();
            $file = LaravelLogViewer::pathToLogFile($current_file);
            return response()->download($file);
        }catch (Exception $e){
            return Redirect::back()->withInput()->with('errormessage',$e->getMessage());
        }
    }

}