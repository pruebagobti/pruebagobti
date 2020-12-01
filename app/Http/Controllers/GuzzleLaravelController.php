<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GuzzleLaravelController extends Controller
{
    public function IndexGL()
    {
        //Para prueba nos conectaresmos al servidor https://jsonplaceholder.typicode.com
        //Creamos un cliente al que nos vamos a conetar 
        $client = new Client([

            // URL al servidor que nos vamos a conectar
            'base_uri' => 'https://jsonplaceholder.typicode.com',

            // Tiempo de espera para conectar 
            'timeout'  => 2.0,

        ]);

        // Se crea el siguiente URL https://jsonplaceholder.typicode.com/posts
        $response = $client->request('GET', 'posts'); 
        
        //getBody() para ver el cuerpo de la peticion
        //getContents() para ver el contenido de la peticion
        //dd($response->getBody()->getContents());
        //return json_decode($response->getBody()->getContents());

        //Creamos una variable que tendra el valor en formato json de la petecion response 
        $consultaJsonCt = json_decode($response->getBody()->getContents());

        return view('guzzlelaravel.IndexGL',compact('consultaJsonCt'));

    }

    public function showGL($id)
    {
        //Creamos un cliente
        $client = new Client([
            'base_uri' => 'https://jsonplaceholder.typicode.com'
        ]);
        
        // Se crea el siguiente URL https://jsonplaceholder.typicode.com/posts/$id
        $response = $client->request('GET', "posts/{$id}");

        $consultaJsonCn = json_decode($response->getBody()->getContents());
        
        return view('guzzlelaravel.showGL',compact('consultaJsonCn'));

    }


}
    
