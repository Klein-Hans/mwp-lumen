<?php 
namespace App\Http\Controllers;

use App\Mail\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      //
  }

  public function sendEmail(Request $request)
  {
    // var_dump($request->input('email'));
    // var_dump($request->input('subject'));
    // var_dump($request->input('message'));
    // exit;
    $subject = "Inquiry on Project: " . $request->input('project');

    Mail::send(
      new Inquiry(
        $request->input('email_address'),   
        $request->input('name'),      
        $subject,
        $request->input('phone_number'),
        $request->input('message')
      )
    );
    
    return $this->responseOk('Your Email has been sent');
  }
}
