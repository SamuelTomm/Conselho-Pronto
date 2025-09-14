<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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

        // Credenciais de teste hardcoded conforme especificado
        $testCredentials = [
            'admin@ivoti.edu.br' => [
                'password' => '123456',
                'role' => 'admin',
                'redirect' => '/dashboard'
            ],
            'professor@ivoti.edu.br' => [
                'password' => '123456',
                'role' => 'professor',
                'redirect' => '/dashboard/professor-turmas'
            ],
            'coordenador@ivoti.edu.br' => [
                'password' => '123456',
                'role' => 'coordenador',
                'redirect' => '/dashboard/conselho-classe'
            ]
        ];

        $email = $request->email;
        $password = $request->password;

        // Verificar credenciais de teste
        if (isset($testCredentials[$email])) {
            $credentials = $testCredentials[$email];
            
            if ($password === $credentials['password']) {
                // Simular sessão de usuário
                session([
                    'user_email' => $email,
                    'user_role' => $credentials['role'],
                    'authenticated' => true
                ]);

                return redirect($credentials['redirect'])
                    ->with('success', 'Login realizado com sucesso!');
            }
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
