<?php
/**
 * Created by PhpStorm.
 * User: urionz
 * Date: 2017/1/6
 * Time: 20:05
 */

namespace App\Repositories;


use Aliyun\Core\DefaultAcsClient;
use Aliyun\Core\Profile\DefaultProfile;
use Green\Request\V20161018 as Green;

class PornCheckRepository
{
    private $accessKeyId;
    private $accessKeySecret;
    private $acsClient;
    private $detectionRequest;
    private $resultRequest;
    private $tasks = [];
    private $result = [];

    const REGINID = 'cn-hangzhou';
    const ENDPOINT = 'cn-hangzhou';
    const PRODUCT = 'Green';
    const DOMAIN = 'green.cn-hangzhou.aliyuncs.com';

    public function __construct($accessKeyId = '', $accessKeySecret = '')
    {
        $this->setAccessKeyId($accessKeyId ? $accessKeyId : env('OSS_ACCESS_ID'));
        $this->setAccessKeySecret($accessKeySecret ? $accessKeyId : env('OSS_ACCESS_KEY'));
        $this->setAcsClient();
    }

    public function setAccessKeyId($accessKeyId)
    {
        $this->accessKeyId = $accessKeyId;
    }

    public function setAccessKeySecret($accessKeySecret)
    {
        $this->accessKeySecret = $accessKeySecret;
        return $this;
    }

    private function setAcsClient()
    {
        $this->acsClient = new DefaultAcsClient($this->getClientProfile());
    }

    private function getClientProfile()
    {
        $client = DefaultProfile::getProfile(static::REGINID, $this->accessKeyId, $this->accessKeySecret);
        DefaultProfile::addEndpoint(static::ENDPOINT, static::REGINID, static::PRODUCT, static::DOMAIN);
        return $client;
    }

    private function setDetectionRequest($async = '', $scene = [])
    {
        $this->detectionRequest = new Green\ImageDetectionRequest();
        !empty($async) && $this->setAsync($async);
        !empty($scene) && $this->setScene($scene);
    }

    private function setResultRequest()
    {
        $this->resultRequest = new Green\ImageResultsRequest();
    }

    public function AsyncImageDetection()
    {
        
    }

    public function AsyncImageDetectionResults()
    {

    }

    public function setAsync($async = "true")
    {
        $this->detectionRequest->setAsync($async);
        return $this;
    }

    public function setScene(array $scene = ['porn'])
    {
        $this->detectionRequest->setScene(json_encode($scene));
        return $this;
    }

    public function addImageDetection(array $images, $async = 'true', $scene = ['porn'])
    {
        if(!empty($async) || !empty($scene)){
            $this->setDetectionRequest($async, $scene);
        }
        $this->detectionRequest->setImageUrl(json_encode($images));
        if($async == 'false'){
            return $this->getUnAsyncResult();
        }
        return $this;
    }

    public function addTask(array $task)
    {
        $this->setResultRequest();
        $this->resultRequest->setTaskId(json_encode($task));
        return $this;
    }

    public function runDetection()
    {
        try{
            $response = $this->acsClient->getAcsResponse($this->detectionRequest);
            if("Success" == $response->Code){
                $imageResults = $response->ImageResults->ImageResult;
                foreach ($imageResults as $imageResult) {
                    $this->tasks[] = $imageResult->TaskId;
                }
            }
        }catch (\Exception $e){
            return $e;
        }
        return $this;
    }

    public function runResult()
    {
        try {
            $getTaskResultsResponse = $this->acsClient->getAcsResponse($this->resultRequest);
            if("Success" == $getTaskResultsResponse->Code){
                $imageDetectResults = $getTaskResultsResponse->ImageDetectResults->ImageDetectResult;

                foreach ($imageDetectResults as $key => $imageDetectResult) {
                    //任务处理完成在做处理
                    if("TaskProcessSuccess" == $imageDetectResult->Status){
                        $imageResult = $imageDetectResult->ImageResult;
                        if(property_exists($imageResult, "PornResult")) {
                            //黄图结果处理
                            $pornResult = $imageResult->PornResult;

                            if($pornResult != null
                                && property_exists($pornResult, "Rate")
                                && property_exists($pornResult, "Label")) {
                                print_r($pornResult);
                                //打印黄图分值,0-100
                                print_r($pornResult->Rate);
                                print_r("\n");
                                //打印参考建议, 0表示正常，1表示色情，2表示需要review
                                print_r($pornResult->Label);
                                print_r("\n");

                            }
                        }

                        if(property_exists($imageResult, "IllegalResult")) {
                            //暴恐渉政结果处理
                            $illegalResult = $imageResult->IllegalResult;
                            if($illegalResult != null
                                && property_exists($illegalResult, "Rate")
                                && property_exists($illegalResult, "Label")) {
                                //打印暴恐渉政分值,0-100
                                print_r($illegalResult->Rate);
                                print_r("\n");
                                //打印参考建议, 0表示正常，1表示暴恐渉政，2表示需要review
                                print_r($illegalResult->Label);
                                print_r("\n");

                            }
                        }

                        if(property_exists($imageResult, "OcrResult")) {
                            //ocr结果处理
                            //打印ocr结果
                            $ocrResult = $imageResult->OcrResult;
                            if($ocrResult != null
                                && property_exists($illegalResult, "Text")) {
                                print_r($ocrResult->Text);
                                print_r("\n");
                            }
                        }



                        if(property_exists($imageResult, "SpamResult")) {
                            //图文反垃圾结果处理
                            $spamResult = $imageResult->SpamResult;
                            if($spamResult != null) {
                                if(property_exists($spamResult, "Text") && $spamResult->Hit){
                                    $keywordResults = $spamResult->KeywordResults->KeywordResult;
                                    foreach ($keywordResults as $keywordResult) {
                                        //打印命中上下文
                                        print_r($keywordResult->KeywordCtx);
                                    }
                                }
                            }
                        }


                        if(property_exists($imageResult, "SensitiveFaceResult")) {
                            //敏感人脸
                            $sensitiveFaceResult = $imageResult->SensitiveFaceResult;
                            if ($sensitiveFaceResult != null) {
                                foreach ($sensitiveFaceResult as $sensitiveFaceResultItem) {
                                    //打印命中上下文
                                    if ($sensitiveFaceResultItem != null
                                        && property_exists($sensitiveFaceResultItem, "Items")
                                        && property_exists($sensitiveFaceResultItem, "SimiInfoList")
                                    ) {
                                        print_r($sensitiveFaceResult->Items);
                                        print_r($sensitiveFaceResult->SimiInfoList);
                                    }

                                }
                            }
                        }
                    }
                }

            }

        } catch (\Exception $e) {
            print_r($e);
        }
        die();
    }

    public function getUnAsyncResult()
    {
        try {
            $response = $this->acsClient->getAcsResponse($this->detectionRequest);
            //返回状态值成功时进行处理
            if("Success" == $response->Code){
                $imageResults = $response->ImageResults->ImageResult;
                foreach ($imageResults as $imageResult) {

                    if(property_exists($imageResult, "PornResult")) {
                        //黄图结果处理
                        $pornResult = $imageResult->PornResult;
                        if($pornResult != null
                            && property_exists($pornResult, "Rate")
                            && property_exists($pornResult, "Label")) {
//                            print_r($pornResult);
//                            //打印黄图分值,0-100
//                            print_r($pornResult->Rate);
//                            print_r("\n");
//                            //打印参考建议, 0表示正常，1表示色情，2表示需要review
//                            print_r($pornResult->Label);
//                            print_r("\n");
                            if($pornResult->Label == 1 || $pornResult->Label == 2) {
                                return true;
                            }else{
                                return false;
                            }
                        }
                    }

                    if(property_exists($imageResult, "IllegalResult")) {
                        //暴恐渉政结果处理
                        $illegalResult = $imageResult->IllegalResult;
                        if($illegalResult != null
                            && property_exists($illegalResult, "Rate")
                            && property_exists($illegalResult, "Label")) {
                            //打印暴恐渉政分值,0-100
                            print_r($illegalResult->Rate);
                            print_r("\n");
                            //打印参考建议, 0表示正常，1表示暴恐渉政，2表示需要review
                            print_r($illegalResult->Label);
                            print_r("\n");

                        }
                    }

                    if(property_exists($imageResult, "OcrResult")) {
                        //ocr结果处理
                        //打印ocr结果
                        $ocrResult = $imageResult->OcrResult;
                        if($ocrResult != null
                            && property_exists($illegalResult, "Text")) {
                            print_r($ocrResult->Text);
                            print_r("\n");
                        }
                    }



                    if(property_exists($imageResult, "SpamResult")) {
                        //图文反垃圾结果处理
                        $spamResult = $imageResult->SpamResult;
                        if($spamResult != null) {
                            if(property_exists($spamResult, "Text") && $spamResult->Hit){
                                $keywordResults = $spamResult->KeywordResults->KeywordResult;
                                foreach ($keywordResults as $keywordResult) {
                                    //打印命中上下文
                                    print_r($keywordResult->KeywordCtx);
                                }
                            }
                        }
                    }


                    if(property_exists($imageResult, "SensitiveFaceResult")) {
                        //敏感人脸
                        $sensitiveFaceResult = $imageResult->SensitiveFaceResult;
                        if ($sensitiveFaceResult != null) {
                            foreach ($sensitiveFaceResult as $sensitiveFaceResultItem) {
                                //打印命中上下文
                                if ($sensitiveFaceResultItem != null
                                    && property_exists($sensitiveFaceResultItem, "Items")
                                    && property_exists($sensitiveFaceResultItem, "SimiInfoList")
                                ) {
                                    print_r($sensitiveFaceResult->Items);
                                    print_r($sensitiveFaceResult->SimiInfoList);
                                }

                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getTasks()
    {
        return $this->tasks;
    }

    public function getResult()
    {
        
    }
}