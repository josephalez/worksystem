<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class Impresion extends Controller
{
    public function Imprimir()
    {
      $pdf = PDF::loadView('vista', $data);
      return $pdf->download('cosa.pdf');
    }
}
