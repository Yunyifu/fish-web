define({
  "name": "渔鱼网 API文档",
  "version": "0.1.0",
  "description": "Yii2 API Service",
  "url": "/v1",
  "title": "渔鱼网项目API文档",
  "header": {
    "title": "General",
    "content": "<hr>\n<p>API调用地址前缀：http://116.62.225.255:8088/<br />\n一律采用JSON格式输入、输出。<br />\n接口调用，需传递以下额外头：<br /></p>\n<pre><code>JOKE: yifu!\nDevice: deviceunique （设备唯一名称，用于标示当前访问设备）\nAuthorization: access_token（登陆后，会返回，需要前端存储，后续调用接口都带上此参数）\nAccept: application/json\n</code></pre>\n<p>根据api_code属性判断是否成功<br />\n成功，api_code 200，余下属性参考各个具体接口<br />\n范例<br /></p>\n<pre><code>{\n\t&quot;api_code&quot;: 200,\n\t&quot;id&quot;: &quot;3&quot;\n}\n</code></pre>\n<p>失败，api_code != 200，并且带api_msg属性：<br /></p>\n<pre><code>属性     解释\t备注\napi_msg\t错误说明 必有\n</code></pre>\n<p>范例<br /></p>\n<pre><code>{\n\t&quot;api_code&quot;: 401,\n\t&quot;api_msg&quot;: &quot;昵称已存在&quot;\n}\n</code></pre>\n"
  },
  "sampleUrl": false,
  "defaultVersion": "0.0.0",
  "apidoc": "0.3.0",
  "generator": {
    "name": "apidoc",
    "time": "2017-07-19T07:12:51.060Z",
    "url": "http://apidocjs.com",
    "version": "0.17.6"
  }
});
