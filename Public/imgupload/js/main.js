/**
 * Created by Administrator on 2017/1/19.
 */
/**
 *
 * @param object file标签的对象
 */
function ajaxUploadFiles(object) {
    var fileid = $(object).attr('id');
    $.ajaxFileUpload({
        url: getRootPath()+"/imgupload/service/upload.php", //你处理上传文件的服务端
        secureuri: false, //与页面处理代码中file相对应的ID值
        fileElementId: fileid,
        dataType: 'json', //返回数据类型:text，xml，json，html,scritp,jsonp五种
        success: function(data) {
            if (data.status == '0') {
               alert(data.msg);
            } else if (data.status == '1') {
                console.log(fileid);
                var html = '<li class="img_li"><img src="' + data.msg + '" id="testimg' + fileid + '" class="testimgstyle"><img src="" alt="" class="delect_img hide"  /></li>'
                $('.img_ul').append(html);
                deleteLi();
            }
        },


    });
}
/**
 * 获取绝对路径
 * @returns {string}
 */
function getRootPath() {
    //获取当前网址，如： http://localhost:8080/ems/Pages/Basic/Person.jsp
    var curWwwPath = window.document.location.href;
    //获取主机地址之后的目录，如： /ems/Pages/Basic/Person.jsp
    var pathName = window.document.location.pathname;
    var pos = curWwwPath.indexOf(pathName);
    //获取主机地址，如： http://localhost:8080
    var localhostPath = curWwwPath.substring(0, pos);
    //获取带"/"的项目名，如：/ems
    var projectName = pathName.substring(0, pathName.substr(1).indexOf('/') + 1);
    return(localhostPath + projectName);
}

/**
 * 展示图片接口
 * @param data  data为一个Array,元素为图片地址
 */
function showImg(data) {
    var len = data.length;
    console.log(1);
    console.log(data);
    var html = "";
    for(var i = 0; i < len; i++){
         html += '<li class="img_li"><img src="' + data[i] + '" id="testimgimg1 " class="testimgstyle"><img src="" alt="" class="delect_img hide"  /></li>'
    }
    $('.img_ul').append(html);
    deleteLi();
}


