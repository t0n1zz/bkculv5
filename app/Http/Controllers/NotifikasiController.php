<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Input;
use Excel;
use Redirect;
use Validator;
use Jenssegers\Date\Date;
use App\User;
use App\Notifications\notifikasi;
use Illuminate\Support\Facades\Notification;

class NotifikasiController extends Controller{

    public function read(){
        $id = Input::get('id');
        $user = User::find($id);
        $user->unreadNotifications->markAsRead();
    }
}


