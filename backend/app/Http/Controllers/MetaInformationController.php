<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Exception;
use App\Traits\ApiResponserTrait;
use App\Services\MetaInformationService;

class MetaInformationController extends Controller
{

    use ApiResponserTrait;
    private $metaInformationService;

    public function __construct(MetaInformationService $metaInformationService)
    {
        $this->metaInformationService = $metaInformationService;
    }

    public function index(Request $request)
    {
        try{
            $response = $this->metaInformationService->getMetaInformation();
            return $this->singleModelResponse($response);
        }
        catch(Exception $e){
            return $this->errorResponse($e);
        }
    }

}
