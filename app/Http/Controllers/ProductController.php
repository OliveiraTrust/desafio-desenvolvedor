<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->all();
        $sort = 'asc';
        $param = '';
        return view("product.index", compact("products","sort", "param"));
    }

    public function save(ProductFormRequest $request)
    {
        $dataForm = $request->all();
        $save = $this->product->create($dataForm);
        if($save) {
            return http_response_code(200);
        } else {
            return http_response_code(500);
        }
    }

    public function put(ProductFormRequest $request, $id)
    {
        $product = $this->product->find($id);
        $dataForm = $request->all();
        $update = $product->update($dataForm);
        if($update) {
            return http_response_code(200);
        } else {
            return http_response_code(500);
        }
    }

    public function selectProduct($id)
    {
        $product = $this->product->find($id);
        return response()->json($product);
    }
    public function delete($id)
    {
        $product = $this->product->find($id);
        $delete = $product->delete($product);
        if($delete) {
            return http_response_code(200);
        } else {
            return http_response_code(500);
        }
    }

    public function filtro(ProductFormRequest $request)
    {
        $sort = "asc";
        $param = "";

        $search = $request->except('_token');
        if($search['insert'] == "" || $search['insert'] == null|| $search['insert'] == " ") {
            $products = $this->product->all();
            return view("product.index", compact("products","sort", "param"));
        }
        $products = $this->product->where('name', 'LIKE', "%{$search['insert']}%")
                            ->orWhere('id', 'LIKE', "%{$search['insert']}%")
                            ->orWhere('description', 'LIKE', "%{$search['insert']}%")
                            ->orWhere('amount', 'LIKE', "%{$search['insert']}%")
                            ->get();
        return view('product.index', compact("products", "sort", "param"));
    }

    public function select(Request $request)
    {
        list($null, $null, $sort, $param) = explode("/", $request->getRequestUri());
        $products = $this->product->orderBy($param, $sort)->get();
        return view('product.index', compact("products", "sort", "param"));
    }
}
