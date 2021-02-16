<?php

namespace App\Http\Controllers\Api;

use App\API\Apierror;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produto;
use Exception;

class ProdutoController extends Controller
{
    private $produto;
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }


   public function index(){

        $dados = ['data'=> $this->produto->paginate(5)];
        return response()->json($dados);
   }

   public function show($id){
       $produto = $this->produto->find($id);
       if ( ! $produto ){
           return response()->json(['msg'=>'Esse registro não existe na base de dados',404]);
       }

       $dados = ['data'=> $produto];
       return response()->json($dados);
   }

   public function store(Request $req){
       try{
            $inserir = $req->all();
            $this->produto->create($inserir);

            return response()->json(['msg'=> 'O registro foi salvo com sucesso!'],200);

       }
       catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(Apierror::errorMassage($e->getMessage(),1011));
            }
            return response()->json(Apierror::errorMassage('Houve um erro ao realizar a operação',1011),500);
       }
       
   }

   public function update(Request $req, $id){
    try{
         $inserir = $req->all();
         $this->produto->find($id)->update($inserir);

         return response()->json(['msg'=> 'O registro foi atualizado com sucesso!'],200);

    }
    catch(\Exception $e){
         if(config('app.debug')){
             return response()->json(Apierror::errorMassage($e->getMessage(),1011),500);
         }
         return response()->json(Apierror::errorMassage('Houve um erro ao realizar a operação de atualização',1011),500);
    }
    
    } 
    public function delete(Produto $id){
        try{
           $id->delete();
   
            return response()->json(['msg'=> 'O registro foi excluido com sucesso!'],200);
   
       }
       catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(Apierror::errorMassage($e->getMessage(),1011),500);
            }
            return response()->json(Apierror::errorMassage('Houve um erro ao realizar a operação de remoção',1011),500);
       }
    }      
}
