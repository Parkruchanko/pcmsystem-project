<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Info;
use App\Models\Product;
use App\Models\Seller;
use App\Models\CommitteeMember;
use App\Models\Bidder;
use App\Models\Inspector;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('page')
                        ->with('message', 'Signed in!');
        }

        return redirect('/login')->with('message', 'Login details are not valid!');
    }

    public function signup()
    {
        return view('registration');
    }

    public function signupsave(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $this->create($data);

        return redirect("page");
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }    

    public function index()
    {
        if (Auth::check()) {
            return view('page.index');
        }
        return redirect('/login');
    }

    public function signOut() 
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    public function list()
    {
        $info = Info::with(['products', 'sellers', 'committeemembers', 'bidders', 'inspectors'])->get();
        return view('page.listpage', compact('info'));
    }
    public function listpdf()
    {
        $info = Info::with(['products', 'sellers', 'committeemembers', 'bidders', 'inspectors'])->get();
        return view('page.listpdf', compact('info'));
    }
    public function showCreateForm($id = null)
    {
        $info = $id ? Info::with(['products', 'sellers', 'committeemembers', 'bidders', 'inspectors'])->findOrFail($id) : new Info();
        return view('page.form', compact('info'));
    }
    public function showCreateFormk($id = null)
    {
        $info = $id ? Info::with(['products', 'sellers', 'committeemembers', 'bidders', 'inspectors'])->findOrFail($id) : new Info();
        return view('page.formk', compact('info'));
    }
    public function add(Request $request)
    {
        $info = new Info();
        $this->save($info, $request);

        return redirect('/page')->with('success', 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $info = Info::with(['products', 'sellers', 'committeemembers', 'bidders', 'inspectors'])->findOrFail($id);
        return view('page.form', compact('info'));
    }
    public function editk($id)
    {
        $info = Info::with(['products', 'sellers', 'committeemembers', 'bidders', 'inspectors'])->findOrFail($id);
        return view('page.formk', compact('info'));
    }

    public function update(Request $request, $id)
    {
        $info = Info::with(['products', 'sellers', 'committeemembers', 'bidders', 'inspectors'])->findOrFail($id);
        $this->save($info, $request);

        return redirect('/page')->with('success', 'ข้อมูลถูกอัปเดตเรียบร้อยแล้ว');
    }

    private function save($data, $request)
    {
        DB::transaction(function () use ($data, $request) {
            // อัปเดตข้อมูลของ Info
            $data->methode_name = $request->input('methode_name', $data->methode_name);
            $data->reason_description = $request->input('reason_description', $data->reason_description);
            $data->office_name = $request->input('office_name', $data->office_name);
            $data->date = $request->input('date', $data->date);
            $data->attachdorder = $request->input('attachdorder', $data->attachdorder);
            $data->attachdorder_date = $request->input('attachdorder_date', $data->attachdorder_date);
            $data->devilvery_time = $request->input('devilvery_time', $data->devilvery_time);
            
            $data->save();
        
            // อัปเดตข้อมูลของ Products ถ้ามี
            $products = $request->input('products', []);
            if (is_array($products)) {
                foreach ($products as $productData) {
                    if (is_array($productData)) {
                        Product::updateOrCreate(
                            ['id' => $productData['id'] ?? null],
                            array_merge($productData, ['info_id' => $data->id])
                        );
                    }
                }
            }
        
            // อัปเดตข้อมูลของ Sellers ถ้ามี
            $sellers = $request->input('sellers', []);
            if (is_array($sellers)) {
                foreach ($sellers as $sellerData) {
                    if (is_array($sellerData)) {
                        // ตรวจสอบและปรับค่า taxpayer_number ให้เป็น string
                        if (isset($sellerData['taxpayer_number'])) {
                            $sellerData['taxpayer_number'] = (string) $sellerData['taxpayer_number'];
                        }
                        
                        Seller::updateOrCreate(
                            ['id' => $sellerData['id'] ?? null],
                            array_merge($sellerData, ['info_id' => $data->id])
                        );
                    }
                }
            }
        
            // อัปเดตข้อมูลของ Committee Members ถ้ามี
            $committeemembers = $request->input('committeemembers', []);
            if (is_array($committeemembers)) {
                foreach ($committeemembers as $memberData) {
                    if (is_array($memberData)) {
                        CommitteeMember::updateOrCreate(
                            ['id' => $memberData['id'] ?? null],
                            array_merge($memberData, ['info_id' => $data->id])
                        );
                    }
                }
            }
    
            // อัปเดตข้อมูลของ Bidders ถ้ามี
            $bidders = $request->input('bidders', []);
            if (is_array($bidders)) {
                foreach ($bidders as $bidderData) {
                    if (is_array($bidderData)) {
                        Bidder::updateOrCreate(
                            ['id' => $bidderData['id'] ?? null],
                            array_merge($bidderData, ['info_id' => $data->id])
                        );
                    }
                }
            }
        
            // อัปเดตข้อมูลของ Inspectors ถ้ามี
            $inspectors = $request->input('inspectors', []);
            if (is_array($inspectors)) {
                foreach ($inspectors as $inspectorData) {
                    if (is_array($inspectorData)) {
                        Inspector::updateOrCreate(
                            ['id' => $inspectorData['id'] ?? null],
                            array_merge($inspectorData, ['info_id' => $data->id])
                        );
                    }
                }
            }
        });
    }
    
}
