/**
 * Created by Administrator on 2017/1/19.
 */
/**
 * 初始化监听事件
 */
function deleteLi() {
    for (var i = 0; i < $('.img_li').length; i++) {
        $('.img_li').eq(i).find('img.delect_img').on('click', function() {
            $(this).parent().remove();
        })
    }
}
//关闭页面
function CloseMyMsg() {
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);
}
/**
 * 用户关闭子窗体后于父窗体的交互,
 */
function closeWindow() {
    var imgurl = new Array();
    var i = 0;
    $("ul img.testimgstyle").each(function () {
        imgurl[i] = $(this)[0].src;
        i++;
    });
    var len = imgurl.length;
    if(len <= 0){
        parent.getImgMsg['status']=2;
    }else{
        parent.getImgMsg['status']=1;
    }
    parent.getImgMsg['imgarray']=imgurl;
    CloseMyMsg();
}
