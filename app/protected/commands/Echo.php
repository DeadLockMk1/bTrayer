<?php
$json = '{
    "errorCode": 0, 
    "errorMessage": "", 
    "itemsList": [
        {
            "errorCode": 0, 
            "errorMessage": "", 
            "host": "localhost", 
            "id": 230287420, 
            "itemObject": [
                {
                    "avgSpeed": 0, 
                    "avgSpeedCounter": 0, 
                    "cDate": {
                        "str": "2014-10-22 17:30:34"
                    }, 
                    "collectedURLs": 1, 
                    "contents": 0, 
                    "description": "", 
                    "errorMask": 524288, 
                    "errors": 1, 
                    "fetchType": 1, 
                    "filters": [
                        {
                            "mode": 0, 
                            "pattern": "^(?:http(?:s)?://)?(?:[^.]+.)?cnn.co.jp/photo/(.*)", 
                            "siteId": "333abec8c863dd0ca69963fb0ab8b97e", 
                            "type": 0                                                                                                                                                                                                                                          
                        },                                                                                                                                                                                                                                                     
                        {                                                                                                                                                                                                                                                      
                            "mode": 0,                                                                                                                                                                                                                                         
                            "pattern": "^(?:http(?:s)?://)?(?:[^.]+.)?cnn.co.jp/(.*)",                                                                                                                                                                                         
                            "siteId": "333abec8c863dd0ca69963fb0ab8b97e",                                                                                                                                                                                                      
                            "type": 1                                                                                                                                                                                                                                          
                        }                                                                                                                                                                                                                                                      
                    ],                                                                                                                                                                                                                                                         
                    "httpTimeout": 30000,                                                                                                                                                                                                                                      
                    "id": "333abec8c863dd0ca69963fb0ab8b97e",                                                                                                                                                                                                                  
                    "iterations": 0,                                                                                                                                                                                                                                           
                    "maxErrors": 100000,                                                                                                                                                                                                                                       
                    "maxResourceSize": 1000000,                                                                                                                                                                                                                                
                    "maxResources": 200,                                                                                                                                                                                                                                       
                    "maxURLs": 200,                                                                                                                                                                                                                                            
                    "maxURLsFromPage": 200,                                                                                                                                                                                                                                    
                    "priority": 0,                                                                                                                                                                                                                                             
                    "processingDelay": 500,                                                                                                                                                                                                                                    
                    "properties": {                                                                                                                                                                                                                                            
                        "AUTO_REMOVE_ORDER": "ContentType ASC, CDate ASC",                                                                                                                                                                                                     
                        "AUTO_REMOVE_RESOURCES": "1",                                                                                                                                                                                                                          
                        "AUTO_REMOVE_WHERE": "ParentMd5<>\"\" AND Status IN (4,7) AND DATE_ADD(UDate, INTERVAL %RecrawlPeriod% MINUTE)<NOW()",                                                                                                                                 
                        "HTTP_COOKIE": "",                                                                                                                                                                                                                                     
                        "HTTP_HEADERS": "",                                                                                                                                                                                                                                    
                        "PROCESS_CTYPES": "text/html",                                                                                                                                                                                                                         
                        "STORE_HTTP_HEADERS": "1",                                                                                                                                                                                                                             
                        "STORE_HTTP_REQUEST": "1",                                                                                                                                                                                                                             
                        "template": "{\"description\":[\"//div[@id=\\\"leaf-body\\\"]\"],\"pubdate\":[\"//div[@id=\\\"leaf_header\\\"]/div[@class=\\\"row\\\"]/p/text()\"],\"media\":[\"//div[@id=\\\"leaf_large_image\\\"]//img | //div[@id=\\\"leaf-media\\\"]/div[@class=\\\"img-caption\\\"]//img[not(@no-padding)]\"],\"title\":[\"//div[@id=\\\"leaf_header\\\"]/div[@class=\\\"row\\\"]/h1/text()\"]}"                                                                                                                                                 
                    },                                                                                                                                                                                                                                                         
                    "recrawlDate": {                                                                                                                                                                                                                                           
                        "str": "2014-10-22 21:30:34"                                                                                                                                                                                                                           
                    },                                                                                                                                                                                                                                                         
                    "recrawlPeriod": 240,                                                                                                                                                                                                                                      
                    "requestDelay": 500,                                                                                                                                                                                                                                       
                    "resources": 1,                                                                                                                                                                                                                                            
                    "size": 0,                                                                                                                                                                                                                                                 
                    "state": 1, 
                    "tcDate": {
                        "str": "2014-10-22 17:30:47"
                    }, 
                    "uDate": {
                        "str": "None"
                    }, 
                    "urlType": 0, 
                    "urls": [
                        "http://www.cnn.co.jp/"
                    ], 
                    "userId": 2
                }
            ], 
            "node": "m011_data", 
            "port": "5530", 
            "time": 123
        }
    ]
}';
Yii::import('');
var_dump(CJSON::decode($json));