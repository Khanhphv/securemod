<?php

namespace App\Http\Controllers\Admin;

use App\Model\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(25);
        return view('admin.users.list', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $listTransactions = History::where('user_id', $id)->orderBy('updated_at', 'desc')->paginate(25);
        return view('admin.users.edit', compact('user', 'listTransactions'));
    }

    public function update(Request $request, $userId)
    {
         if (!auth()->user()->isAdmin()) {
             return redirect()->back()->with(['level' => 'warning', 'message' => 'No permission']);
         }
        $user = User::findOrFail($userId);
        if ($request->has('password') && $request->password != null) {
            $user->password = Hash::make($request->password);
        }

        $moneyBeforeUpdate = $user->credit;
        $typeBeforeUpdate = $user->type;
        $user->type = $request->type;
        $user->email = $request->email;
        $user->user_ref_commission = $request->user_ref_commission;
        if ($user->credit != $request->credit) {
            $user->credit = $request->credit;
        }
        $history = new History();
        if ($request->credit != $moneyBeforeUpdate) {
            if ($request->note != null) {
                $history->content = "Administrator " . Auth::user()->id . " changed your credit from " . number_format($moneyBeforeUpdate) . " ->  " . number_format($user->credit) . '. Note: ' . $request->note;
            } else
                $history->content = "Administrator " . Auth::user()->id . " changed your credit from " . number_format($moneyBeforeUpdate) . " ->  " . number_format($user->credit);

            if ($moneyBeforeUpdate < $request->credit) {
                $history->action = 'ADMIN_CONG';
                $history->user_id = $user->id;
                $history->amount = $request->credit - $moneyBeforeUpdate;

            } else if ($moneyBeforeUpdate > $request->credit) {
                $history->action = 'ADMIN_TRU';
                $history->user_id = $user->id;
                $history->amount = $request->credit - $moneyBeforeUpdate;
            }
        } else {
            $history->action = 'ADMIN';
            $history->amount = 0;
            $history->user_id = $user->id;
            if ($typeBeforeUpdate != $user->type) {
                $history->content = "Administrator " . Auth::user()->id . " updated user $user->id  from $typeBeforeUpdate to $user->type";
            } else
                $history->content = "Administrator " . Auth::user()->id . " updated user $user->id";

        }
        $history->save();
        $user->save();
        return redirect()->route('user.edit', $userId)->with(['level' => 'success', 'message' => 'Updated susccessfully!']);
    }

    public function search(Request $request)
    {
        $users = [];
        if ($request->get('userID')) {
            $userID = $request->get('userID');
        }
        $transactionID = $request->get('transactionID');

        if (isset($transactionID) && !empty($transactionID)) {
            $history = History::where('nl_token', $transactionID)->get();
            if (count($history) > 0) {
                $users = User::where('id', $history->first()->user_id)->paginate(25);
            }
        }

        if (isset($request->userID) && !empty($request->userID)) {
            $users = User::where('id',$request->userID)->orWhere('email', 'like', '%' . $request->userID . '%')->paginate(25);
        }

        if (count($users) == 0) {
            return redirect()->route('user')->with(['level' => 'warning', 'message' => 'User not found', 'users' => $users]);
        } else if (count($users) == 1) {
            return redirect()->route('user.edit', $users[0]->id);
        } else {
//            return redirect()->back()->with(['users' => $users]);
            return view('admin.users.list', compact('users', 'userID'));
        }
    }

    public function resultSearch($phone)
    {
        $users = User::where('phone', 'like', '%' . $phone . '%')->paginate(25);
        return view('admin.users.list', compact('users'));
    }
}
