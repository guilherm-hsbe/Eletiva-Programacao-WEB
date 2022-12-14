<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatosManagerController extends Controller
{

    public function index()
    {
        $contatos = Contato::latest()->paginate(5);
        return view('contatosmanager.index',compact('contatos'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function show($id)
    {
        $contato = Contato::findOrFail($id);

        $contato->status=true;
        $contato->save();

        return view('contatosmanager.show',compact('contato'));
    }


    public function destroy($id)
    {
        Contato::findOrFail($id)->delete();
        return redirect()->route('contatosmanager.index')->with('success','Mensagem excluida com sucesso!');
    }
}
