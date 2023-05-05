<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use View;

use App\Stock;
use App\Invoice;
use App\InvoiceItem;
use App\User;
use App\Category;

class AdminController extends DashboardController
{
	public function __construct()
    {
        parent::__construct();

        $this->middleware('admin');
    }
}
