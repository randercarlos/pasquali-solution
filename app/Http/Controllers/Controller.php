<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 *
 * @OA\OpenApi(
 *   @OA\Server(
 *      url="http://localhost:8000/api/v1",
 *      description="Desenvolvimento(localhost)"
 *   ),
 *   @OA\Server(
 *      url="https://api.testandoapi.click/api/v1",
 *      description="Produção"
 *   ),
 * )
 *
 * @OA\Info(
 *     title="Pasquali Solution - Gerenciamento de Colaboradores - Referência da API",
 *     version="1.0.0",
 *     description="Documentação dos endpoint disponíveis na API Restful",
 *     @OA\Contact(
 *         email="randerccf@gmail.com"
 *     )
 * )
 *
 * @OA\Schemes({"http", "https"})
 *
¨*  @OA\SecurityScheme(
 *       type="http",
 *       name="Authorization",
 *       description="Token de acesso JWT retornado após feito o login. Example: 'Authorization: Bearer {token}'",
 *       in="header",
 *       scheme="bearer",
 *       bearerFormat="JWT",
 *       securityScheme="Authorization Header",
 *   )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
