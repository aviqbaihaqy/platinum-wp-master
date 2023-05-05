<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PragmaRX\Countries\Package\Countries;

use Auth;
use Carbon\Carbon;
use Session;
use View;

use App\Cart;
use App\Contact;
use App\Stock;
use App\Invoice;
use App\InvoiceItem;
use App\User;
use App\Category;
use App\SubCategory;
use App\Brand;
use App\Product;
use App\Notification;
use App\Visitor;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public $subcategories;
    public $notification;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('sales');
        $this->middleware('staff')->except(['index', 'sales']);
        $this->middleware('admin')->only(['staffs']);

        // Navbar and SideBar Items
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $stocks = Stock::all();

        // Widgets
        $stockAmount = count(Stock::all());
        $orderAmount = count(Invoice::where('status', 'paid')->get());
        $staffAmount = count(User::where('role', 'staff')->get());
        $userAmount = count(User::where('role', 'user')->get());

        View::share('categories', $categories);
        View::share('subcategories', $subcategories);
        View::share('subcategory', 'all');

        View::share('stocks', $stocks);
        View::share('stockAmount', $stockAmount);
        View::share('orderAmount', $orderAmount);
        View::share('staffAmount', $staffAmount);
        View::share('userAmount', $userAmount);

        $countries = Countries::all();
        View::share('countries', $countries->toArray());

        View::share('visitors', Visitor::all());
    }

    public function index()
    {

        $now = Carbon::now();
        $startOfDay = $now->copy()->startOfDay();
        $endOfDay = $now->copy()->endOfDay();

        // 10 latest sales
        $todaySales = Invoice::orderBy('created_at')
            ->where('created_at', '>=', $startOfDay)
            ->where('created_at', '<=', $endOfDay)
            ->where('status', '!=', 'unpaid')
            ->where('status', '!=', 'expired')
            ->get();

        // unshipped but paid invoices
        $unshippedSales = Invoice::where('status', 'paid')
            ->where('status', 'paid')
            ->get();

        // 10 latest registered members
        $latestMembers = User::where('role', 'user')
            ->orderBy('created_at')
            ->take(10)
            ->get();

        return Inertia::render('Admin/Dashboard');

        // return view('dashboards.index', compact([
        //     'unshippedSales','todaySales', 'latestMembers',
        // ]));
    }

    public function productLists($subcategoryName = 'all')
    {
        if ($subcategoryName == 'all') {
            $products = Product::orderBy('created_at', 'ASC');
            $subcategory = 'All';
        } else {
            $subcategory = SubCategory::orderBy('created_at', 'ASC')->where('name', $subcategoryName)
                ->get()
                ->first();

            // if requested subcategory not found, go to 404
            if (!$subcategory) abort(404);

            $products = Product::where('subcategory_id', $subcategory->id);
        }

        $products = $products->paginate(8);

        return view('dashboards.product-lists.index', compact(['products', 'subcategory']));
    }

    public function viewProduct($product_id)
    {
        $product = Product::findOrFail($product_id);

        return view('dashboards.product-lists.view', compact(['product']));
    }

    public function stocks()
    {
        $products = Product::all();

        return view('dashboards.inventories', compact(['products']));
    }

    /*
     * ATTENTION THIS IS LEFT UNDONE!
     *
     */
    public function sales($phase = 'all')
    {
        $now = Carbon::now();

        if ($phase == 'weekly') {
            $startOfPhase = $now->copy()->startOfWeek;
            $endOfPhase = $now->copy()->endOfWeek;
        } else if ($phase == 'monthly') {
            $startOfPhase = $now->copy()->startOfMonth;
            $endOfPhase = $now->copy()->endOfMonth;
        } else if ($phase == 'yearly') {
            $startOfPhase = $now->copy()->startOfYear;
            $endOfPhase = $now->copy()->endOfYear;
        }

        $sales = Invoice::where('status', '!=', 'unpaid');
        if ($phase != 'all') {
            $sales = $sales->where('created_at', '>=', $startOfPhase)
                ->where('created_at', '<=', $endOfPhase);
        }
        $sales = $sales->get();

        return view('dashboards.sales-history', compact(['sales']));
    }

    public function invoices()
    {
        $invoices = Invoice::orderBy('created_at', 'DESC')->get();

        return view('dashboards.invoice-histories', compact(['invoices']));
    }

    public function membersCarts()
    {
        $carts = Cart::all()->groupBy(function ($cart, $key) {
            $user = $cart->user;
            $profile = $user->details;

            return $profile->first_name . ' ' . $profile->last_name;
        });

        if ($carts) {
            $carts->each(function ($cart, $key) {
                $cart->userId = $cart->first()->user_id;
                $cart->lastAddedItem = $cart->sortBy('updated_at')->first()->updated_at;
            });
        }

        return view('dashboards.members-carts', compact(['carts']));
    }

    public function showProfile($user_id)
    {
        $user = User::findOrFail($user_id);
        $userDetail = $user->details;

        return view('dashboards.users-management.view-profile', compact(['user', 'userDetail']));
    }

    public function staffs()
    {
        Session::put('selectedUser', null);
        $staffs = User::where('role', '!=', 'user');
        if (Auth::user()->role != 'admin') // if not admin, exclude show admin
            $staffs = $staffs->where('role', '!=', 'admin');
        $staffs = $staffs->get();

        return view('dashboards.users-management.staff-lists', compact(['staffs']));
    }

    public function members()
    {
        Session::put('selectedUser', null);
        $members = User::where('role', 'user')->get();

        return view('dashboards.users-management.member-lists', compact(['members']));
    }

    public function feedbacks()
    {
        $feedbacks = Contact::all();

        $userAmount = count(User::where('role', 'user')->get());
        $latestMembers = User::where('role', 'user')
            ->orderBy('created_at')
            ->take(10)
            ->get();

        return view('dashboards.feedbacks', compact(['userAmount', 'latestMembers', 'feedbacks']));
    }
}
