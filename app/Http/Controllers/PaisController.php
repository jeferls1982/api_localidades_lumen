<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;


class PaisController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $pais;

    public function __construct(Pais $pais)
    {
        $this->pais = $pais;
    }

    /**
     * @OA\Get(
     *     path="/paises",
     *     summary="Lista de paises",    
     *     tags={"paises"},
     *     description="Todos os paises",
     *     @OA\Response(response="default", description="lista de paises ")
     * )
     */
    public function index()
    {
        return $this->pais->with('estados')->get();
    }
    /**
     * @OA\Post(
     *     path="/paises",
     *     summary="Adicionar país",     
     *     tags={"paises"},
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
     *                 ),     *
     *                 example={"nome": "pais","sigla":"ps"}
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
        return $this->pais->create($sanitized);
    }

    /**
     * @OA\Get(
     *     path="/paises/{id}",
     *     summary="buscar pais",    
     *     description="buscar pais",
     *     tags={"paises"},
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
        return $this->pais->with('estados')->find($id);
    }


    /**
     * @OA\Put(
     *     path="/paises/{id}",
     *     summary="Updates um pais",
     *     tags={"paises"},
     *     @OA\Parameter(
     *         description="Update um país",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="pais_id"),
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
     *                 ),     *
     *                 example={"nome": "pais","sigla":"ps"}
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
        $pais = $this->pais->where("id", $id)->update($sanitized);
        $pais = $this->pais->with('estados')->find($id);
        return $pais;
    }


    /**
     * @OA\Delete(
     *     path="/paises/{id}",
     *     summary="Delete país",     
     *     description="Delete país",
     *     tags={"paises"},
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
        $delete = $this->pais->destroy($id);
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
