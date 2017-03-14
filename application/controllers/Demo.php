<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends MY_Controller
{

    const jsonContentType = 'application/json';

    public function login()
    {
        $this->isUserLoggedIn() && $this->redirect('demo/show');
        
        $name = $this->input->post('username');
        $password = $this->input->post('password');
        if (
            !$name
            || !$password
        ) {
            $title = 'Login';
            $output = $this->getMustacheEngine()->render('demo/login', array('title' => $title));
            return $this->output->set_output($output);
        }

        $userModel = $this->getModelFactory()->getModel('User')->find(
            array(
                'name' => $name,
                'password' => md5($password)
            )
        );
        if (!$userModel->exists()) {
            $title = 'Login';
            $error = 'Invalid username or password!';
            $output = $this->getMustacheEngine()->render(
                'demo/login',
                array(
                    'title' => $title,
                    'error' => $error
                )
            );
            return $this->output->set_output($output);
        }

        $userData = array(
            'username'  => $userModel->get('name'),
        );

        $this->session->set_userdata($userData);

        $this->load->helper('url');
        redirect('demo/show');
    }

    public function logout()
    {
        $this->redirectIfNotLoggedIn();

        $this->session->unset_userdata('username');

        $this->load->helper('url');
        redirect('demo/login');
    }

    public function show($id = null)
    {
        $this->redirectIfNotLoggedIn();
        
        $modelFactory = $this->getModelFactory();
        $converter = $this->factoryFactory->createConverterFactory()->createDisplay();

        if (null === $id) {
            $modelCollection = $modelFactory->getModel('User')->findAll(array());
            $viewData = $converter->convertCollection($modelCollection);
            $viewData['title'] = 'Table content';
            $viewData['logout_button'] = true;
            $output = $this->getMustacheEngine()->render('demo/show_table', $viewData);
            return $this->output->set_output($output);
        }
        
        $demoModel = $modelFactory->getModelById('User', $id);
        $viewData = $demoModel->exists()
            ? $converter->convert($demoModel)
            : array('error' => 'not_found');
        $viewData['title'] = 'Show ID: ' . $id;
        $viewData['logout_button'] = true;

        $output = $this->getMustacheEngine()->render('demo/show_record', $viewData);
        return $this->output->set_output($output);
    }

    public function showJson($id = null)
    {
        $this->redirectIfNotLoggedIn();
        
        $modelFactory = $this->getModelFactory();
        $converter = $this->factoryFactory->createConverterFactory()->createJson();

        if (null === $id) {
            $modelCollection = $modelFactory->getModel('User')->findAll(array());
            $jsonData = $converter->convertCollection($modelCollection);
            return $this->output
                ->set_content_type(self::jsonContentType)
                ->set_output($jsonData);
        }

        $demoModel = $modelFactory->getModelById('User', $id);
        $jsonData = $demoModel->exists()
            ? $converter->convert($demoModel)
            : json_encode(array('error' => 'not_found'));
        return $this->output
            ->set_content_type(self::jsonContentType)
            ->set_output($jsonData);
    }

    public function index()
    {
        $this->redirectIfNotLoggedIn();

        $title = 'Index';

        $content = $this->factoryFactory->createFileLoader()->loadDecoded(PROJECT_ROOT . 'bin/index.data');
        $output = $this->getMustacheEngine()->render(
            'demo/index',
            array(
                'title' => $title,
                'content' => $content
            )
        );
        $this->output->set_output($output);
    }
    
}
