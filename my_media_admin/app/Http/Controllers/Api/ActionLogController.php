<?php

namespace App\Http\Controllers\Api;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ActionLogController extends Controller
{
    //set action log
    public function setActionLog(Request $request){
        $data = [
            'user_id' => $request->user_id,
            'new_id' => $request->new_id
        ];
        ActionLog::create($data);
        $data = ActionLog::where('new_id',$request->new_id)->get();
        return response()->json([
            'post' => $data
        ]);
    }

}
