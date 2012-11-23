<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Name:  MY_Controller
 * 
 * Author:  Ben Edmunds
 * Created:  7.21.2009 
 * 
 * Description:  Class to extend the CodeIgniter Controller Class.  All controllers should extend this class.
 * 
 */
class MY_Controller extends CI_Controller
{

    protected $data = Array();
    protected $auth = Array();
    protected $controller_name;
    protected $action_name;
    protected $previous_controller_name;
    protected $previous_action_name;
    protected $save_previous_url = false;
    protected $previous_url;
    protected $page_title;
    protected $page_template;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));

        $this->output->enable_profiler(TRUE);

        //set the current controller and action name
        $this->controller_name = $this->router->fetch_directory() . $this->router->fetch_class();
        $this->action_name = $this->router->fetch_method();

        $this->page_template = '_layout/body';
        $this->data['themes'] = base_url('themes/bootstrap') . '/';
        $this->data['current_url'] = '';
        $this->data['content'] = '';
        $this->data['css'] = array();
        $this->data['breadcrumbs'] = array();
        $this->data['javascripts'] = array();
        $this->auth = $this->session->userdata('auth');
        $this->data['auth'] = $this->auth;
    }

    function set_page_template($template)
    {
        $this->page_template = $template;
    }

    function set_data($param = '', $val = '')
    {
        if (is_array($param))
        {
            foreach ($param as $k => $v)
            {
                $this->data[$k] = $v;
            }
        }
        else
        {
            $this->data[$param] = $val;
        }
    }

    protected function render($view_path = '')
    {
        //save the controller and action names in session
        if ($this->save_previous_url)
        {
            $this->session->set_flashdata('previous_controller_name', $this->previous_controller_name);
            $this->session->set_flashdata('previous_action_name', $this->previous_action_name);
            $this->session->set_flashdata('previous_url', current_url());
        }
        else
        {
            $this->session->set_flashdata('previous_controller_name', $this->controller_name);
            $this->session->set_flashdata('previous_action_name', $this->action_name);
            $this->session->set_flashdata('previous_url', current_url());
        }
        if ($view_path)
        {
            $this->data['content'] .= $this->load->view($view_path, $this->data, true);
        }
        else
        {
            $view_path = $this->controller_name . '/' . $this->action_name . '.php';
            if (file_exists(APPPATH . 'views/' . $view_path))
            {
                $this->data['content'] .= $this->load->view($view_path, $this->data, true);  //load the view
            }
        }

        $this->load->view($this->page_template, $this->data);  //load the template
    }

    protected function save_url()
    {
        $this->save_previous_url = true;
    }

}