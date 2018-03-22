<?php

namespace App\Http\Controllers;

use Aliyun\Core\DefaultAcsClient;
use Aliyun\Core\Profile\DefaultProfile;
use Illuminate\Http\Request;
use Storage;
use Green\Request\V20161018 as Green;

class TestController extends Controller
{
    public function put()
    {
        $disk = Storage::disk('oss');

        $contents = Storage::disk('public')->get('file.jpg');

//        $exists   = Storage::exists('/file.jpg');
//        $size     = Storage::size('/file1.jpg');
//        $time     = Storage::lastModified('file1.jpg');


        dd(Storage::put('file.jpg', $contents));
    }

    public function get()
    {
//        header('Content-Type:image/png');
//        $contents = Storage::get('file.jpg');
//        echo '<img src="'.$contents.'" />';
//        dd($contents);'
        echo ossGet('file.jpg', '');
    }

    public function AsyncImageDetection()
    {
        $ak['accessKeyId'] = env('OSS_ACCESS_ID');
        $ak['accessKeySecret'] = env('OSS_ACCESS_KEY');

        $iClientProfile = DefaultProfile::getProfile('cn-hangzhou', $ak['accessKeyId'], $ak['accessKeySecret']);
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", "Green", "green.cn-hangzhou.aliyuncs.com");

        $client = new DefaultAcsClient($iClientProfile);
        $getTaskResultsRequest = new Green\ImageResultsRequest();

        $getTaskResultsRequest->setTaskId(json_encode(array("4e746b8e-3920-4ecc-b8f4-a0d8aef122d5-1484647008147", "98402837-e926-4883-b7da-0ebba9216b58-1484647008147")));
        try {
            $getTaskResultsResponse = $client->getAcsResponse($getTaskResultsRequest);
            print_r($getTaskResultsResponse);

            if("Success" == $getTaskResultsResponse->Code){
                $imageDetectResults = $getTaskResultsResponse->ImageDetectResults->ImageDetectResult;

                foreach ($imageDetectResults as $imageDetectResult) {
                    //任务处理完成在做处理
                    if("TaskProcessSuccess" == $imageDetectResult->Status){
                        $imageResult = $imageDetectResult->ImageResult;

                        print_r($imageResult);

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
    }

    public function testCors(Request $request)
    {
        $corsurl = $request->get('imageurl');
        $content = file_get_contents($corsurl);
        header('Content-Type:image/png');
        echo $content;
    }
}
