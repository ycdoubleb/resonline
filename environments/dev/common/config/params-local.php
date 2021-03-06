<?php

return [
    /* 阿里云OSS配置 */
    'aliyun' => [
        'accessKeyId' => 'LTAIM0fcBM6L6mTa',
        'accessKeySecret' => '2fSyGRwesxyP4X2flUF35n7brgxlEf',
        'oss' => [
            'bucket-input' => 'resonline',
            'bucket-output' => 'resonline',
            'host-input' => 'resonline.oss-cn-shenzhen.aliyuncs.com',
            'host-output' => 'resonline.oss-cn-shenzhen.aliyuncs.com',
            'host-input-internal' => 'resonline.oss-cn-shenzhen.aliyuncs.com',  //测试情况下用外网
            'host-output-internal' => 'resonline.oss-cn-shenzhen.aliyuncs.com', //测试情况下用外网
            'endPoint' => 'oss-cn-shenzhen.aliyuncs.com',
            'endPoint-internal' => 'oss-cn-shenzhen.aliyuncs.com',              //测试情况下用外网
        ],
        'mts' => [
            'region_id' => 'cn-shenzhen', //区域
            'pipeline_id' => '3fc6537fb68c466fa13d28fdbf9f56b5', //管道ID
            'pipeline_name' => 'mts-service-pipeline', //管道名称
            'oss_location' => 'oss-cn-shenzhen', //作业输入，华南1
            'template_id_ld' => '455d949ceaca408e9796f7380e187e7c', //流畅模板ID
            'template_id_sd' => 'ccef60ef5d4a494cafc74f75dbb9ea69', //标清模板ID
            'template_id_hd' => '7e26999284504195b36c4ad3577b998a', //高清模板ID
            'template_id_fd' => 'bc3c3af57ad74b4081970b8f45bdd86e', //超畅模板ID
            'water_mark_template_id' => '0edc51da2aa14cd19f480c44e9ece7cb', //水印模板ID 默认右上
        ]
    ],
];
