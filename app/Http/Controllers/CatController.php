<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Area;
use App\Atention;
use App\Cat;
use App\Gender;
use App\Hair;
use App\Tail;



class CatController extends Controller
{
    //検索フォーム
    public function search(Request $request){
        
        //検索query(userの入力文字)をqueryに保管
        $query = Cat::query();
        
        //userの入力値を取得
        $name = $request->input('name');

         
        
        //クエリビルダを利用したテーブルの結合
        $query->join('depts', function ($query) use ($req) {
        $query->on('employees.dept_id', '=', 'depts.id');
        });
         
        // もし「部署名」があれば
        if(!empty($dept_name)){
        $query->where('dept_name','like','%'.$dept_name.'%');
        }
         
        // もし「都道府県」があれば
        if(!empty($pref)){
        $query->where('address','like','%'.$pref.'%');
        }
         
        // ページネーション
        $employees = $query->paginate(5);
         
        // ビューへ渡す値を配列に格納
        $hash = array(
        'dept_name' => $dept_name, //pass parameter to pager
        'pref' => $pref, //pass parameter to pager
        'employees' => $employees, //Eloquent
        );
         
        return view('employee.list')->with($hash);  
    }
     
        
    //猫台帳一覧を表示
    public function index() {
        $cats = Cat::all();
        return view('index')->with('cats', $cats);
    }       
}
