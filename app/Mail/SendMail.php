<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\EmailTemplate;


class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
        //dd($this->data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $showtemplates = EmailTemplate::where('template_keys',$this->data['template_keys'])->get();

        foreach($showtemplates as $showtemplate){
        $template = htmlspecialchars_decode($showtemplate->email_template_content);
        }

        $template = $this->replace($template,$this->data);

        return $this->from('Eshopper@gmail.com')->subject($showtemplate->email_subject)->view('dynamic_mail_template')->with('template',$template);
    }

    public function replace($template,$data){
            foreach( $data as $key => $value){
            $template = str_replace('{{'.$key.'}}', $value,$template);     
            }
            //dd($template);
            return $template;

    }

}
