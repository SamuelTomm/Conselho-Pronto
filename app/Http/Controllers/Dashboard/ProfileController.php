<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = session('user_data');
        return view('dashboard.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = session('user_data');
        
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user['id'])
            ],
            'current_password' => 'required_with:password',
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ter um formato válido.',
            'email.unique' => 'Este email já está sendo usado por outro usuário.',
            'current_password.required_with' => 'A senha atual é obrigatória para alterar a senha.',
            'password.min' => 'A nova senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ]);

        // Validação manual da senha atual
        if ($request->filled('password')) {
            if (!$request->filled('current_password')) {
                $validator->errors()->add('current_password', 'A senha atual é obrigatória para alterar a senha.');
            } else {
                // Buscar usuário no banco para verificar senha atual
                $dbUser = User::find($user['id']);
                if (!$dbUser || !Hash::check($request->current_password, $dbUser->password)) {
                    $validator->errors()->add('current_password', 'A senha atual está incorreta.');
                }
            }
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Buscar usuário no banco
            $dbUser = User::find($user['id']);
            
            if (!$dbUser) {
                return redirect()->back()
                    ->with('error', 'Usuário não encontrado.')
                    ->withInput();
            }
            
            // Atualizar dados no banco
            $dbUser->name = $request->name;
            $dbUser->email = $request->email;
            
            // Se uma nova senha foi fornecida, atualizar
            if ($request->filled('password')) {
                $dbUser->password = Hash::make($request->password);
            }
            
            $dbUser->save();
            
            // Atualizar dados na sessão
            $updatedUser = $user;
            $updatedUser['name'] = $request->name;
            $updatedUser['email'] = $request->email;
            $updatedUser['updated_at'] = $dbUser->updated_at;
            
            session(['user_data' => $updatedUser]);
            
            return redirect()->route('profile.index')
                ->with('success', 'Perfil atualizado com sucesso!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao atualizar perfil. Tente novamente.')
                ->withInput();
        }
    }
}
