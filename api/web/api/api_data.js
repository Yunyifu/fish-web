define({ "api": [
  {
    "type": "get",
    "url": "/category/firstcate",
    "title": "获取一级分类",
    "version": "0.1.0",
    "group": "Category",
    "success": {
      "examples": [
        {
          "title": "例子：",
          "content": "\n{\n        \"data\": [\n            {\n                \"id\": 1,\n                \"name\": \"鱼类\",\n                \"status\": 1,\n                \"parent_id\": null,\n                \"created_at\": null,\n                \"updated_at\": null\n            },\n            {\n                \"id\": 2,\n                \"name\": \"贝类\",\n                \"status\": 1,\n                \"parent_id\": null,\n                \"created_at\": null,\n                \"updated_at\": null\n            }\n            ],\n         \"api_code\": 200\n         }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/CategoryController.php",
    "groupTitle": "Category",
    "name": "GetCategoryFirstcate"
  },
  {
    "type": "get",
    "url": "/category/secondall",
    "title": "获取所有二级分类（6-13新需求）",
    "version": "0.1.0",
    "group": "Category",
    "success": {
      "examples": [
        {
          "title": "例子：",
          "content": "\n{\n        {\n            \"id\": 4,\n            \"name\": \"罗非鱼\",\n            \"status\": 1,\n            \"parent_id\": 1,\n            \"created_at\": null,\n            \"updated_at\": null\n        }\n        ],\n        \"api_code\": 200\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/CategoryController.php",
    "groupTitle": "Category",
    "name": "GetCategorySecondall"
  },
  {
    "type": "get",
    "url": "/category/secondcate",
    "title": "获取二级分类",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "cateId",
            "description": "<p>分类id</p>"
          }
        ]
      }
    },
    "group": "Category",
    "success": {
      "examples": [
        {
          "title": "例子：",
          "content": "\n{\n\"data\": [\n    {\n        \"id\": 3,\n        \"name\": \"鱿鱼\",\n        \"status\": 1,\n        \"parent_id\": 1,\n        \"created_at\": null,\n        \"updated_at\": null\n    },\n    {\n        \"id\": 4,\n        \"name\": \"罗非鱼\",\n        \"status\": 1,\n        \"parent_id\": 1,\n        \"created_at\": null,\n        \"updated_at\": null\n    }\n       ],\n\"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/CategoryController.php",
    "groupTitle": "Category",
    "name": "GetCategorySecondcate"
  },
  {
    "type": "get",
    "url": "/goods/detail",
    "title": "获取供应信息详情",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "goodsId",
            "description": "<p>商品ID</p>"
          }
        ]
      }
    },
    "group": "Goods",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "{\n        \"id\": 1,\n        \"title\": \"杭州湾鱿鱼1吨，欢迎采购！\",\n        \"thumb\": \"2/123.jpg\",\n        \"user_id\": 4,\n        \"category_id\": 1,\n        \"num\": 1,\n        \"price\": \"198.00\",\n        \"area\": \"杭州湾码头\",\n        \"position\": \"中国浙江杭州\",\n        \"status\": 1,\n        \"desc\": \"杭州湾有新鲜鱿鱼1吨，量大从优！\",\n        \"pic\": \"/2/1.jpg||/2/2.jpg\",\n        \"created_at\": 1,\n        \"updated_at\": null,\n        \"username\": \"15889897125\",\n        \"nickname\": \"用户1494929694644\",\n        \"avatat\": \"123456789\",\n        \"gender\": 0,\n        \"categoryId\": 1,\n        \"categoryName\": \"鱼类\",\n        \"categoryParent_id\": null,\n        \"api_code\": 200\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/GoodsController.php",
    "groupTitle": "Goods",
    "name": "GetGoodsDetail"
  },
  {
    "type": "post",
    "url": "/goods/add",
    "title": "发布供应信息详情",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "category_id",
            "description": "<p>categoryID</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "desc",
            "description": "<p>描述详情</p>"
          },
          {
            "group": "Parameter",
            "type": "area",
            "optional": false,
            "field": "area",
            "description": "<p>货物所在地区</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "pic",
            "description": "<p>图片</p>"
          }
        ]
      }
    },
    "group": "Goods",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "{\n        \"data\": \"恭喜，发布成功，等待管理员审核！\",\n        \"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/GoodsController.php",
    "groupTitle": "Goods",
    "name": "PostGoodsAdd"
  },
  {
    "type": "post",
    "url": "/goods/search",
    "title": "搜索供应信息",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "keyword",
            "description": "<p>关键字，如果不传此参数则直接按发布时间、page、pageSize排序显示</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "description": "<p>起始id</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>页码 默认从第0页开始</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pageSize",
            "description": "<p>一页数量,默认为20</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "categoryId",
            "description": "<p>分类ID</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "orderTime",
            "description": "<p>根据时间排序，1 代表升序，2 代表降序</p>"
          }
        ]
      }
    },
    "group": "Goods",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "{\n       \"data\": [\n                 {\n                    \"id\": 4,\n                    \"title\": \"杭州湾程序猿3吨，欢迎采购！\",\n                    \"thumb\": \"2/123.jpg\",\n                    \"user_id\": 4,\n                    \"category_id\": 1,\n                    \"num\": 1,\n                    \"price\": \"198.00\",\n                    \"area\": \"杭州湾码头2\",\n                    \"position\": \"中国浙江杭州2\",\n                    \"status\": 1,\n                    \"desc\": \"杭州湾有新鲜鱿鱼1吨，量大从优！\",\n                    \"pic\": \"/2/1.jpg||/2/2.jpg\",\n                    \"created_at\": 3,\n                    \"updated_at\": null,\n                    \"username\": \"15889897125\",\n                    \"nickname\": \"用户1494929694644\",\n                    \"avatat\": \"123456789\",\n                    \"gender\": 0,\n                    \"categoryId\": 1,\n                    \"categoryName\": \"鱼类\",\n                    \"categoryParent_id\": null\n                 }\n              ],\n        \"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/GoodsController.php",
    "groupTitle": "Goods",
    "name": "PostGoodsSearch"
  },
  {
    "type": "post",
    "url": "/goods/update",
    "title": "更新供应信息详情",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "goods_id",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "category_id",
            "description": "<p>categoryID</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "desc",
            "description": "<p>描述详情</p>"
          },
          {
            "group": "Parameter",
            "type": "area",
            "optional": false,
            "field": "area",
            "description": "<p>货物所在地区</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "pic",
            "description": "<p>图片</p>"
          }
        ]
      }
    },
    "group": "Goods",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "{\n    \"data\": \"恭喜，更新成功，等待管理员审核！\",\n    \"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/GoodsController.php",
    "groupTitle": "Goods",
    "name": "PostGoodsUpdate"
  },
  {
    "type": "post",
    "url": "/address/add",
    "title": "添加地址信息",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "category_id",
            "description": "<p>categoryID</p>"
          },
          {
            "group": "Parameter",
            "type": "decimal",
            "optional": false,
            "field": "price",
            "description": "<p>采购价格</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "num",
            "description": "<p>采购数量</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "demandstatus",
            "description": "<p>状态需求</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "otherstatus",
            "description": "<p>状态需求</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "area",
            "description": "<p>地理位置</p>"
          }
        ]
      }
    },
    "group": "address",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "\n{\n    \"data\": \"恭喜，地址添加成功！\",\n    \"api_code\": 200\n    }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/AddressController.php",
    "groupTitle": "address",
    "name": "PostAddressAdd"
  },
  {
    "type": "post",
    "url": "/auth/add",
    "title": "添加认证信息",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "name",
            "description": "<p>用户姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "enum",
            "optional": false,
            "field": "gender",
            "description": "<p>性别，1代表男，2代表女</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "telphone",
            "description": "<p>联系电话</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "id_hand_pic",
            "description": "<p>手持身份证照片</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "ship_auth_pic",
            "description": "<p>船舶证书照片</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "ship_pic",
            "description": "<p>船舶照片</p>"
          }
        ]
      }
    },
    "group": "auth",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "\n{\n        \"data\": \"您的认证信息已提交，等待管理员审核！\",\n        \"api_code\": 200\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/AuthController.php",
    "groupTitle": "auth",
    "name": "PostAuthAdd"
  },
  {
    "type": "post",
    "url": "/companyauth/add",
    "title": "添加公司认证信息",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "name",
            "description": "<p>法人代表姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "enum",
            "optional": false,
            "field": "gender",
            "description": "<p>性别，1代表男，2代表女</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "telphone",
            "description": "<p>联系电话</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "company_pic",
            "description": "<p>营业执照照片</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "id_hand_pic",
            "description": "<p>手持身份证照片</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "factory_pic",
            "description": "<p>工厂照片</p>"
          }
        ]
      }
    },
    "group": "companyauth",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "\n{\n        \"data\": \"您的认证信息已提交，等待管理员审核！\",\n        \"api_code\": 200\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/CompanyauthController.php",
    "groupTitle": "companyauth",
    "name": "PostCompanyauthAdd"
  },
  {
    "type": "get",
    "url": "/demand/detail",
    "title": "获取采购信息详情",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "demandId",
            "description": "<p>商品ID</p>"
          }
        ]
      }
    },
    "group": "demand",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "\n{\n        \"id\": 1,\n        \"title\": \"杭州湾鱿鱼1吨，欢迎采购！\",\n        \"thumb\": \"2/123.jpg\",\n        \"user_id\": 4,\n        \"category_id\": 1,\n        \"num\": 1,\n        \"price\": \"198.00\",\n        \"area\": \"杭州湾码头\",\n        \"position\": \"中国浙江杭州\",\n        \"status\": 1,\n        \"desc\": \"杭州湾有新鲜鱿鱼1吨，量大从优！\",\n        \"pic\": \"/2/1.jpg||/2/2.jpg\",\n        \"created_at\": 1,\n        \"updated_at\": null,\n        \"demandstatus\": \"要新鲜\",\n        \"otherstatus\": \"我其它需求是尽快发货\",\n        \"username\": \"15889897125\",\n        \"nickname\": \"用户1494929694644\",\n        \"avatat\": \"123456789\",\n        \"gender\": 0,\n        \"categoryId\": 1,\n        \"categoryName\": \"鱼类\",\n        \"categoryParent_id\": null,\n        \"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/DemandController.php",
    "groupTitle": "demand",
    "name": "GetDemandDetail"
  },
  {
    "type": "post",
    "url": "/demand/add",
    "title": "发布供应信息详情",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "category_id",
            "description": "<p>categoryID</p>"
          },
          {
            "group": "Parameter",
            "type": "decimal",
            "optional": false,
            "field": "price",
            "description": "<p>采购价格</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "num",
            "description": "<p>采购数量</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "demandstatus",
            "description": "<p>状态需求</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "otherstatus",
            "description": "<p>状态需求</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "area",
            "description": "<p>地理位置</p>"
          }
        ]
      }
    },
    "group": "demand",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "\n{\n        \"data\": \"恭喜，发布成功，等待管理员审核！\",\n        \"api_code\": 200\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/DemandController.php",
    "groupTitle": "demand",
    "name": "PostDemandAdd"
  },
  {
    "type": "post",
    "url": "/demand/search",
    "title": "搜索需求信息",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "keyword",
            "description": "<p>关键字，如果不传此参数则直接按发布时间、page、pageSize排序显示,类与于首页</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "description": "<p>起始id</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>页码 默认从第0页开始</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pageSize",
            "description": "<p>一页数量,默认为20</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "categoryId",
            "description": "<p>分类ID</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "orderTime",
            "description": "<p>根据时间排序，1 代表升序，2 代表降序</p>"
          }
        ]
      }
    },
    "group": "demand",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "{\n        \"data\": [\n         {\n            \"id\": 1,\n            \"title\": \"新疆喀什地区需求咸鱼1吨~\",\n            \"thumb\": \"2/5.jpg\",\n            \"user_id\": 4,\n            \"category_id\": 1,\n            \"num\": \"1\",\n            \"price\": \"2000.00\",\n            \"area\": \"新疆地区\",\n            \"position\": \"中国新疆喀什市\",\n            \"status\": 1,\n            \"desc\": \"我们这里想买鱼，有人有货吗？\",\n            \"pic\": \"2/123.jpg||2/234.jpg\",\n            \"created_at\": 1,\n            \"updated_at\": null,\n            \"demandstatus\": \"要新鲜\",\n            \"otherstatus\": \"我其它需求是尽快发货\",\n            \"username\": \"15889897125\",\n            \"nickname\": \"用户1494929694644\",\n            \"avatat\": \"123456789\",\n            \"gender\": 0,\n            \"categoryId\": 1,\n            \"categoryName\": \"鱼类\",\n            \"categoryParent_id\": null\n         }\n             ],\n        \"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/DemandController.php",
    "groupTitle": "demand",
    "name": "PostDemandSearch"
  },
  {
    "type": "post",
    "url": "/demand/update",
    "title": "更新供应信息详情",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "demand_id",
            "description": "<p>demand_id</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "category_id",
            "description": "<p>categoryID</p>"
          },
          {
            "group": "Parameter",
            "type": "decimal",
            "optional": false,
            "field": "price",
            "description": "<p>采购价格</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "num",
            "description": "<p>采购数量</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "demandstatus",
            "description": "<p>状态需求</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "otherstatus",
            "description": "<p>状态需求</p>"
          },
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "area",
            "description": "<p>地理位置</p>"
          }
        ]
      }
    },
    "group": "demand",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "\n{\n    \"data\": \"恭喜，更新成功，等待管理员审核！\",\n    \"api_code\": 200\n    }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/DemandController.php",
    "groupTitle": "demand",
    "name": "PostDemandUpdate"
  },
  {
    "type": "get",
    "url": "/home/hotgoods",
    "title": "首页精选信息",
    "version": "0.1.0",
    "group": "home",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "goods",
            "description": "<p>精选数量，默认为3条</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "例子",
          "content": "\n{\n\"hotgoods\": [\n{\n\"id\": \"1\",\n\"title\": \"杭州湾鱿鱼1吨，欢迎采购！\",\n\"thumb\": \"2/123.jpg\",\n\"user_id\": \"4\",\n\"category_id\": \"1\",\n\"num\": \"1\",\n\"price\": \"198.00\",\n\"area\": \"杭州湾码头\",\n\"position\": \"中国浙江杭州\",\n\"status\": \"1\",\n\"desc\": \"杭州湾有新鲜鱿鱼1吨，量大从优！\",\n\"pic\": \"/2/1.jpg||/2/2.jpg\",\n\"created_at\": \"1\",\n\"updated_at\": null,\n\"rank\": 9999,\n\"username\": \"15889897125\",\n\"nickname\": \"用户1494929694644\",\n\"avatat\": \"123456789\",\n\"gender\": \"0\",\n\"categoryId\": \"1\",\n\"categoryName\": \"鱼类\",\n\"categoryParent_id\": null\n},\n{\n\"id\": \"3\",\n\"title\": \"杭州湾贝壳2吨，欢迎采购！\",\n\"thumb\": \"2/123.jpg\",\n\"user_id\": \"4\",\n\"category_id\": \"1\",\n\"num\": \"1\",\n\"price\": \"198.00\",\n\"area\": \"杭州湾码头2\",\n\"position\": \"中国浙江杭州2\",\n\"status\": \"1\",\n\"desc\": \"杭州湾有新鲜鱿鱼1吨，量大从优！\",\n\"pic\": \"/2/1.jpg||/2/2.jpg\",\n\"created_at\": \"2\",\n\"updated_at\": null,\n\"rank\": 9999,\n\"username\": \"15889897125\",\n\"nickname\": \"用户1494929694644\",\n\"avatat\": \"123456789\",\n\"gender\": \"0\",\n\"categoryId\": \"1\",\n\"categoryName\": \"鱼类\",\n\"categoryParent_id\": null\n},\n{\n\"id\": \"4\",\n\"title\": \"杭州湾程序猿3吨，欢迎采购！\",\n\"thumb\": \"2/123.jpg\",\n\"user_id\": \"4\",\n\"category_id\": \"2\",\n\"num\": \"1\",\n\"price\": \"198.00\",\n\"area\": \"杭州湾码头2\",\n\"position\": \"中国浙江杭州2\",\n\"status\": \"1\",\n\"desc\": \"杭州湾有新鲜鱿鱼1吨，量大从优！\",\n\"pic\": \"/2/1.jpg||/2/2.jpg\",\n\"created_at\": \"3\",\n\"updated_at\": null,\n\"rank\": 9999,\n\"username\": \"15889897125\",\n\"nickname\": \"用户1494929694644\",\n\"avatat\": \"123456789\",\n\"gender\": \"0\",\n\"categoryId\": \"2\",\n\"categoryName\": \"贝类\",\n\"categoryParent_id\": null\n}\n],\n\"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/HomeController.php",
    "groupTitle": "home",
    "name": "GetHomeHotgoods"
  },
  {
    "type": "get",
    "url": "/home/index",
    "title": "首页banner信息",
    "version": "0.1.0",
    "group": "home",
    "success": {
      "examples": [
        {
          "title": "例子：type 1 为小图 type 0 为大图",
          "content": "{\n    \"bigbanner\": [\n    {\n    \"id\": \"4\",\n    \"file_path\": \"/1/14957091718712.jpg\",\n    \"link_path\": \"www.4399.com\",\n    \"created_at\": \"1495709183\",\n    \"updated_at\": \"1495709183\",\n    \"rank\": \"1\",\n    \"title\": \"1\",\n    \"type\": \"0\"\n    },\n    {\n    \"id\": \"5\",\n    \"file_path\": \"/1/14957091923763.jpg\",\n    \"link_path\": \"www.baidu.com\",\n    \"created_at\": \"1495709202\",\n    \"updated_at\": \"1495709202\",\n    \"rank\": \"2\",\n    \"title\": \"1\",\n    \"type\": \"0\"\n    },\n    {\n    \"id\": \"6\",\n    \"file_path\": \"/1/14957092125675.jpg\",\n    \"link_path\": \"www.4399.com\",\n    \"created_at\": \"1495709223\",\n    \"updated_at\": \"1495709223\",\n    \"rank\": \"3\",\n    \"title\": \"狗\",\n    \"type\": \"0\"\n    }\n    ],\n    \"smallbanner\": [\n    {\n    \"id\": \"1\",\n    \"file_path\": \"/1/14957087952811.jpg\",\n    \"link_path\": \"www.baidu.com\",\n    \"created_at\": \"1495708817\",\n    \"updated_at\": \"1495709094\",\n    \"rank\": \"1\",\n    \"title\": \"狗\",\n    \"type\": \"1\"\n    },\n    {\n    \"id\": \"2\",\n    \"file_path\": \"/1/1495708855778.jpeg\",\n    \"link_path\": \"www.sina.com\",\n    \"created_at\": \"1495708873\",\n    \"updated_at\": \"1495708873\",\n    \"rank\": \"2\",\n    \"title\": \"捏狗\",\n    \"type\": \"1\"\n    },\n    {\n    \"id\": \"3\",\n    \"file_path\": \"/1/14957088911210.jpeg\",\n    \"link_path\": \"www.4399.com\",\n    \"created_at\": \"1495708908\",\n    \"updated_at\": \"1495708908\",\n    \"rank\": \"3\",\n    \"title\": \"日狗\",\n    \"type\": \"1\"\n    }\n    ],\n    \"api_code\": 200\n    }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/HomeController.php",
    "groupTitle": "home",
    "name": "GetHomeIndex"
  },
  {
    "type": "post",
    "url": "/order/add",
    "title": "点击第一个支付支付后提交订单",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "goods_id",
            "description": "<p>商品ID（必填）</p>"
          }
        ]
      }
    },
    "group": "order",
    "success": {
      "examples": [
        {
          "title": "返回订单id,提示消息",
          "content": "\n{\n        \"order_id\": 5,\n        \"success\": \"订单生成成功，等待客户确认价格...\",\n        \"api_code\": 200\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/OrderController.php",
    "groupTitle": "order",
    "name": "PostOrderAdd"
  },
  {
    "type": "post",
    "url": "/order/confirm",
    "title": "点击第二个支付支付后确认订单",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单ID（必填）</p>"
          },
          {
            "group": "Parameter",
            "type": "decimal",
            "optional": false,
            "field": "goods_amount",
            "description": "<p>买家填写的定金（必填）</p>"
          }
        ]
      }
    },
    "group": "order",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "\n{\n        \"order_id\": \"7\",\n        \"success\": \"订单提交成功，等待支付...\",\n        \"api_code\": 200\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/OrderController.php",
    "groupTitle": "order",
    "name": "PostOrderConfirm"
  },
  {
    "type": "post",
    "url": "/order/deletebuy",
    "title": "删除已购买订单",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "order_id",
            "description": "<p>商品ID（必填）</p>"
          }
        ]
      }
    },
    "group": "order",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "\n{\n    \"order_id\": 5,\n    \"success\": \"订单已删除\",\n    \"api_code\": 200\n    }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/OrderController.php",
    "groupTitle": "order",
    "name": "PostOrderDeletebuy"
  },
  {
    "type": "post",
    "url": "/order/deletesell",
    "title": "删除已卖出订单",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "order_id",
            "description": "<p>商品ID（必填）</p>"
          }
        ]
      }
    },
    "group": "order",
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "\n{\n    \"order_id\": 5,\n    \"success\": \"订单已删除\",\n    \"api_code\": 200\n    }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/OrderController.php",
    "groupTitle": "order",
    "name": "PostOrderDeletesell"
  },
  {
    "type": "get",
    "url": "/pay/charge",
    "title": "充值",
    "version": "0.1.0",
    "group": "pay",
    "filename": "../../api/common/controllers/PayController.php",
    "groupTitle": "pay",
    "name": "GetPayCharge"
  },
  {
    "type": "get",
    "url": "/pay/pay",
    "title": "支付",
    "version": "0.1.0",
    "group": "pay",
    "filename": "../../api/common/controllers/PayController.php",
    "groupTitle": "pay",
    "name": "GetPayPay"
  },
  {
    "type": "get",
    "url": "/region/cities",
    "title": "获取省份下面的城市",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "province",
            "description": "<p>省份的id</p>"
          }
        ]
      }
    },
    "group": "region",
    "success": {
      "examples": [
        {
          "title": "例子：",
          "content": "\n{\n            \"data\": [\n                {\n                    \"id\": 381,\n                    \"parent_id\": 36,\n                    \"region_name\": \"西城区\",\n                    \"region_type\": 3,\n                    \"agency_id\": 0,\n                    \"areaid\": \"110101\",\n                    \"zip\": \"100000\",\n                    \"code\": \"010\"\n                },\n                {\n                    \"id\": 382,\n                    \"parent_id\": 36,\n                    \"region_name\": \"崇文区\",\n                    \"region_type\": 3,\n                    \"agency_id\": 0,\n                    \"areaid\": \"110101\",\n                    \"zip\": \"100000\",\n                    \"code\": \"010\"\n                }\n            ],\n            \"api_code\": 200\n      }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/RegionController.php",
    "groupTitle": "region",
    "name": "GetRegionCities"
  },
  {
    "type": "get",
    "url": "/region/province",
    "title": "获取省份",
    "version": "0.1.0",
    "group": "region",
    "success": {
      "examples": [
        {
          "title": "例子：",
          "content": "\n{\n         \"data\": [\n                {\n                    \"id\": 2,\n                    \"parent_id\": 1,\n                    \"region_name\": \"北京\",\n                    \"region_type\": 1,\n                    \"agency_id\": 0,\n                    \"areaid\": \"110000\",\n                    \"zip\": \"110000\",\n                    \"code\": null\n                },\n                {\n                    \"id\": 3,\n                    \"parent_id\": 1,\n                    \"region_name\": \"天津\",\n                    \"region_type\": 1,\n                    \"agency_id\": 0,\n                    \"areaid\": \"120000\",\n                    \"zip\": \"120000\",\n                    \"code\": null\n                }\n            ],\n          \"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/RegionController.php",
    "groupTitle": "region",
    "name": "GetRegionProvince"
  },
  {
    "type": "get",
    "url": "/region/regions",
    "title": "获取城市下面的区或县",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "city",
            "description": "<p>城市的id</p>"
          }
        ]
      }
    },
    "group": "region",
    "success": {
      "examples": [
        {
          "title": "例子：",
          "content": "\n{\n        \"data\": [\n        {\n            \"id\": 36,\n            \"parent_id\": 2,\n            \"region_name\": \"北京市辖区\",\n            \"region_type\": 2,\n            \"agency_id\": 0,\n            \"areaid\": \"110100\",\n            \"zip\": \"110100\",\n            \"code\": \"010\"\n        },\n        {\n            \"id\": 37,\n            \"parent_id\": 2,\n            \"region_name\": \"北京下属县\",\n            \"region_type\": 2,\n            \"agency_id\": 0,\n            \"areaid\": \"110200\",\n            \"zip\": \"110200\",\n            \"code\": \"010\"\n        }\n        ],\n        \"api_code\": 200\n    }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/RegionController.php",
    "groupTitle": "region",
    "name": "GetRegionRegions"
  },
  {
    "type": "post",
    "url": "/upload/upload",
    "title": "图片上传",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>上传类型 1代表用户头像，2代表goods图片，3代表demand图片，4代表认证图片，5代表其它</p>"
          },
          {
            "group": "Parameter",
            "type": "file",
            "optional": false,
            "field": "imgs",
            "description": "<p>上传文件的对象，多张图片，用imags[1],imags[2]...即可</p>"
          }
        ]
      }
    },
    "group": "upload",
    "success": {
      "examples": [
        {
          "title": "例子：",
          "content": "\n{\n        \"data\":\n         [\n            \"/3/14956913619581.png\"\n         ],\n        \"api_code\": 200\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UploadController.php",
    "groupTitle": "upload",
    "name": "PostUploadUpload"
  },
  {
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机号</p>"
          }
        ]
      }
    },
    "group": "user",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>1已注册 0未注册</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "范例",
          "content": "{\n\"data\": 1\n}",
          "type": "json"
        }
      ]
    },
    "type": "",
    "url": "",
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": ""
  },
  {
    "type": "get",
    "url": "/users",
    "title": "取当前登录用户信息",
    "version": "0.1.0",
    "group": "user",
    "permission": [
      {
        "name": "token"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "范例",
          "content": "同第三方登录里的user,注意！新增两个字段fisher-渔民认证和factory-商家认证，0代表未认证，1代表认证中，2代表已认证，4代表认证失败",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "GetUsers"
  },
  {
    "type": "post",
    "url": "/user/buy",
    "title": "已购买",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单id,如果不传，则默认显示该用户的所有</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>第几页，分页用,如果不传，则默认显示该用户的所有</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pageSize",
            "description": "<p>每页显示多少条,如果不传，则默认显示该用户的所有</p>"
          }
        ]
      }
    },
    "group": "user",
    "permission": [
      {
        "name": "token"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "范例 status 0代表订单未支付 1代表已支付，等待确认 2代表卖家已接单订单服务中 3代表服务完成，待买家确认 4代表订单已完成 5代表退货或退款",
          "content": "\n{\n            \"data\": [\n            {\n                \"id\": 7,\n                \"type\": 0,\n                \"goods_id\": 15,\n                \"sn\": \"201705270958395826\",\n                \"status\": 3,\n                \"before_refund_status\": 0,\n                \"refund_status\": 0,\n                \"refund_amount\": \"0.00\",\n                \"refund_balance\": \"0.00\",\n                \"refund_paid\": \"0.00\",\n                \"refund_reason\": null,\n                \"goods_amount\": \"33.00\",\n                \"pay_type\": 3,\n                \"pay_platform\": null,\n                \"pay_trade_no\": null,\n                \"goods_name\": \"发布商品信息测试！\",\n                \"goods_price\": \"99.00\",\n                \"seller_id\": 6,\n                \"buyer_id\": 5,\n                \"buyer_name\": null,\n                \"buyer_mobile\": null,\n                \"buyer_addr\": null,\n                \"message\": null,\n                \"pay_time\": null,\n                \"post_pay_time\": null,\n                \"created_at\": null,\n                \"updated_at\": null\n            }\n            ],\n                \"api_code\": 200\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUserBuy"
  },
  {
    "type": "post",
    "url": "/user/delete",
    "title": "删除",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "goods_id",
            "description": "<p>要删除的供应信息id</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "demand_id",
            "description": "<p>要删除的需求信息id</p>"
          }
        ]
      }
    },
    "group": "user",
    "permission": [
      {
        "name": "token"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "{",
          "content": "{\n   \"data\": \"删除供应信息成功！\",\n   \"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUserDelete"
  },
  {
    "type": "post",
    "url": "/user/mydemand",
    "title": "我的发布-需求信息信息",
    "version": "0.1.0",
    "group": "user",
    "permission": [
      {
        "name": "token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "demand_id",
            "description": "<p>需求信息id,如果不传，则默认显示该用户的所有</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>第几页，分页用,如果不传，则默认显示该用户的所有</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pageSize",
            "description": "<p>每页显示多少条,如果不传，则默认显示该用户的所有</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "范例",
          "content": "\n{\n        \"data\": [\n            {\n            \"id\": 1,\n            \"title\": \"新疆喀什地区需求咸鱼1吨~\",\n            \"thumb\": \"2/5.jpg\",\n            \"user_id\": 4,\n            \"category_id\": 1,\n            \"num\": \"1\",\n            \"price\": \"2000.00\",\n            \"area\": \"新疆地区\",\n            \"position\": \"中国新疆喀什市\",\n            \"status\": 1,\n            \"desc\": \"我们这里想买鱼，有人有货吗？\",\n            \"pic\": \"2/123.jpg||2/234.jpg\",\n            \"created_at\": 1,\n            \"updated_at\": null,\n            \"demandstatus\": \"要新鲜\",\n            \"otherstatus\": \"我其它需求是尽快发货\",\n            \"username\": \"15889897125\",\n            \"nickname\": \"用户1494929694644\",\n            \"avatat\": \"123456789\",\n            \"gender\": 0,\n            \"categoryId\": 1,\n            \"categoryName\": \"鱼类\",\n            \"categoryParent_id\": null\n             }\n             ]\n        \"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUserMydemand"
  },
  {
    "type": "post",
    "url": "/user/mygoods/",
    "title": "我的发布-供应信息",
    "version": "0.1.0",
    "group": "user",
    "permission": [
      {
        "name": "token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "good_id",
            "description": "<p>商品id，如果不传，则默认显示该用户的所有</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>第几页，分页用,如果不传，则默认显示该用户的所有</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pageSize",
            "description": "<p>每页显示多少条,如果不传，则默认显示该用户的所有</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "范例（注：点击之后默认显示供应信息）",
          "content": "\n{\n            \"data\": [\n                {\n                    \"id\": 1,\n                    \"title\": \"杭州湾鱿鱼1吨，欢迎采购！\",\n                    \"thumb\": \"2/123.jpg\",\n                    \"user_id\": 4,\n                    \"category_id\": 1,\n                    \"num\": 1,\n                    \"price\": \"198.00\",\n                    \"area\": \"杭州湾码头\",\n                    \"position\": \"中国浙江杭州\",\n                    \"status\": 1,\n                    \"desc\": \"杭州湾有新鲜鱿鱼1吨，量大从优！\",\n                    \"pic\": \"/2/1.jpg||/2/2.jpg\",\n                    \"created_at\": 1,\n                    \"updated_at\": null,\n                    \"rank\": 9999,\n                    \"username\": \"15889897125\",\n                    \"nickname\": \"用户1494929694644\",\n                    \"avatat\": \"123456789\",\n                    \"gender\": 0,\n                    \"categoryId\": 1,\n                    \"categoryName\": \"鱼类\",\n                    \"categoryParent_id\": null\n                },\n                {\n                    \"id\": 3,\n                    \"title\": \"杭州湾贝壳2吨，欢迎采购！\",\n                    \"thumb\": \"2/123.jpg\",\n                    \"user_id\": 4,\n                    \"category_id\": 1,\n                    \"num\": 1,\n                    \"price\": \"198.00\",\n                    \"area\": \"杭州湾码头2\",\n                    \"position\": \"中国浙江杭州2\",\n                    \"status\": 1,\n                    \"desc\": \"杭州湾有新鲜鱿鱼1吨，量大从优！\",\n                    \"pic\": \"/2/1.jpg||/2/2.jpg\",\n                    \"created_at\": 2,\n                    \"updated_at\": null,\n                    \"rank\": 9999,\n                    \"username\": \"15889897125\",\n                    \"nickname\": \"用户1494929694644\",\n                    \"avatat\": \"123456789\",\n                    \"gender\": 0,\n                    \"categoryId\": 1,\n                    \"categoryName\": \"鱼类\",\n                    \"categoryParent_id\": null\n                },\n            ],\n            \"api_code\": 200\n      }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUserMygoods"
  },
  {
    "type": "post",
    "url": "/user/sell",
    "title": "已售出",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单id,如果不传，则默认显示该用户的所有</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>第几页，分页用,如果不传，则默认显示该用户的所有</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pageSize",
            "description": "<p>每页显示多少条,如果不传，则默认显示该用户的所有</p>"
          }
        ]
      }
    },
    "group": "user",
    "permission": [
      {
        "name": "token"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "范例",
          "content": "* {\n        \"data\": [\n            {\n                \"id\": 7,\n                \"type\": 0,\n                \"goods_id\": 15,\n                \"sn\": \"201705270958395826\",\n                ....信息太长就不显示了\n            }\n            ],\n        \"api_code\": 200\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUserSell"
  },
  {
    "type": "post",
    "url": "/users",
    "title": "更新当前登录用户资料",
    "version": "0.1.0",
    "group": "user",
    "permission": [
      {
        "name": "token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>昵称</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "push_cid",
            "description": "<p>推送cid（如个推cid）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "gender",
            "description": "<p>性别（0为女，1为男）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "birthday",
            "description": "<p>生日（字符串如1985-12-26）</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "范例（注：更新哪些字段就传哪些字段）",
          "content": "同获取当前登录用户信息",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUsers"
  },
  {
    "type": "post",
    "url": "/users/bind",
    "title": "绑定（换绑）手机号、微信",
    "version": "0.1.0",
    "group": "user",
    "permission": [
      {
        "name": "token"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>第三发登录类型，1手机 2微博 3QQ 4微信app 5微信公众号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "external_uid",
            "description": "<p>第三方uid，可能是手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "external_name",
            "description": "<p>第三方昵称，可能是手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>第三方token，可能是手机验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "other",
            "description": "<p>如果是微信登录必填，传入unionId</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "范例",
          "content": "同获取当前登录用户信息",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUsersBind"
  },
  {
    "type": "post",
    "url": "/users/code",
    "title": "获取手机验证码",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>0代表正常注册 1代表重置密码</p>"
          }
        ]
      }
    },
    "group": "user",
    "success": {
      "examples": [
        {
          "title": "（调试阶段默认验证码8888）",
          "content": "{\n\"data\": \"验证码发送成功，请注意查收\",\n\"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUsersCode"
  },
  {
    "type": "post",
    "url": "/users/login",
    "title": "手机号密码登录",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          }
        ]
      }
    },
    "group": "user",
    "success": {
      "examples": [
        {
          "title": "范例",
          "content": "\n{\n        \"token\": \"5922dfb409c22_1495457716\",\n        \"user\": {\n            \"id\": 7,\n            \"nickname\": \"用户149545734357\",\n            \"avatar\": \"/img/avatar.png\",\n            \"gender\": 0,\n            \"birthday\": null,\n            \"reg_time\": 1495457344,\n            \"oauths\": [\n            {\n            \"type\": 1,\n            \"external_uid\": \"15889891234\",\n            \"external_name\": \"yifu3\"\n            }\n            ],\n            \"devices\": [\n            {\n            \"device\": \"123\",\n            \"last_active\": 1495457344\n            },\n            {\n            \"device\": \"in\",\n            \"last_active\": 1495457716\n            }\n            ],\n            \"referee\": null\n            },\n        \"api_code\": 200\n        }",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUsersLogin"
  },
  {
    "type": "post",
    "url": "/users/logout",
    "title": "退出登录",
    "version": "0.1.0",
    "group": "user",
    "permission": [
      {
        "name": "token"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "范例",
          "content": "{\n\"data\": 1,\n\"api_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUsersLogout"
  },
  {
    "type": "post",
    "url": "/users/oauth",
    "title": "第三方(含手机)注册或登录",
    "description": "<p>只有未登录时会调用</p>",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>第三发登录类型，1手机 2微博 3QQ 4微信app 5微信公众号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "external_uid",
            "description": "<p>第三方uid，可能是手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "external_name",
            "description": "<p>第三方昵称，可能是手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>第三方token，可能是手机验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>如果是手机注册，必须设置密码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "other",
            "description": "<p>如果是微信登录必填，传入unionId</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>非必填，头像地址（如果第三方有）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "gender",
            "description": "<p>非必填，性别 0女 1男</p>"
          }
        ]
      }
    },
    "group": "user",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>用户id</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "没有则注册，否则登录",
          "content": "{\n {\n        \"token\": \"5922de40a162b_1495457344\",\n        \"user\": {\n            \"id\": 7,\n            \"nickname\": \"用户149545734357\",\n            \"avatar\": \"/img/avatar.png\",\n            \"gender\": null,\n            \"birthday\": null,\n            \"reg_time\": 1495457344,\n            \"oauths\": [\n            {\n            \"type\": 1,\n            \"external_uid\": \"15889891234\",\n            \"external_name\": \"yifu3\"\n            }\n            ],\n            \"devices\": [\n            {\n            \"device\": \"123\",\n            \"last_active\": 1495457344\n            }\n            ],\n            \"referee\": null\n            },\n        \"api_code\": 200\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUsersOauth"
  },
  {
    "type": "post",
    "url": "/users/reset-pwd",
    "title": "修改或重置密码",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "code",
            "description": "<p>手机验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>新密码</p>"
          }
        ]
      }
    },
    "group": "user",
    "success": {
      "examples": [
        {
          "title": "范例",
          "content": "同登录",
          "type": "json"
        }
      ]
    },
    "filename": "../../api/common/controllers/UserController.php",
    "groupTitle": "user",
    "name": "PostUsersResetPwd"
  }
] });
