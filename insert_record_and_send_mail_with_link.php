<?php
class Send_mail extends CI_Controller
{
    function index()
    {
        $this->load->view('form');
    }
    
    function insert()  //record insert and send a verify link
    {
        $name=$this->input->post("name");
        $email=$this->input->post("email");
        $password=$this->input->post("password");
        $message=$this->input->post("message");
        $qry=$this->Model1->insert_model($name,$email,$password,$message);
        if($qry)
        {
            $to =  $email;  // User email pass here maine form me name from liya hai
    	    $subject = 'Welcome To CodingMantra';
    
    	    $from = 'suman_kumar@theequicom.com';              // Pass here your mail id
    
    	    $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="http://codingmantra.co.in/assets/logo/logo.png" width="300px" vspace=10 /></td></tr>';
    	    $emailContent .='<tr><td style="height:20px"></td></tr>';
    
            $emailContent .="<a href='http://theequicom.com?email=$to' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.theequicom.com</a>";//for verifactin email
    	    $emailContent .= $message;  //   Post message available here
    
    
    	    $emailContent .='<tr><td style="height:20px"></td></tr>';
    	    $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='http://codingmantra.co.in/' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.codingmantra.co.in</a></p></td></tr></table></body></html>";
    	                
    
    
    	    $config['protocol']    = 'ssl';
    	    $config['smtp_host']    = 'theequicom.com';
    	    $config['smtp_port']    = '465';
    	    $config['smtp_timeout'] = '60';
    
    	    $config['smtp_user']    = 'suman_kumar@theequicom.com';    //Important
    	    $config['smtp_pass']    = 'admin!@';  //Important
    
    	    $config['charset']    = 'utf-8';
    	    $config['newline']    = "\r\n";
    	    $config['mailtype'] = 'html'; // or html
    	    $config['validation'] = TRUE; // bool whether to validate email or not 
    
    	     
    
    	    $this->email->initialize($config);
    	    $this->email->set_mailtype("html");
    	    $this->email->from($from);
    	    $this->email->to($to);
    	    $this->email->subject($subject);
    	    $this->email->message($emailContent);
    	    $this->email->attach(base_url('img/one.PNG'));
    	    
    	    if($this->email->send())
    	    {
    	        echo "Send Success";
    	    }
    	    else
    	    {
    	        echo "error";
    	    }
        }
            
    }
    
    function send()  //simply send mail
    {
        $to =  $this->input->post('from');  // User email pass here maine form me name from liya hai
	    $subject = 'Welcome To CodingMantra';

	    $from = 'suman_kumar@theequicom.com';              // Pass here your mail id

	    $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="http://codingmantra.co.in/assets/logo/logo.png" width="300px" vspace=10 /></td></tr>';
	    $emailContent .='<tr><td style="height:20px"></td></tr>';


	    $emailContent .= $this->input->post('message');  //   Post message available here


	    $emailContent .='<tr><td style="height:20px"></td></tr>';
	    $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='http://codingmantra.co.in/' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.codingmantra.co.in</a></p></td></tr></table></body></html>";
	                


	    $config['protocol']    = 'ssl';
	    $config['smtp_host']    = 'theequicom.com';
	    $config['smtp_port']    = '465';
	    $config['smtp_timeout'] = '60';

	    $config['smtp_user']    = 'suman_kumar@theequicom.com';    //Important
	    $config['smtp_pass']    = 'admin!@';  //Important

	    $config['charset']    = 'utf-8';
	    $config['newline']    = "\r\n";
	    $config['mailtype'] = 'html'; // or html
	    $config['validation'] = TRUE; // bool whether to validate email or not 

	     

	    $this->email->initialize($config);
	    $this->email->set_mailtype("html");
	    $this->email->from($from);
	    $this->email->to($to);
	    $this->email->subject($subject);
	    $this->email->message($emailContent);
	    $this->email->attach(base_url('img/one.PNG'));
	    
	    if($this->email->send())
	    {
	        echo "Send Success";
	    }
	    else
	    {
	        echo "error";
	    }

	    //$this->session->set_flashdata('msg',"Mail has been sent successfully");
	    //$this->session->set_flashdata('msg_class','alert-success');
	   // return redirect('Send_mail');
	   echo $this->email->print_debugger();
    }
}

?>