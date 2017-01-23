# php-upload  官网 <url>http://www.toolvip.com</url>
# php-upload 


===============

php-upload 解决图片批量上传的一些问题,例如图片批量上传后关闭上传界面,无法二次编辑等问题!	


 + 基于layer弹窗插件[在此感谢layer]
 + 基于ajaxfileupload插件[在此万分感谢]
 + 灵活控制图片上传
 + 可二次编辑已上传过的多个或单个图片
> 仅仅支持PHP,如果其他语言需要,请修改service文件夹下的上传脚本

并没有开发文档

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─js           			demo页面所需的jquery插件文件夹
│  └─jquery.min.js      
│
├─Public                
│  ├─imgtmp             			默认图片上传路径,可修改
│  └─imgupload          			插件主要目录,禁止修改其层次
│  │  ├─css             			插件样式目录
│  │  ├─image           			插件所需图片
│  │  ├─js              			插件所需js文件
│  │  │  ├─layer        			layer插件目录,禁止修改
│  │  │  ├─ajaxfileupload.js        上传插件
│  │  │  ├─function.js        		公共方法
│  │  │  ├─jquery.min.js        	jquery插件
│  │  │  └─main.js                  主要js文件
│  │  └─service          			上传脚本目录
│  │  │  ├─config.json        		基础配置文件,必须配置
│  │  │  └─upload.php               上传脚本
└─ └─ └─index.html    				上传窗口文件


~~~
## 使用方法:


*   在你的调用页面,进入以下文件；
~~~
<!--必须引入-->
<script src="./Public/imgupload/js/layer/layer.js" type="text/javascript"></script>
<script src="./Public/imgupload/js/function.js" type="text/javascript"></script>
~~~
*   再引入以下代码；
~~~
  <script type="text/javascript">
        //配置图片上传状态以及图片数组
        var getImgMsg = new Array();
        //调用上传窗体
        var returnUrl = "Public/imgupload/index.html";
        //调用窗体方法
        function addCategory() {
            layer.open({
                title:"上传图片",   //配置标题
                type: 2,
                area: ['700px','700px'], //窗口宽高
                fix: false, //不固定
                maxmin: true,
                content: [returnUrl],       //上传插件地址
                success:function(layero,index){
                },
                end:function(){
                    if ( getImgMsg['status'] == '1' ) {
                        layer.msg('添加成功！');
                        //如果成功,将图片路径赋值给input
                        $("#getReturnMsg").val(JSON.stringify(getImgMsg['imgarray']));
                        console.log(getImgMsg)
                    } else if ( getImgMsg['status'] == '2' ) {
                        layer.msg('添加失败！');
                    }
                }
            });
        }
    </script>
~~~
*   引入这两个标签；
~~~
 <!--用于图片上传后获取参数,具体使用请在上传成功的位置进行后续处理,如果需要关闭上传窗体后还可以预览,保留此标签-->
    <input type="hidden" id="getReturnMsg"/>
    <!--方法调用,此标签只为执行onclick事件,可自定义-->
    <input id="Button1" type="button" value="批量上传"  onclick="addCategory()" />
~~~
*   引入这两个标签；
~~~
	需要在service文件夹下的config.json里配置一些基本设置,如文件上传路径,过滤参数等
~~~
	THINKPHP的童鞋注意,需要在  var returnUrl = "Public/imgupload/index.html";  这个位置,吧public替换为__PUBLIC__,才可以正确访问到!
~~~
## 版本:0.1
===============
#####  修复了图片宽高无法正确处理的bug
#####  解决处理图片时有警告错误无法正确提示的BUG
===============
## 版本:0.03
===============
#####  新增预览功能:批量新增以后,再次点击事件,可预览刚才上传的图片
#####  新增上传过滤:过滤内容有:上传文件格式,上传文件大小,上传图片宽高



===============
##  版本:0.02
这是一个雏形,开发这个插件的目的是解决市面上没有任何一款上传插件支持编辑的功能!
我们看下,什么是编辑,例如,我新增一个商品,需要上传大量的图片,这时候可以使用任意一款图片上传插件,去完成这个图片批量上传的工作,然后你填写完其他信息,提交!突然你发现少传了一张图片,这时候你发现,你的图片上传插件只能做新增时候的批量上传,如果我要修改我刚才上传的图片,并且新增或删除就非常不方便,因为它不支持,所以找个插件就诞生啦!目前支持的功能:
1.图片批量上传,预览
2.提供一个预展示接口,可以在编辑页面的时候,预览你已经上传过的图片,并且支持新增,删除操作!
已知BUG或缺陷:
  1.删除只不过是字面意义上的删除,并没有做到真正删除此图片,我在权衡这个功能是否添加!
