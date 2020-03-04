<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\ProjectExpense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class SearchNameController extends Controller
{

    public function index()
    {
        $projects=Project::all();
        return view('admin.search.searchByName',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function findUserName(){
        $postID = $_GET['id'];
        //$postID = 2;
        $data=DB::table('laboures')
            ->join('project_expenses','laboures.id','=','project_expenses.received_by')
            ->join('projects','projects.id','=','project_expenses.pro_id')
            //->join('project_expense_categories','project_expense_categories.id','=','project_expenses.cat_id')
            ->select('laboures.*','project_expenses.*')
            ->where('projects.id','=',$postID)
            ->get();
        return response()->json($data);
    }
    public function findLabExpName(){
        $postID = $_GET['id'];
        $projecID = $_GET['project_id'];
        $data=ProjectExpense::with('catName')->where('received_by','=',$postID)->where('pro_id', '=', $projecID)->get();
        return response()->json($data);
    }
}
