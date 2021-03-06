<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use App\Http\Controllers\Controller;
use App\Income;
use App\ProjectAmountReceive;
use App\ProjectExpense;
use Carbon\Carbon;

class ExpenseReportController extends Controller
{
    public function index()
    {
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            request()->query('y', Carbon::now()->year),
            request()->query('m', Carbon::now()->month)
        ));
        $to      = clone $from;
        $to->day = $to->daysInMonth;

        $expenses = Expense::with('expense_category')
            ->whereBetween('entry_date', [$from, $to]);

        $incomes = Income::with('income_category')
            ->whereBetween('entry_date', [$from, $to]);
        $projectCost=ProjectExpense::with('catName')
            ->whereBetween('entry_date',[$from, $to]);
        $receivedamount=ProjectAmountReceive::with('projectName')
            ->whereBetween('entry_date',[$from, $to]);
        $receivedTotal=$receivedamount->sum('amount');
        $projectExpensesTotal   = $projectCost->sum('amount');
        $expensesTotal   = $expenses->sum('amount')+$projectExpensesTotal;
        $incomesTotal    = $incomes->sum('amount')+$receivedTotal;
        //$groupedReceived = $receivedamount->whereNotNull('pro_id')->orderBy('amount', 'desc')->get()->groupBy('pro_id');
        $groupedExpenses = $expenses->whereNotNull('expense_category_id')->orderBy('amount', 'desc')->get()->groupBy('expense_category_id');
        $groupedIncomes  = $incomes->whereNotNull('income_category_id')->orderBy('amount', 'desc')->get()->groupBy('income_category_id');
        $profit          = $incomesTotal - $expensesTotal;
        $balance=

        $expensesSummary = [];

        foreach ($groupedExpenses as $exp) {
            foreach ($exp as $line) {
                if (!isset($expensesSummary[$line->expense_category->name])) {
                    $expensesSummary[$line->expense_category->name] = [
                        'name'   => $line->expense_category->name,
                        'amount' => 0,
                    ];
                }

                $expensesSummary[$line->expense_category->name]['amount'] += $line->amount;
            }
        }

        $incomesSummary = [];

        foreach ($groupedIncomes as $inc) {
            foreach ($inc as $line) {
                if (!isset($incomesSummary[$line->income_category->name])) {
                    $incomesSummary[$line->income_category->name] = [
                        'name'   => $line->income_category->name,
                        'amount' => 0,
                    ];
                }

                $incomesSummary[$line->income_category->name]['amount'] += $line->amount;
            }
        }


        return view('admin.expenseReports.index', compact(
            'expensesSummary',
            'incomesSummary',
            'expensesTotal',
            'incomesTotal',
            'profit',
            'projectExpensesTotal',
            'receivedTotal',
            'balance'
        ));
        //return $groupedReceived;
    }
}
