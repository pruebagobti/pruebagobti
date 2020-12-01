<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use SimpleSoftwareIO\QrCode\Facades\QrCode;//Libreria de QR
use App\Producto;//BD 

class QRController extends Controller
{
    public function CrearQrPng()
    {
        QrCode::format('png')->size(200)->generate('http://localhost:8888/laravel58/public/ListaProductosQR',
                                        '../public/qrcodes/qrproducto.png');
    }

    public function qrproducto()
    {
        return view('qr.qrproducto');
    }

    public function DescargarQrPng()
    {
        $pathtoFile = public_path().'/qrcodes/qrproducto.png';
        return response()->download($pathtoFile);
    }

    public function ListaProductosQR()
    {
        $consultaProductoCt = Producto::ProductoCt();
        return view('qr.ListaProductosQR',compact('consultaProductoCt'));
    }

}
