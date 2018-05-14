$(document).ready(function() {
 $('#advertisement_1').on('click','.story', function() {
    console.log('講故事');
    var last=$(this).find('.goodsid').text();
    var route="./voice/story/"+last+".wav";
    var sound = new Audio(route);
    sound.play();
    //alert(first);
  });
});