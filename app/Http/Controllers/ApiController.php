<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ApiController extends Controller
{
   use ApiResponser,ValidatesRequests;
}
