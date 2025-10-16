<?php

namespace App\Services;

use Aws\ApiGateway\ApiGatewayClient;
use Carbon\Carbon;
use App\Http\Requests;
class AwsApiGatewayService
{
    protected $client;
    protected $usagePlanId;

    public function __construct()
    {
        $config = config('services.aws_apigateway');

        $this->client = new ApiGatewayClient([
            'version' => 'latest',
            'region'  => $config['region'],
            'credentials' => [
                'key'    => $config['access_key'],
                'secret' => $config['secret_key'],
            ],
        ]);

        $this->usagePlanId = $config['usage_plan_id'];
    }

    public function createApiKeyForBasicPlan($keyName, $expiryDate = null)
    {
        if (!$keyName) {
            throw new \Exception("Key Name is required.");
        }

        $params = [
            'name' => $keyName,
            'enabled' => true,
        ];

        // Optional expiry
        if ($expiryDate) {
            $carbonDate = Carbon::createFromFormat('d/m/Y', $expiryDate)->endOfDay();
            $params['expireTime'] = $carbonDate->timestamp * 1000;
        }

        // Create API Key
        $apiKey = $this->client->createApiKey($params);

        // Attach API Key to Basic plan
        $this->client->createUsagePlanKey([
            'keyId' => $apiKey['id'],
            'keyType' => 'API_KEY',
            'usagePlanId' => $this->usagePlanId,
        ]);

        return [
                'value' => $apiKey['value'],
                'id'    => $apiKey['id']
            ]; // return the actual key string
    }
    public function deleteApiKey($apiKeyId)
    {
        try {
        //$this->client->getApiKey(['apiKey' => $apiKeyId]); // Check existence
        $this->client->deleteApiKey(['apiKey' => $apiKeyId]);
        return true;
        } catch (\Aws\ApiGateway\Exception\ApiGatewayException $e) {
            if (strpos($e->getMessage(), 'Not Found') !== false) {
                \Log::warning("AWS API Key not found: " . $apiKeyId);
            }
            throw $e;
        }
        /*$this->client->deleteApiKey([
            'apiKey' => $apiKeyId
        ]);

        return true;*/
    }
}
