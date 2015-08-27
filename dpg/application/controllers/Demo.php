<?php

/**
 * Description of Demo
 *
 * @author majid
 */
class Demo extends CI_Controller {

    //put your code here
    function index() {
//       $this->load->view('dashboard');
       $this->template->load('dashboard', 'isi');
    }

}

?>
