<?php

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::redirect('/', '/admin/expenses');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Expensecategories
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Incomecategories
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expenses
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Incomes
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expensereports
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    //    projects
    Route::delete('projects/destroy', 'ProjectController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('projects', 'ProjectController');
    //    projectsExpenseController
    Route::delete('project-expense-category/destroy', 'ProjectExpenseCategoryController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('project-expense-category', 'ProjectExpenseCategoryController');

    //    projectsExpense
    Route::delete('project-expense/destroy', 'ProjectExpenseController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('project-expense', 'ProjectExpenseController');

        //projectsReceivedAmount
    Route::delete('project-received/destroy', 'ProjectReceivedAmountController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('project-received', 'ProjectReceivedAmountController');

    //   Labourer
    Route::delete('labourer/destroy', 'LabourerController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('labourer', 'LabourerController');

    //   Contractor
    Route::delete('contractor/destroy', 'ContracterController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('contractor', 'ContracterController');

    //    projectsVoucher
//    Route::delete('invoice-voucher/destroy', 'PaymentVoucherController@massDestroy')->name('expense-reports.massDestroy');
//    Route::resource('invoice-voucher', 'PaymentVoucherController');
//    Route::get('invoice-voucher-print/{id}', 'PaymentVoucherController@print')->name('invoice-voucher-print');

//    Search
    Route::resource('search', 'SearchController');
    Route::get('/findCatName','SearchController@findCatName');
    Route::get('/findExpName','SearchController@findExpName');

});
