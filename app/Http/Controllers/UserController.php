<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->all();
        $sort = 'asc';
        $param = '';
        return view("client.index", compact("users","sort", "param"));
    }

    public function save(Request $request)
    {
        $dataForm = $request->all();
        $save = $this->user->create($dataForm);
        if($save) {
            return http_response_code(200);
        } else {
            return http_response_code(500);
        }
    }

    public function put(Request $request, $id)
    {
        $user = $this->user->find($id);
        $dataForm = $request->all();
        $update = $user->update($dataForm);
        if($update) {
            return http_response_code(200);
        } else {
            return http_response_code(500);
        }
    }

    public function selectClient($id)
    {
        $user = $this->user->find($id);
        return response()->json($user);
    }
    public function delete($id)
    {
        $user = $this->user->find($id);
        $delete = $user->delete($user);
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
            $users = $this->user->all();
            return view("client.index", compact("users","sort", "param"));
        }
        $users = $this->user->where('name', 'LIKE', "%{$search['insert']}%")
                            ->orWhere('email', 'LIKE', "%{$search['insert']}%")
                            ->orWhere('phone', 'LIKE', "%{$search['insert']}%")
                            ->orWhere('address', 'LIKE', "%{$search['insert']}%")
                            ->orWhere('number', 'LIKE', "%{$search['insert']}%")
                            ->get();
        return view('client.index', compact("users", "sort", "param"));
    }

    public function select(Request $request)
    {
        list($null, $null, $sort, $param) = explode("/", $request->getRequestUri());
        $users = $this->user->orderBy($param, $sort)->get();
        return view('client.index', compact("users", "sort", "param"));
    }
}
