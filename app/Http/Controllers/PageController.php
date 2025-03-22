<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Blog;
use App\Models\CompanyInfo;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function getInfos()
    {
        $info = CompanyInfo::all()->toArray();

        $array = array();
        foreach ($info as $key => $value) {
            $array += [$value['info_name'] => $value['info']];
        }


        $data = $array;

        // $data = Settings::hydrate($data);
        return $data;
    }
    public function index()
    {
        $info = $this->getInfos();
        $gallery = new GalleryController();
        $gallery = $gallery->index();
        $adverts = new AdvertController();
        $adverts = $adverts->index();
        $books = new BookController();
        $books = $books->index();
        $socials = Social::where('soc_status', '=', 'active')->get();

        $staff = Admin::where('adm_level', '>', 0)->where('adm_level', '<', 4)->get();
        $blogs = Blog::where('blog_status', '=', 'active')->get();
        $cartItems = \Cart::getContent();
        return view('index', compact('info', 'socials', 'cartItems', 'blogs', 'gallery', 'staff', 'books', 'adverts'));
    }
    public function about()
    {
        $info = $this->getInfos();
        $gallery = new GalleryController();
        $gallery = $gallery->index();
        $socials = Social::where('soc_status', '=', 'active')->get();

        $staff = Admin::where('adm_level', '>', 0)->where('adm_level', '<', 4)->get();
        $blogs = Blog::where('blog_status', '=', 'active')->get();
        $cartItems = \Cart::getContent();
        return view('about', compact('info', 'socials', 'cartItems', 'blogs', 'gallery', 'staff',));
    }
    public function blog()
    {
        $info = $this->getInfos();
        $socials = Social::where('soc_status', '=', 'active')->get();
        $blogs = Blog::where('blog_status', '=', 'active')->orderBy('blog_id', 'DESC')
            ->paginate(12);
        $cartItems = \Cart::getContent();

        return view('blog', compact('info', 'socials', 'cartItems', 'blogs'));
    }
    public function store()
    {
        $info = $this->getInfos();
        $socials = Social::where('soc_status', '=', 'active')->get();
        $books = new BookController();
        $books = $books->index();
        $cartItems = \Cart::getContent();

        return view('books', compact('info', 'socials', 'cartItems', 'books'));
    }
    public function storesearch(Request $request)
    {
        $search = $request->input('book');
        $info = $this->getInfos();
        $socials = Social::where('soc_status', '=', 'active')->get();
        $books = new BookController();
        $books = $books->search($search);
        $cartItems = \Cart::getContent();

        return view('booksearch', compact('info', 'socials', 'cartItems', 'books'));
    }
    public function blogDetail($slug)
    {
        $info = $this->getInfos();
        $socials = Social::where('soc_status', '=', 'active')->get();
        $blog = Blog::where('blog_slug', '=', $slug)->first();

        $comments = new CommentController();
        $comments = $comments->show($blog->blog_id);
        $cartItems = \Cart::getContent();

        return view('blog-single', compact('info', 'socials', 'cartItems', 'blog', 'comments'));
    }
    public function services()
    {
        $info = $this->getInfos();
        $socials = Social::where('soc_status', '=', 'active')->get();

        $cartItems = \Cart::getContent();
        $staff = User::where('rank', '>', 0)->where('rank', '<', 4)->get();

        return view('services', compact('info', 'socials'));
    }
    public function contact()
    {
        $info = $this->getInfos();
        $socials = Social::where('soc_status', '=', 'active')->get();

        // $staff = User::where('rank', '>', 0)->where('rank', '<', 4)->get();

        $cartItems = \Cart::getContent();
        return view('contact', compact('info', 'socials', 'cartItems'));
    }
    public function gallery()
    {
        $info = $this->getInfos();
        $socials = Social::where('soc_status', '=', 'active')->get();

        $gallery = new GalleryController();
        $gallery = $gallery->index();
        $cartItems = \Cart::getContent();

        return view('gallery', compact('info', 'socials', 'cartItems', 'gallery'));
    }
    public function videos()
    {
        $info = $this->getInfos();
        $socials = Social::where('soc_status', '=', 'active')->get();

        $videos = new VideoController();
        $videos = $videos->index();
        $cartItems = \Cart::getContent();

        return view('videos', compact('info', 'socials', 'cartItems', 'videos'));
    }
    public function login()
    {
        if (Session::has('user')) {
            return redirect('User');
        } else {
            $cartItems = \Cart::getContent();
            $info = $this->getInfos();
            $socials = Social::where('soc_status', '=', 'active')->get();
            return view('auth-signin-signup', compact('cartItems', 'info', 'socials'));
        }
    }
    public function adminLogin()
    {
        if (Session::has('admin')) {
            return redirect('dashboard');
        } else {
            return view('dashboard.auth-login-basic');
        }
    }
    public function signup()
    {
        if (Session::has('user')) {
            return redirect('User');
        } else {
            $cartItems = \Cart::getContent();
            $info = $this->getInfos();
            $socials = Social::where('soc_status', '=', 'active')->get();
            return view('auth-signin-signup', compact('cartItems', 'info', 'socials'));
        }
    }
    public function forgotPassword()
    {
        if (Session::has('user')) {
            return redirect('User');
        } else {
            return view('dashboard.auth-forgot-password-basic');
        }
    }
    public function privacy()
    {
        $info = $this->getInfos();
        $socials = Social::where('soc_status', '=', 'active')->get();

        // $staff = User::where('rank', '>', 0)->where('rank', '<', 4)->get();
        $cartItems = \Cart::getContent();

        return view('privacy', compact('info', 'socials', 'cartItems'));
    }
    public function checkout()
    {
        if (Session::has('user')) {
            $user = Session::get('user');
            $info = new PageController();
            $info = $info->getInfos();
            $cartItems = \Cart::getContent();
            $socials = Social::where('soc_status', '=', 'active')->get();
            // dd($cartItems);
            return view('checkout', compact('cartItems', 'info', 'user', 'socials'));
        } else {
            return redirect('/login')->with('redirect', '/checkout');
        }
    }
    public function account()
    {
        if (Session::has('user')) {
            $userSes = Session::get('user');
            // dd($userSes->id);
            $user = new UserController();
            $user = $user->show($userSes->id);
            $info = $this->getInfos();
            $mybooks = new UserBookController();
            $mybooks = $mybooks->showByUser($user->id);
            $socials = Social::where('soc_status', '=', 'active')->get();
            $cartItems = \Cart::getContent();
            // dd($cartItems);
            return view('account', compact('cartItems', 'info', 'user', 'socials', 'mybooks'));
        } else {
            return redirect('/login')->with('redirect', '/account');
        }
    }
    public function paymentRedirect(Request $request)
    {
        if ($request->has('transaction_id')) {

            $data = $request->all();
            // $data = $request->all();
            // dd($request);
            $order = new OrderController();
            $order = $order->show($data['tx_ref']);
            $book = new BookController();
            $book = $book->show($order->book_id);
            $transaction = new TransactionController();
            $transaction = $transaction->show($data['tx_ref']);
            // dd($order);
            if ($data['status'] === 'successful'  ||  $data['status'] == 'completed') {
                $user = User::where('id', '=', $order->user_id)->first();
                if ($order->order_status !== 'successful') {
                    // $user_book = new UserBookController();
                    // $user_book = $user_book->create($order->book_id, $order->user_id);
                    $suborder = new TransactionController();
                    $suborder = $suborder->update($request, $data['tx_ref']);
                }
                \Cart::clear();
            }
            $redirect = "/account";
            return view('paymentNotify', compact('data', 'redirect'));
        } else {
            return redirect('/cart');
        }
    }
}
