<?php

$app->post('/api/MicrosoftComputerVision/getThumbnail', function ($request, $response, $args) {
    $settings =  $this->settings;
    
    $data = $request->getBody();
    $post_data = json_decode($data, true);
    if(!isset($post_data['args'])) {
        $data = $request->getParsedBody();
        $post_data = $data;
    }
    
    $error = [];
    if(empty($post_data['args']['subscriptionKey'])) {
        $error[] = 'subscriptionKey';
    }
    if(empty($post_data['args']['image'])) {
        $error[] = 'image';
    }
    if(empty($post_data['args']['width'])) {
        $error[] = 'width';
    }
    if(empty($post_data['args']['height'])) {
        $error[] = 'height';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = $error;
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $query['width'] = $post_data['args']['width'];
    $query['height'] = $post_data['args']['height'];
    if(!empty($post_data['args']['smartCropping'])) {
        $query['smartCropping'] = $post_data['args']['smartCropping'];
    }
    
    $headers['Ocp-Apim-Subscription-Key'] = $post_data['args']['subscriptionKey'];
    $headers['Content-Type'] = 'application/json';
    if (!empty($post_data['args']['region'])) {
        $settings['api_url'] = "https://" . $post_data['args']['region'] . ".api.cognitive.microsoft.com/vision/v1.0/";
    }
    $query_str = $settings['api_url'] . 'generateThumbnail';
    $body['url'] = $post_data['args']['image'];
    
    $client = $this->httpClient;

    try {

        $resp = $client->post( $query_str, 
            [
                'query' => $query,
                'body' => json_encode($body),
                'headers' => $headers,
                'verify' => false
            ]);
        $responseBody = $resp->getBody()->getContents();
        if(!empty($responseBody)) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = base64_encode($responseBody);
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});
