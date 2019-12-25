<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    

class PurchaseOrderController extends Controller
{
    private $order;
    public function __construct(PurchaseOrder $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = $this->order->all();
        $sort = 'asc';
        $param = '';
        return view("purchase-order.index", compact("orders","sort", "param"));
    }

    public function save(Request $request)
    {
        $dataForm = $request->all(); 
        $save = $this->order->create($dataForm);
        if($save) {
            return http_response_code(200);
        } else {
            return http_response_code(500);
        }
    }

    public function put(Request $request, $id)
    {
        $order = $this->order->find($id);
        $dataForm = $request->all();
        $update = $order->update($dataForm);
        if($update) {
            return http_response_code(200);
        } else {
            return http_response_code(500);
        }
    }

    public function selectProduct($id)
    {
        $order = $this->order->find($id);
        return response()->json($order);
    }
    public function delete($id)
    {
        $order = $this->order->find($id);
        $delete = $order->delete($order);
        if($delete) {
            return http_response_code(200);
        } else {
            return http_response_code(500);
        }
    }

    public function filtro(Request $request)
    {
        $sort = "asc";
        $param = "";

        $search = $request->except('_token');
        if($search['insert'] == "" || $search['insert'] == null|| $search['insert'] == " ") {
            $orders = $this->order->all();
            return view("purchase-order.index", compact("orders","sort", "param"));
        }
        $orders = $this->order->where('description', 'LIKE', "%{$search['insert']}%")
                            ->orWhere('id', 'LIKE', "%{$search['insert']}%")
                            ->orWhere('active', 'LIKE', "%{$search['insert']}%")
                            ->get();
        return view('purchase-order.index', compact("orders", "sort", "param"));
    }

    public function select(Request $request)
    {
        list($null, $null, $sort, $param) = explode("/", $request->getRequestUri());
        $orders = $this->order->orderBy($param, $sort)->get();
        return view('purchase-order.index', compact("orders", "sort", "param"));
    }
}
