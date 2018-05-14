$(document).ready(function() {
  $('.goods').on('mouseenter', function() {
    $(this).addClass('highlight');
  });
  $('.goods').on('mouseleave', function() {
    $(this).removeClass('highlight');
  });
  $('.goods').on('click', function() {
  	//alert($(this).find('.goodsid').text());
  	var first="http://127.0.0.1/lt_envico/index.php/project/product/";
  	var last=$(this).find('.goodsid').text();
  	first=first+last;
  	//alert(first);
  	window.location.href=first; // 跳转到B目录
  });
});