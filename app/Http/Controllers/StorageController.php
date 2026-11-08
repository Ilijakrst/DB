<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storage;

class StorageController extends Controller
{
    /*public function index() {
        $storage = Storage::all();
        //dump($storage);
        //dd($storage->sCount);
        dump($storage);
        foreach($storage as $str){
            dump($str->lsName);
        }
        dd();
    }*/

   /* public function create() { Получается функция в контроллере, которая добавляет объект (запись) в таблицу storage
        Storage::create([
            'IDpc'=> 5,
            'sCount' => 276,
            'lsName' => 'В-ХИМ',
        ]);
        dump('created');
    }*/
    
        /*public function update() {
            $storage = Storage::find(12);
            dump($storage);

            $storage -> update([ // Обновляем оббъект в таблице
                'IDpc'=> 7,
            'sCount' => 777,
            'lsName' => 'Г-ИЗМ',
            ]);
            
        }*/
        

    public function delete(){
        $storage = Storage::find(12);
        dd($storage);
    }

    public function index(){
        $storage = Storage::all();
        return view('storage', compact('storage'));
    }
}
