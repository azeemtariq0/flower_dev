<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Models\Expense;
use App\Models\ReceiptType;
use App\Models\ExpenseCategory;
use App\Models\Unit;
use App\Models\block;
use App\Models\Project;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['page_management'] = array(
                'page_title' => 'Dashboard',
                'slug' => ''
            );
    return view('home2', compact('data'));
    


    }
    public function getonthWiseReceipt(){
                     $receipt =  Receipt::select(
                            DB::raw("sum(amount) as amount"),
                            DB::raw("sum(if(status=1,1,0)) as approved"),
                            DB::raw("sum(if(status=0,1,0)) as pending"),
                            DB::raw("MONTH(receipt_date) as month"),
                            DB::raw("MONTHNAME(receipt_date) as month_name")
                        )
                        ->whereYear('receipt_date', date('Y'))
                        ->where('soceity_id',auth()->user()->soceity_id);

                        if(@auth()->user()->project_id){
                            $receipt  = $receipt->where('project_id',auth()->user()->project_id);
                        }
                        if(@auth()->user()->block_id){
                            $receipt  = $receipt->where('block_id',auth()->user()->block_id);
                        }

                        $receipt = $receipt->groupBy('receipt_date');
                        $receipt = $receipt->get();
                        $receipt = $receipt->toArray();
                         return $receipt;
    }
      public function getonthWiseExpense(){
                      $expense = Expense::select(
                            DB::raw("sum(amount) as amount"),
                            DB::raw("MONTH(exp_date) as month"),
                            DB::raw("MONTHNAME(exp_date) as month_name")
                        )
                        ->leftJoin('as_expense_detail as exd', 'exd.expense_id', '=', 'as_expenses.id')
                        ->where('soceity_id',auth()->user()->soceity_id)
                        ->whereYear('exp_date', date('Y'));

                         if(@auth()->user()->project_id){
                            $expense  = $expense->where('project_id',auth()->user()->project_id);
                        }
                        if(@auth()->user()->block_id){
                            $expense  = $expense->where('block_id',auth()->user()->block_id);
                        }

                        $expense = $expense->groupBy('exp_date');
                        $expense =  $expense->get();
                        $expense =  $expense->toArray();
                        return $expense;
    }

    public function typeWiseSum($result,$type){
        $record = [];
        $amount = 0;
        $exist =[];
        foreach ($result as $value){

           if(!isset($exist[$value->$type])){
               $amount = 0;
           }
           $exist[$value->$type] = $value->$type;
           $amount+= $value->amount;
           $record[$value->$type] = $amount;
       }
         return $record;
    }

    public function allBlocks($id){

        $blocks = block::where('project_id', $id);
        if(auth()->user()->block_id){
             $blocks = $blocks->where('id', auth()->user()->block_id);
        }
        $blocks = $blocks->get();
        return response()->json($blocks);
    }
   public function getBlocks(Request $request){
        $blocks = block::where('project_id', $request->project_id);
        if(auth()->user()->block_id){
             $blocks = $blocks->where('id', auth()->user()->block_id);
        }
        $blocks = $blocks->get();
        return response()->json($blocks);
    }

}
