<?php

class AuthController extends Controller {
    public function login(): void {
        $data = ['titulo' => 'Login - FitManager'];
        $this->view('auth/login', $data);
    }
}
