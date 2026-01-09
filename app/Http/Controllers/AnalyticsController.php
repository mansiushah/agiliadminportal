<?php

namespace App\Http\Controllers;

use Aws\ApiGateway\ApiGatewayClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\{Category,Offers,OfferImages,OfferStartOptions,Organisation,OfferAnalytics,TimeZoneName,Intrests,Promocode,OfferInterests,Payments};
use App\Services\OfferImageService;
use App\Services\ImageModerationService;
use Stripe\Stripe;
use Stripe\Price;
use Stripe\Tax\Calculation;
use Stripe\Checkout\Session;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AnalyticsController extends Controller
{
    use ApiResponser;

    public function index()
    {
        return view('analytics.index');
    }
     // 🔹 Chart Data (used by AJAX)
    public function getChartData(Request $request)
    {
        return response()->json([
            'chartData' => $this->generateChartData($request),
        ]);
    }

    // 🔹 Export CSV
    public function exportCSV(Request $request)
    {
        $chartData = $this->generateChartData($request);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="analytics_export.csv"',
        ];

        $callback = function () use ($chartData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Age Group', 'Men', 'Women', 'Non-binary']);

            $ageGroups = ['13-17', '18-24', '25-34', '35-44', '45-54', '55-64', '65+'];

            foreach ($ageGroups as $index => $group) {
                fputcsv($handle, [
                    $group,
                    $chartData['Men'][$index] ?? 0,
                    $chartData['Women'][$index] ?? 0,
                    $chartData['Non-binary'][$index] ?? 0,
                ]);
            }

            fclose($handle);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    // 🔹 Export PDF
    public function exportPDF(Request $request)
    {
        $chartData = $this->generateChartData($request);
        $ageGroups = ['13-17', '18-24', '25-34', '35-44', '45-54', '55-64', '65+'];

        $pdf = \PDF::loadView('exports.analytics_pdf', compact('chartData', 'ageGroups'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('analytics_export.pdf');
    }

    // 🔹 Shared Function (used by all three methods)
    private function generateChartData(Request $request)
    {
        $metric = $request->input('metric', 'views');
        $timeRange = $request->input('time', '24h');
        $offerId = $request->input('offer_id');

        $ageGroups = [
            '13-17' => [13, 17],
            '18-24' => [18, 24],
            '25-34' => [25, 34],
            '35-44' => [35, 44],
            '45-54' => [45, 54],
            '55-64' => [55, 64],
            '65+'   => [65, 200],
        ];

        $queryTime = match ($timeRange) {
            '24h' => Carbon::now()->subHours(24),
            '7d'  => Carbon::now()->subDays(7),
            '30d' => Carbon::now()->subDays(30),
            default => Carbon::now()->subYears(10),
        };

        $eventType = $metric === 'clicks' ? 'C' : 'V';

        $query = OfferAnalytics::where('event_type', $eventType)
            ->where('recorded_at', '>=', $queryTime);

        if ($offerId) {
            $query->where('offer_id', $offerId);
        }

        $analytics = $query->get();

        $chartData = [
            'Men' => [],
            'Women' => [],
            'Non-binary' => [],
        ];

        foreach ($ageGroups as $label => [$min, $max]) {
            $chartData['Men'][] = $analytics->whereBetween('visitor_age', [$min, $max])->where('visitor_gender', 'M')->count();
            $chartData['Women'][] = $analytics->whereBetween('visitor_age', [$min, $max])->where('visitor_gender', 'W')->count();
            $chartData['Non-binary'][] = $analytics->whereBetween('visitor_age', [$min, $max])->where('visitor_gender', 'N')->count();
        }

        return $chartData;
    }

}
