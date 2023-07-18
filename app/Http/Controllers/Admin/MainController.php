<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Message;
use App\Models\Processes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'admin']);
    }
    
    // The admin dashboard
    public function viewDashboard() {
        $countOfNews = Processes::count();
        $countOfTrueNews = Processes::where('result', 1)->count();
        $countOfFakeNews = Processes::where('result', 0)->count();
        $countOfUsers = User::count();
        return view('Admin.dashboard', compact('countOfNews', 'countOfTrueNews', 'countOfFakeNews', 'countOfUsers'));
    }

    // View users informations 
    public function viewUsers() {
        $users = User::withCount('processes')->get();
        return view('Admin.users', compact('users'));
    }

    // Delete specific user by his id
    public function deleteUser($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('status', 'user-deleted');
    }

    // Show the processes of specific user
    public function showProcessesForUser($userId) {
        $user = User::find($userId);
        $processes = $user->processes;
        return view('Admin.ShowUserprocesses')->with(['processes' => $processes, 'userName' => $user->name]);
    }

    // Determine if there are unread messages or not
    public static function hasUnreadMessages() {
        $unreadCount = Message::where('read', false)->count();
        return $unreadCount > 0;
    }

    // Show messages sent by users
    public function showUserMessages() {
        $messages = Message::orderBy('created_at', 'desc')->get();
        Message::where('read', false)->update(['read' => true]);
        return view('admin.showUsersmessages', ['messages' => $messages]);
    }

    // Delete specific message using its id
    public function deleteMessage($id) {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->back()->with('status', 'message-deleted');
    }

    public function showAllProcesses() {
        $processes = Processes::all();
        return view('admin.showProcesses', ['processes' => $processes]);
    }

    public function showUserOfProcess($id) {
        $user = User::find($id);
        return view('Admin.ShowUserOfProcess')->with(['user' => $user]);
    }

    public function deleteProcess($id) {
        $process = Processes::findOrFail($id);
        $process->delete();
        return redirect()->back()->with('status', 'process-deleted');
    }

    public function showRealNews() {
        $processes = Processes::where('result', 1)->get();
        return view('admin.showProcesses', ['processes' => $processes]);
    }

    public function showFakeNews() {
        $processes = Processes::where('result', 0)->get();
        return view('admin.showProcesses', ['processes' => $processes]);
    }
    
    public function getProcessesToDashboard() {
        $processes = Processes::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(CASE WHEN result = 1 THEN 1 ELSE 0 END) as ones'),
            DB::raw('SUM(CASE WHEN result = 0 THEN 1 ELSE 0 END) as zeros')
        )->groupBy('month')->get();

        return response()->json($processes);
    }

    public function getFakeNewsPerecentage() {
        $countOfNews = Processes::count();
        $countOfFakeNews = Processes::where('result', 0)->count();
        $percentage = ($countOfFakeNews / $countOfNews) * 100;
        $formattedPercentage = number_format($percentage, 1);
        return response()->json($formattedPercentage);
    }
}
