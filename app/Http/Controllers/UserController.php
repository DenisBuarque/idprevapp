<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $user;
    private $permission;

    public function __construct(User $user, Permission $permission)
    {
            $this->middleware('auth');

            $this->user = $user;
            $this->permission = $permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->where('type','A')->get();
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permission->all();
        return view('admin.users.create',['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Validator::make($data, [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:users|max:50',
            'password' => 'required|string|min:6|confirmed',
        ])->validate();

        $data['type'] = 'A';
        $data['password'] =  bcrypt($request->password);
        
        if($request->hasFile('image') && $request->file('image')->isValid()) // salva a imagem de existir
        {
            $file = $request->image->store('users','public');
            $data['image'] = $file;
        }

        $record = $this->user->create($data);
        if($record)
        {
            if(isset($data['permission']) && count($data['permission'])) // salva as permissões
            {
                foreach($data['permission'] as $key => $value):
                    $record->permissions()->attach($value);
                endforeach;
            }

            return redirect('admin/users')->with('success', 'Registro inserido com sucesso!');
        }else{
            return redirect('admin/users')->with('error', 'Erro ao inserido o registro!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = $this->permission->all();
        $user = $this->user->find($id);
        if($user){
            return view('admin.users.edit',['user' => $user, 'permissions' => $permissions]);
        } else {
            return redirect('admin/users')->with('alert', 'Desculpe! Não foi encontrado o registro que procura!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $record = $this->user->findOrFail($id);

        if(!$data['password']):
            unset($data['password']);
        endif;

        Validator::make($data, [
            'name' => 'required|string|max:50',
            'email' => ['required','string','email','max:50',Rule::unique('users')->ignore($id)],
            'password' => 'sometimes|required|string|min:6|confirmed',
        ])->validate();

        if($request->password){
            $data['password'] =  bcrypt($request->password);
        }

        // atualiza as permissões
        $permissions = $record->permissions;
        if(count($permissions)){
            foreach($permissions as $key => $value):
                $record->permissions()->detach($value->id);
            endforeach;
        }

        if(isset($data['permission']) && count($data['permission']))
        {
            foreach($data['permission'] as $key => $value):
                $record->permissions()->attach($value);
            endforeach;
        }

        // atualiza a imagem
        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            if($record['image'] != null){
                if(Storage::exists($record['image'])) {
                    Storage::delete($record['image']);
                }
            }
            
            $new_file = $request->image->store('users','public');
            $data['image'] = $new_file;
        }

        if($record->update($data)):

            return redirect('admin/users')->with('success', 'Registro alterado com sucesso!');
        else:
            return redirect('admin/users')->with('alert', 'Erro ao alterar o registro!');
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->user->find($id);
        if($data->delete()) 
        {
            if(($data['image'] != null) && (Storage::exists($data['image']))){
                Storage::delete($data['image']);
            }

            return redirect('admin/users')->with('success', 'Registro excluído com sucesso!');
        } else {
            return redirect('admin/users')->with('error', 'Erro ao excluir o registro!');
        }
    }
}
