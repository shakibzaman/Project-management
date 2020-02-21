<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\ProjectExpenseCategory;
use App\ProjectExpense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects=Project::all();
        return view('admin.search.searchByCat',compact('projects'));
    }

    public function findCatName(Request $id){
        $postID = $_GET['id'];
        //$postID = 1;
        //DB::enableQueryLog();
        $data=DB::table('project_expense_categories')
            ->join('project_expenses','project_expense_categories.id','=','project_expenses.cat_id')
            ->join('projects','projects.id','=','project_expenses.pro_id')
            //->join('project_expense_categories','project_expense_categories.id','=','project_expenses.cat_id')
            ->select('project_expense_categories.*','project_expenses.*')
            ->where('projects.id','=',$postID)
            ->get();
//
//        $data=DB::table('project_expense_categories')
//            ->join('project_expenses','project_expense_categories.id','=','project_expenses.cat_id')
//            ->join('projects','projects.id','=','project_expenses.pro_id')
//            //->join('project_expense_categories','project_expense_categories.id','=','project_expenses.cat_id')
//            ->select('project_expense_categories.*')
//            //->select('project_expenses.*')
//            ->groupBy('project_expense_categories.name')
//            ->where('projects.id','=',$postID)
//            ->get();
//            dd(DB::getQueryLog());


//            return response()->json($data);
            return response()->json($data);
    }
    public function findExpName(Request $id){
        $postID = $_GET['id'];
        $projecID = $_GET['project_id'];
        //$postId2=$_GET['id2'];
        //return $postID;
        $data=ProjectExpense::with('laboures')->where('cat_id','=',$postID)->where('pro_id', '=', $projecID)->get();
        return response()->json($data);
    }

}
