<?php

class ResourceDownload
{
    protected $response;

    public function download($options)
    {
        $userId = Yii::app()->user->id;
        $request = Yii::app()->request;
        $json[] = array(
            'contentTypeMask' => $this->getMask($options),
            'siteId' => $options['siteId'],
            'url' => $options['url'],
            'urlFetch' => null,
            'urlMd5' => $options['urlMd5'],
        );
        $json = CJSON::encode($json);
        $path = Yii::app()->getBasePath() . '/json_temp/';
        $file = fopen($path . $userId . '_request_content.json', 'w');
        fwrite($file, $json);
        $api = Yii::app()->params['api'];
        $path = Yii::app()->getBasePath() . '/shell/';
        $pathFile = Yii::app()->getBasePath() . '/json_temp/' . $userId . '_request_content.json';
        $cmd = "sh " . $path . "url_content.sh $api $pathFile";
        $json = shell_exec($cmd);
        $path = Yii::app()->getBasePath() . '/json_temp/';
        $file = fopen($path . $userId . '_response_content.json', 'w+');
        fwrite($file, $json);
        fclose($file);
        $response = file_get_contents($path . $userId . '_response_content.json');
        $this->response = CJSON::decode($response);
        $contentsArray = $this->createContents();
        $this->createFiles($options['urlMd5'], $contentsArray['contents'], $contentsArray['prefix']);
    }

    public function getMask($options)
    {
        $mask = '000000000000000';
        for ($i = 0; $i <= 10; $i++) {
            if (isset($options[$i])) {
                $mask[$i] = '1';
            }
        }
        $crawled = $options['crawled'];
        $mask[$crawled] = '1';
        $mask = strrev($mask);
        return bindec($mask);
    }

    public function createContents() {
        $contents = array();
        $prefix = array();
        $itemObject = $this->response['itemsList'][0]['itemObject'][0];
        if ($this->isSetContent('rawContents')) {
            foreach ($itemObject['rawContents'] as $k => $v) {
                if ($v['fieldId'] == 0) {
                    $contents['raw'][$k] = base64_decode($v['buffer']);
                    $prefix['raw'][$k] = date('YmdHis.', strtotime($v['cDate']));
                } elseif ($v['fieldId'] == 1) {
                    $contents['tidy'][$k] = base64_decode($v['buffer']);
                    $prefix['tidy'][$k] = date('YmdHis.', strtotime($v['cDate']));
                } elseif ($v['fieldId'] == 9) {
                    $contents['dynamic'][$k] = base64_decode($v['buffer']);
                    $prefix['dynamic'][$k] = date('YmdHis.', strtotime($v['cDate']));
                }
            }
        }
        if ($this->isSetContent('processedContents')) {
            foreach ($itemObject['processedContents'] as $k => $v) {
                $contents['pro'][$k] = base64_decode($v['buffer']);
                $prefix['pro'][$k] = date('YmdHis.', strtotime($v['cDate']));
            }
        }
        if ($this->isSetContent('requests')) {
            foreach ($itemObject['requests'] as $k => $v) {
                $contents['requests'][$k] = base64_decode($v['buffer']);
                $prefix['requests'][$k] = date('YmdHis.', strtotime($v['cDate']));
            }
        }
        if ($this->isSetContent('headers')) {
            foreach ($itemObject['headers'] as $k => $v) {
                $contents['headers'][$k] = base64_decode($v['buffer']);
                $prefix['headers'][$k] = date('YmdHis.', strtotime($v['cDate']));
            }
        }
        if ($this->isSetContent('cookies')) {
            foreach ($itemObject['cookies'] as $k => $v) {
                $contents['cookies'][$k] = base64_decode($v['buffer']);
                $prefix['cookies'][$k] = date('YmdHis.', strtotime($v['cDate']));
            }
        }
        if ($this->isSetContent('meta')) {
            foreach ($itemObject['meta'] as $k => $v) {
                $contents['meta'][$k] = base64_decode($v['buffer']);
                $prefix['meta'][$k] = date('YmdHis.', strtotime($v['cDate']));
            }
        }
        return array(
            'contents' => $contents,
            'prefix' => $prefix
        );
    }

    public function createFiles($dirname, $contents = array(), $prefix = array())
    {
        $dir = Yii::app()->runtimePath.DIRECTORY_SEPARATOR.$dirname;
        if (is_dir($dir)) {
            $this->delTree($dir);
        }
        if(mkdir($dir)) {
            if (isset($contents['raw'])) {
                foreach ($contents['raw'] as $k => $v) {
                    $raw = fopen($dir . DIRECTORY_SEPARATOR . $prefix['raw'][$k] . 'raw.bin', 'w');
                    fwrite($raw, $v);
                    fclose($raw);
                }
            }
            if (isset($contents['tidy'])) {
                foreach ($contents['tidy'] as $k => $v) {
                    $rawTidy = fopen($dir . DIRECTORY_SEPARATOR . $prefix['tidy'][$k] . 'raw.bin.tidy', 'w');
                    fwrite($rawTidy, $v);
                    fclose($rawTidy);
                }
            }

            if (isset($contents['pro'])) {
                foreach ($contents['pro'] as $k => $v) {
                    $pro = fopen($dir . DIRECTORY_SEPARATOR . $prefix['pro'][$k] . 'processed', 'w');
                    fwrite($pro, $v);
                    fclose($pro);
                }
            }

            if (isset($contents['requests'])) {
                foreach ($contents['requests'] as $k => $v) {
                    $requests = fopen($dir . DIRECTORY_SEPARATOR . $prefix['requests'][$k] . 'requests', 'w');
                    fwrite($requests, $v);
                    fclose($requests);
                }
            }

            if (isset($contents['headers'])) {
                foreach ($contents['headers'] as $k => $v) {
                    $headers = fopen($dir . DIRECTORY_SEPARATOR . $prefix['headers'][$k] . 'headers', 'w');
                    fwrite($headers, $v);
                    fclose($headers);
                }
            }

            if (isset($contents['cookies'])) {
                foreach ($contents['cookies'] as $k => $v) {
                    $cookies = fopen($dir . DIRECTORY_SEPARATOR . $prefix['cookies'][$k] . 'cookies', 'w');
                    fwrite($cookies, $v);
                    fclose($cookies);
                }
            }

            if (isset($contents['meta'])) {
                foreach ($contents['meta'] as $k => $v) {
                    $meta = fopen($dir . DIRECTORY_SEPARATOR . $prefix['meta'][$k] . 'meta', 'w');
                    fwrite($meta, $v);
                    fclose($meta);
                }
            }

            if (isset($contents['dynamic'])) {
                foreach ($contents['dynamic'] as $k => $v) {
                    $dynamic = fopen($dir . DIRECTORY_SEPARATOR . $prefix['dynamic'][$k] . 'dynamic', 'w');
                    fwrite($dynamic, $v);
                    fclose($dynamic);
                }
            }
            chdir($dir);
            $zip = new ZipArchive();
            $filename = $dir . DIRECTORY_SEPARATOR . $dirname . '.zip';
            $zip->open($filename, ZipArchive::OVERWRITE);
            $zip->addGlob('*.*');
            $zip->close();
            Yii::app()->request->sendFile(basename($filename), file_get_contents($filename));
            unset($zip);
        }
        chdir(Yii::app()->runtimePath);
        if (is_dir($dir)) {
            $this->delTree($dir);
        }
    }

    public function isSetContent($type)
    {
        if (empty($this->response['itemsList'][0]['itemObject'])) {
            return false;
        } elseif (empty($this->response['itemsList'][0]['itemObject'][0][$type][0])) {
            return false;
        }
    return true;
    }

    public function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}