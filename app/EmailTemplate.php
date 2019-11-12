<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
	protected $table = 'email_template';

	protected $primaryKey = 'id';


	protected $fillable = ['template_keys','email_template_name','email_template_content','email_subject','status'];

	
}
