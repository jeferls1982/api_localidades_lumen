<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;


class EstadoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $estado;

    public function __construct(Estado $estado)
    {
        $this->estado = $estado;
    }


    /**
     * @OA\Get(
     *     path="/estados",
     *     summary="Lista de estados",    
     *     tags={"estados"},
     *     description="Todos os estados",
     *     @OA\Response(response="default", description="lista de estados ")
     * )
     */
    public function index()
    {
        return $this->estado->with('pais', 'cidades')->get();
    }


    /**
     * @OA\Post(
     *     path="/estados",
     *     summary="Adicionar estado",     
     *     tags={"estados"},
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
     *                     property="pais_id",
     *                     type="string"
     *                 ),     *
     *                 example={"nome":"estado","sigla":"es","pais_id":"1"}
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
        return $this->estado->create($sanitized);
    }

    /**
     * @OA\Get(
     *     path="/estados/{id}",
     *     summary="buscar estado",    
     *     description="buscar estado",
     *     tags={"estados"},
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
        return $this->estado->with("pais", "cidades")->find($id);
    }


    /**
     * @OA\Put(
     *     path="/estados/{id}",
     *     summary="Updates um estado",
     *     tags={"estados"},
     *     @OA\Parameter(
     *         description="Update um estado",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="estado_id"),
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
     *                   @OA\Property(
     *                     property="pais_id",
     *                     type="string"
     *                 ),     *
     *                 example={"nome": "pais","sigla":"ps", "pais_id":"1"}
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
        $estado = $this->estado->where("id", $id)->update($sanitized);
        $estado = $this->estado->with("pais", "cidades")->find($id);
        return $estado;
    }


    /**
     * @OA\Delete(
     *     path="/estados/{id}",
     *     summary="Delete estado",     
     *     description="Delete estado",
     *     tags={"estados"},
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
        $delete = $this->estado->destroy($id);
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
