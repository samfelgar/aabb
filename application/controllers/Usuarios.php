<?php

class Usuarios extends MY_Controller {

    private $active = 'sistema';

    public function index() {
        try {
            $this->load->model('dao/loginDAO');
            $this->load->template('usuarios', [
                'active' => $this->active,
                'usuarios' => $this->loginDAO->listar()
            ]);
        } catch (Exception $ex) {
            
        }
    }

    public function novo() {
        try {
            $this->load->model('dao/perfilDAO');
            $this->load->template('novo_usuario', [
                'active' => $this->active,
                'perfis' => $this->perfilDAO->listar()
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function alterar($id) {
        try {
            $this->load->model('login_class');
            $this->load->model('dao/loginDAO');
            $this->load->model('dao/perfilDAO');
            $this->login_class->setId($id);
            $this->load->template('usuario_alterar_perfil', [
                'active' => $this->active,
                'perfis' => $this->perfilDAO->listar(),
                'usuario' => $this->loginDAO->listarPorId($this->login_class)
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function redefinir($id) {
        try {
            $this->load->model('login_class');
            $this->load->model('dao/loginDAO');
            $this->login_class->setId($id);
            $this->load->template('usuario_redefinir', [
                'active' => $this->active,
                'usuario' => $this->loginDAO->listarPorId($this->login_class)
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function alterar_perfil() {
        try {
            $id = $this->input->post('id');
            if (empty($id)) {
                throw new Exception('Não foi possível salvar o perfil do usuário. É necessário informar o ID.');
            }
            $user = $this->input->post('user');
            $perfil = $this->input->post('perfil');
            if (empty($user) || empty($perfil)) {
                throw new Exception('É obrigatório preencher todos os campos.');
            }
            $this->load->model('login_class');
            $this->load->model('perfil');
            $this->load->model('dao/loginDAO');
            $this->login_class->setId($id);
            $this->login_class->setUser($user);
            $this->perfil->setId($perfil);
            $this->login_class->setPerfil($this->perfil);
            $this->loginDAO->alterarPerfil($this->login_class);
            redirect('/usuarios');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function salvar() {
        try {
            $user = $this->input->post('user');
            $pass = $this->input->post('password');
            $pass_confirmation = $this->input->post('password-confirm');
            if (strlen($pass) < 6) {
                throw new Exception('A senha deve ter, no mínimo, 6 caracteres.');
            }
            if ($pass != $pass_confirmation) {
                throw new Exception('As senhas não coincidem.');
            }
            $perfil = $this->input->post('perfil');
            $this->load->model('login_class');
            $this->load->model('perfil');
            $this->load->model('dao/loginDAO');
            $this->login_class->setUser($user);
            $this->login_class->setPass($pass, true);
            $this->perfil->setId($perfil);
            $this->login_class->setPerfil($this->perfil);
            $this->loginDAO->inserir($this->login_class);
            redirect('usuarios');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function alterar_senha($id) {
        try {
            if ($id != $_SESSION['user_id']) {
                throw new Exception('Não é possível acessar essa página.');
            }
            $this->load->template('alterar_senha', [
                'active' => ''
            ]);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function salvar_senha_propria() {
        try {
            $user_id = $_SESSION['user_id'];
            $user = $_SESSION['user'];
            $current = $this->input->post('current-password');
            $new = $this->input->post('new-password');
            $confirmation = $this->input->post('new-password-confirmation');
            if (strlen($new) < 6 || strlen($confirmation) < 6) {
                throw new Exception('Informe as senhas com pelo menos 6 caracteres.');
            }
            $this->load->model('login_class');
            $this->load->model('dao/loginDAO');
            $this->login_class->setId($user_id);
            $this->login_class->setUser($user);
            $this->login_class->setPass($current);
            if (!$this->loginDAO->checkUserPass($this->login_class)) {
                throw new Exception('A senha atual informada não está correta.');
            }
            if ($new != $confirmation) {
                throw new Exception('A senha nova não coincide com a confirmação.');
            }
            $this->login_class->setPass($new, true);
            $this->loginDAO->updatePassword($this->login_class);
            redirect('/');
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function redefinir_senha() {
        try {
            $id = $this->input->post('id');
            $pass = $this->input->post('password');
            $pass_confirm = $this->input->post('password-confirm');
            if (empty($id)) {
                throw new Exception('Todos os campos devem ser preenchidos.');
            }
            if (strlen($pass) < 6) {
                throw new Exception('A senha deve conter, no mínimo, 6 dígitos.');
            }
            if ($pass != $pass_confirm) {
                throw new Exception('As senhas não coincidem.');
            }
            $this->load->model('login_class');
            $this->load->model('dao/loginDAO');
            $this->login_class->setId($id);
            $this->login_class->setPass($pass, true);
            $this->loginDAO->updatePassword($this->login_class);
            redirect('/usuarios');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }
    
    public function excluir($id) {
        try {
            if (empty($id)) {
                throw new Exception('Um id deve ser informado.');
            }
            $this->load->model('login_class');
            $this->load->model('dao/loginDAO');
            $this->login_class->setId($id);
            $this->loginDAO->delete($this->login_class);
            redirect('/usuarios');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

}
