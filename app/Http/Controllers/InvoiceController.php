<?php

namespace App\Http\Controllers;

use Aws\ApiGateway\ApiGatewayClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\{Category,Offers,OfferImages,OfferStartOptions,Organisation,OrganisationTaxRegistrations,TimeZoneName,Intrests,Promocode,OfferInterests,Payments};
use App\Services\OfferImageService;
use App\Services\ImageModerationService;
use Stripe\Stripe;
use Stripe\Price;
use Stripe\Tax\Calculation;
use Stripe\Checkout\Session;
class InvoiceController extends Controller
{
    use ApiResponser;

    public function index()
    {
        return view('invoice.index');
    }
    public function view()
    {
        return view('invoice.view');
    }

}
