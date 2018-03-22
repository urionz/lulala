<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
namespace Aliyun\Core\Regions;

class EndpointProvider
{
    private static $endpoints;

    public static function findProductDomain($regionId, $product)
    {
        if (!self::$endpoints) {
            self::init();
        }
        
        if (null == $regionId || null == $product || null == self::$endpoints) {
            return;
        }
        foreach (self::$endpoints as $key => $endpoint) {
            if (in_array($regionId, $endpoint->getRegionIds())) {
                return self::findProductDomainByProduct($endpoint->getProductDomains(), $product);
            }
        }

        return;
    }

    private static function findProductDomainByProduct($productDomains, $product)
    {
        if (null == $productDomains) {
            return;
        }
        foreach ($productDomains as $key => $productDomain) {
            if ($product == $productDomain->getProductName()) {
                return $productDomain->getDomainName();
            }
        }

        return;
    }

    public static function getEndpoints()
    {
        if (!self::$endpoints) {
            self::init();
        }

        return self::$endpoints;
    }

    public static function setEndpoints($endpoints)
    {
        self::$endpoints = $endpoints;
    }

    private static function init()
    {
        $regionIds = array("cn-hangzhou","cn-beijing","cn-qingdao","cn-hongkong","cn-shanghai","us-west-1","cn-shenzhen","ap-southeast-1");
        $productDomains = array(
            new ProductDomain("Ecs", "ecs.aliyuncs.com"),
            new ProductDomain("Rds", "rds.aliyuncs.com"),
            new ProductDomain("BatchCompute", "batchCompute.aliyuncs.com"),
            new ProductDomain("Bss", "bss.aliyuncs.com"),
            new ProductDomain("Oms", "oms.aliyuncs.com"),
            new ProductDomain("Slb", "slb.aliyuncs.com"),
            new ProductDomain("Oss", "oss-cn-hangzhou.aliyuncs.com"),
            new ProductDomain("OssAdmin", "oss-admin.aliyuncs.com"),
            new ProductDomain("Sts", "sts.aliyuncs.com"),
            new ProductDomain("Yundun", "yundun-cn-hangzhou.aliyuncs.com"),
            new ProductDomain("Risk", "risk-cn-hangzhou.aliyuncs.com"),
            new ProductDomain("Drds", "drds.aliyuncs.com"),
            new ProductDomain("M-kvstore", "m-kvstore.aliyuncs.com"),
            new ProductDomain("Ram", "ram2.aliyuncs.com"),
            new ProductDomain("Cms", "metrics.aliyuncs.com"),
            new ProductDomain("Crm", "crm-cn-hangzhou.aliyuncs.com"),
            new ProductDomain("Ocs", "pop-ocs.aliyuncs.com"),
            new ProductDomain("Ots", "ots-pop.aliyuncs.com"),
            new ProductDomain("Dqs", "dqs.aliyuncs.com"),
            new ProductDomain("Location", "location.aliyuncs.com"),
            new ProductDomain("Ubsms", "ubsms.aliyuncs.com"),
            new ProductDomain("Ubsms-inner", "ubsms-inner.aliyuncs.com"),
            );
        $endpoint = new Endpoint("cn-hangzhou", $regionIds, $productDomains);
        $endpoints = array($endpoint);
        EndpointProvider::setEndpoints($endpoints);
    }
}
