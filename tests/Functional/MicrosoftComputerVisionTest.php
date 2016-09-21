<?php

namespace Tests\Functional;

class MicrosoftComputerVisionTest extends BaseTestCase
{
    protected $api_key = '57e9164516844d99ae455a9953aca0c2';
    
    public function testAnalyzeImage() {
        
        $post_data['args']['subscriptionKey'] = $this->api_key;
        $post_data['args']['image'] = 'http://cache.lovethispic.com/uploaded_images/blogs/Farmer-Sprays-Poop-All-Over-Protestors-Trespassing-On-His-Land-10417-1.png';
        
        $response = $this->runApp('POST', '/api/MicrosoftComputerVision/analyzeImage', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testDescribeImage() {
        
        $post_data['args']['subscriptionKey'] = $this->api_key;
        $post_data['args']['image'] = 'http://cache.lovethispic.com/uploaded_images/blogs/Farmer-Sprays-Poop-All-Over-Protestors-Trespassing-On-His-Land-10417-1.png';
        
        $response = $this->runApp('POST', '/api/MicrosoftComputerVision/describeImage', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testGetThumbnail() {
        
        $post_data['args']['subscriptionKey'] = $this->api_key;
        $post_data['args']['image'] = 'http://cache.lovethispic.com/uploaded_images/blogs/Farmer-Sprays-Poop-All-Over-Protestors-Trespassing-On-His-Land-10417-1.png';
        $post_data['args']['width'] = 100;
        $post_data['args']['height'] = 100;
        
        $response = $this->runApp('POST', '/api/MicrosoftComputerVision/getThumbnail', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testOcr() {
        
        $post_data['args']['subscriptionKey'] = $this->api_key;
        $post_data['args']['image'] = 'http://cache.lovethispic.com/uploaded_images/blogs/Farmer-Sprays-Poop-All-Over-Protestors-Trespassing-On-His-Land-10417-1.png';
        
        $response = $this->runApp('POST', '/api/MicrosoftComputerVision/ocr', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testTagImage() {
        
        $post_data['args']['subscriptionKey'] = $this->api_key;
        $post_data['args']['image'] = 'http://cache.lovethispic.com/uploaded_images/blogs/Farmer-Sprays-Poop-All-Over-Protestors-Trespassing-On-His-Land-10417-1.png';
        
        $response = $this->runApp('POST', '/api/MicrosoftComputerVision/tagImage', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }

}