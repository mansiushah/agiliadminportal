<?php

namespace App\Http\Controllers;

use Aws\ApiGateway\ApiGatewayClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\{ApiKey};
use App\Services\AwsApiGatewayService;

class ApiGatewayController extends Controller
{
    use ApiResponser;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userId = auth()->guard('admin')->id();
            $this->environment = auth()->guard('admin')->user()->environment;
            return $next($request);
        });
    }
    public function index()
    {
        $id = $this->userId;
        $data = ApiKey::with(['user.organisation'])->where('environment',$this->environment)->get();
        return view('apikey.index', compact('data'));
    }
    public function DeleteApikey($id, AwsApiGatewayService $awsService)
    {
        $apikey = ApiKey::where('id',$id)->first();
        $awsService->deleteApiKey($apikey->aws_key_id);
        $apikey->delete();
        return redirect()->route('api-keys')->with('success',  __('messages.deleteApiKey'));
    }
}
