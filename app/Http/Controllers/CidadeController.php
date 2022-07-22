<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;


class CidadeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $cidade;

    public function __construct(Cidade $cidade)
    {
        $this->cidade = $cidade;
    }


    /**
     * @OA\Get(
     *     path="/cidades",
     *     summary="Lista de cidades",    
     *     tags={"cidades"},
     *     description="Todos os cidades",
     *     @OA\Response(response="default", description="lista de cidades ")
     * )
     */
    public function index()
    {
        return $this->cidade->with('estado')->get();
    }


    /**
     * @OA\Post(
     *     path="/cidades",
     *     summary="Adicionar cidade",     
     *     tags={"cidades"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(     *
     *                 @OA\Property(
     *                     property="nome",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="sigla",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="estado_id",
     *                     type="string"
     *                 ),     *
     *                 example={"nome": "pais","sigla":"ps","estado_id":"1"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *
     *     )
     * )
     */
    public function store(Request $request)
    {
        $sanitized = $request->all();
        return $this->cidade->create($sanitized);
    }

    /**
     * @OA\Get(
     *     path="/cidades/{id}",
     *     summary="buscar cidade",    
     *     description="buscar cidade",
     *     tags={"cidades"},
     *     @OA\Parameter(
     *         description="Parameter ",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *     @OA\Response(response="default", description="OK")
     * )
     */
    public function show($id)
    {
        return $this->cidade->with("estado")->find($id);
    }

    /**
     * @OA\Put(
     *     path="/cidades/{id}",
     *     summary="Updates uma cidade",
     *     tags={"cidades"},
     *     @OA\Parameter(
     *         description="Update uma cidade",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="cidade_id"),
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(     *
     *                 @OA\Property(
     *                     property="nome",
     *                     type="string"
     *                 ), 
     *                  @OA\Property(
     *                     property="sigla",
     *                     type="string"
     *                 ), 
     *                 @OA\Property(
     *                     property="estado_id",
     *                     type="string"
     *                 ),     *
     *                 example={"nome": "cidade","sigla":"cd","estado_id":"2"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $sanitized = $request->all();
        $cidade = $this->cidade->where("id", $id)->update($sanitized);
        $cidade = $this->cidade->with("estado")->find($id);
        return $cidade;
    }


    /**
     * @OA\Delete(
     *     path="/cidades/{id}",
     *     summary="Delete cidade",     
     *     description="Delete cidade",
     *     tags={"cidades"},
     *     @OA\Parameter(
     *         description="Parameter ",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *     @OA\Response(response="default", description="OK")
     * )
     */
    public function destroy($id)
    {
        $delete = $this->cidade->destroy($id);
        if ($delete) {
            $string = "Excluido com sucesso";
            $status_code = 200;
        } else {
            $string = "Esse não existe";
            $status_code = 404;
        }
        return response()->json($string, $status_code);
    }
}
