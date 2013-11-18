var images=new Array('/wp-content/themes/celadon/images/headerbg1.jpg','/wp-content/themes/celadon/images/headerbg2.jpg','/wp-content/themes/celadon/images/headerbg3.jpg','/wp-content/themes/celadon/images/headerbg4.jpg');
var nextimage=0;
{setTimeout(doSlideshow,0);}
doSlideshow();
function doSlideshow()
{
    if($('.slideshowimage').length!=0)
    {
        $('.slideshowimage').fadeOut(1500,function(){slideshowFadeIn();$(this).remove()});
    }
    else
    {
        slideshowFadeIn();
    }
}
function slideshowFadeIn()
{
    $('.slideshow').prepend($('<img class="slideshowimage" src="'+images[nextimage++]+'" style="display:none">').fadeIn(1500,function(){setTimeout(doSlideshow,8000);}));
    if(nextimage>=images.length)
        nextimage=0;
}