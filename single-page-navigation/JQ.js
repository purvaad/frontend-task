$(document).ready(function(){
    $('.nav-menu ul li a').click(function(event){
        //when a navigation menu item is clicked
        $('.nav-menu ul li a').removeClass('active');
        $(this).addClass('active');
        thisAttrHref = $(this).attr('href');
        thisAttrHrefOffset = $(thisAttrHref).offset().top - 50;
        $('html,body').animate({scrollTop:thisAttrHrefOffset});
        event.preventDefault();

    });
});
// when the window is scrolled
$(window).scroll(function(){
    $('.container_row').each(function(){
        containerRowTop = $(this).offset().top;
        if($(document).scrollTop()> containerRowTop){
            thisOffset = $(this).attr('id');
            $('.container_row').removeClass('active');
            ActiveId = $(this).addClass('active').attr('id');
        }
    });
    $('.nav-menu ul li').each(function(index, el){
        thisChildren = $(this).children('a');
        thisChildrenHref = $(this). children('a').attr('href');
        if(thisChildrenHref === '#'+ActiveId){
            $('.nav-menu ul li a').removeClass('active');
            $(thisChildren).addClass('active')
        }
    })
})