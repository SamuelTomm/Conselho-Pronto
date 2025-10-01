<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $email = $request->email;
        $password = $request->password;

        // Buscar usuário no banco de dados
        $user = User::where('email', $email)->where('active', true)->first();

        if ($user && Hash::check($password, $user->password)) {
            // Criar sessão de usuário com dados do banco
            session([
                'user_email' => $user->email,
                'user_role' => $user->role,
                'user_name' => $user->name,
                'user_data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'turmas_ids' => $user->turmas_ids ?? [],
                    'disciplinas_ids' => $user->disciplinas_ids ?? [],
                    'active' => $user->active
                ],
                'authenticated' => true
            ]);

            return redirect('/dashboard')
                ->with('success', 'Login realizado com sucesso!');
        }

        // Se chegou aqui, credenciais inválidas
        return back()
            ->withErrors(['email' => 'Credenciais inválidas. Verifique seu email e senha.'])
            ->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        session()->flush();
        return redirect('/')->with('success', 'Logout realizado com sucesso!');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar se é email institucional
        if (!str_ends_with($request->email, '@ivoti.edu.br')) {
            return back()
                ->withErrors(['email' => 'Apenas emails institucionais (@ivoti.edu.br) são aceitos.'])
                ->withInput();
        }

        // Simular envio de email de recuperação
        return back()
            ->with('success', 'Instruções de recuperação de senha foram enviadas para seu email.');
    }
}
