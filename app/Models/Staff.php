<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    //The $fillable property is an array containing fields of table/entity which can be filled using mass-assignment. Mass assignment refers sending an array to the model to directly create a new record in the database

    protected $fillable = ['name', 'email', 'contact', 'salary', 'address', 'image', 'nid', 'join_date'];
}
