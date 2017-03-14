<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

use CiDemo\FactoryFactory;

class MY_Controller extends CI_Controller
{

    /**
     * @var FactoryFactory
     */
    protected $factoryFactory;

    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var Mustache_Engine
     */
    protected $mustacheEngine;

    public function __construct()
    {
        $this->factoryFactory = new FactoryFactory();
        parent::__construct();
    }

    /**
     * @return Mustache_Engine
     */
    protected function getMustacheEngine()
    {
        if (!$this->mustacheEngine) {
            $this->mustacheEngine = new Mustache_Engine(array(
                'loader' => new Mustache_Loader_FilesystemLoader(VIEWPATH)
            ));
        }
        return $this->mustacheEngine;
    }

    /**
     * @return \CiDemo\Model\Factory
     */
    protected function getModelFactory()
    {
        if (!$this->modelFactory) {
            !isset($this->db) && $this->load->database();
            !isset($this->cache) && $this->load->driver('cache', array('adapter' => 'memcached', 'backup' => 'file'));
            $this->modelFactory = $this->factoryFactory->createModelFactory($this->db, $this->cache);
        }
        return $this->modelFactory;
    }

    /**
     * @desc Redirects to demo/index => aborts script execution!
     */
    protected function redirectIfNotLoggedIn()
    {
        !$this->isUserLoggedIn() && $this->redirect('demo/login');
    }

    /**
     * @return type
     */
    protected function isUserLoggedIn()
    {
        !isset($this->session) && $this->load->library('session');
        return null !== $this->session->userdata('username');
    }

    /**
     * @desc Redirects to demo/index => aborts script execution!
     */
    protected function redirect($page)
    {
        $this->load->helper('url');
        redirect($page);
    }
    
}