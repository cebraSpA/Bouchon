(function($){

$(document).ready(function() {
    
    
$('.tc_overlay').hover(
  function () {
    $('.nombre').hide();
    $('.rol-empresa').hide();
  }, 
  function () {
    $('.nombre').show();
    $('.rol-empresa').show();
  }
);
    
$('.reserva-link').hover(
  function () {
    $('.img-reserva').show();
    $('.img-espumantes').hide();
    $('.img-iconos').hide();
    $('.img-terroir').hide();
    $('.img-otras').hide();
  }
);

$('.espumantes-link').hover(
  function () {
    $('.img-espumantes').show();
    $('.img-reserva').hide();
    $('.img-iconos').hide();
    $('.img-terroir').hide();
    $('.img-otras').hide();
  }
);

$('.iconos-link').hover(
  function () {
    $('.img-iconos').show();
    $('.img-reserva').hide();
    $('.img-espumantes').hide();
    $('.img-terroir').hide();
    $('.img-otras').hide();
  }
);

$('.terroir-link').hover(
  function () {
    $('.img-terroir').show();
    $('.img-reserva').hide();
    $('.img-espumantes').hide();
    $('.img-iconos').hide();
    $('.img-otras').hide();
  }
);

$('.otras-link').hover(
  function () {
    $('.img-otras').show();
    $('.img-reserva').hide();
    $('.img-espumantes').hide();
    $('.img-iconos').hide();
    $('.img-terroir').hide();
  }
);
    
    /** Batuco **/

$('#showvine').click(function() {
           if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.vineyard').slideToggle('fast');
            $('.clima').hide();
            $('.ubi').hide();
            $('.suelo').hide();
            $('#showvine').removeClass( 'list-history_item_first');
            $('#showvine').addClass( 'active-class' );
            $('#showclima').removeClass( "active-class" );
            $('#showclima').addClass( 'list-history_item' );
            $('#showubi').removeClass( "active-class" );
            $('#showubi').addClass( 'list-history_item' );
            $('#showsuelo').removeClass( "active-class" );
            $('#showsuelo').addClass( 'list-history_item' );
            
           }
            
    });
    $('#showclima').click(function() {
        if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.clima').slideToggle('fast');
            $('.vineyard').hide();
            $('.ubi').hide();
            $('.suelo').hide();
            $('#showclima').removeClass( "list-history_item" );
            $('#showclima').addClass( 'active-class' );
            $('#showvine').removeClass( "active-class" );
            $('#showvine').addClass( 'list-history_item_first' );
            $('#showubi').removeClass( "active-class" );
            $('#showubi').addClass( 'list-history_item' );
            $('#showsuelo').removeClass( "active-class" );
            $('#showsuelo').addClass( 'list-history_item' );
           }
    });
    $('#showubi').click(function() {
        if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.ubi').slideToggle('fast');
            $('.vineyard').hide();
            $('.clima').hide();
            $('.suelo').hide();
            $('#showubi').removeClass( "list-history_item" );
            $('#showubi').addClass( 'active-class' );
            $('#showvine').removeClass( "active-class" );
            $('#showvine').addClass( 'list-history_item_first' );
            $('#showclima').removeClass( "active-class" );
            $('#showclima').addClass( 'list-history_item' );
            $('#showsuelo').removeClass( "active-class" );
            $('#showsuelo').addClass( 'list-history_item' );
           }
    });
    
    $('#showsuelo').click(function() {
        if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.suelo').slideToggle('fast');
            $('.vineyard').hide();
            $('.clima').hide();
            $('.ubi').hide();
            $('#showubi').removeClass( "active-class" );
            $('#showubi').addClass( 'list-history_item' );
            $('#showsuelo').addClass( 'active-class' );
            $('#showvine').removeClass( "active-class" );
            $('#showvine').addClass( 'list-history_item_first' );
            $('#showclima').removeClass( "active-class" );
            $('#showclima').addClass( 'list-history_item' );
           }
    });
    
/** Mingre **/
    $('#showvinem').click(function() {
           if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.vineyardm').slideToggle('fast');
            $('.climam').hide();
            $('.ubim').hide();
            $('.suelom').hide();
            $('#showvinem').removeClass( 'list-history_item_first');
            $('#showvinem').addClass( 'active-class' );
            $('#showclimam').removeClass( "active-class" );
            $('#showclimam').addClass( 'list-history_item' );
            $('#showubim').removeClass( "active-class" );
            $('#showubim').addClass( 'list-history_item' );
            $('#showsuelom').removeClass( "active-class" );
            $('#showsuelom').addClass( 'list-history_item' );
           }
            
    });
    $('#showclimam').click(function() {
        if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.climam').slideToggle('fast');
            $('.vineyardm').hide();
            $('.ubim').hide();
            $('.suelom').hide();
            $('#showclimam').removeClass( "list-history_item" );
            $('#showclimam').addClass( 'active-class' );
            $('#showvinem').removeClass( "active-class" );
            $('#showvinem').addClass( 'list-history_item_first' );
            $('#showubim').removeClass( "active-class" );
            $('#showubim').addClass( 'list-history_item' );
            $('#showsuelom').removeClass( "active-class" );
            $('#showsuelom').addClass( 'list-history_item' );
           }
    });
    $('#showsuelom').click(function() {
        if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.suelom').slideToggle('fast');
            $('.vineyardm').hide();
            $('.climam').hide();
            $('.ubim').hide();
            $('#showsuelom').removeClass( "list-history_item" );
            $('#showsuelom').addClass( 'active-class' );
            $('#showvinem').removeClass( "active-class" );
            $('#showvinem').addClass( 'list-history_item_first' );
            $('#showclimam').removeClass( "active-class" );
            $('#showclimam').addClass( 'list-history_item' );
            $('#showubim').removeClass( "active-class" );
            $('#showubim').addClass( 'list-history_item' );
           }
    });
    
    $('#showubim').click(function() {
        if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.ubim').slideToggle('fast');
            $('.vineyardm').hide();
            $('.climam').hide();
            $('.suelom').hide();
            $('#showubim').removeClass( "list-history_item" );
            $('#showubim').addClass( 'active-class' );
            $('#showvinem').removeClass( "active-class" );
            $('#showvinem').addClass( 'list-history_item_first' );
            $('#showclimam').removeClass( "active-class" );
            $('#showclimam').addClass( 'list-history_item' );
            $('#showsuelom').removeClass( "active-class" );
            $('#showsuelom').addClass( 'list-history_item' );
           }
    });
    
    
    /** Santa Rosa **/
    $('#showvines').click(function() {
           if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.vineyards').slideToggle('fast');
            $('.climas').hide();
            $('.ubis').hide();
            $('.suelos').hide();
            $('#showvines').removeClass( 'list-history_item_first');
            $('#showvines').addClass( 'active-class' );
            $('#showclimas').removeClass( "active-class" );
            $('#showclimas').addClass( 'list-history_item' );
            $('#showubis').removeClass( "active-class" );
            $('#showubis').addClass( 'list-history_item' );
            $('#showsuelos').removeClass( "active-class" );
            $('#showsuelos').addClass( 'list-history_item' );
           }
            
    });
    $('#showclimas').click(function() {
        if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.climas').slideToggle('fast');
            $('.vineyards').hide();
            $('.ubis').hide();
            $('.suelos').hide();
            $('#showclimas').removeClass( "list-history_item" );
            $('#showclimas').addClass( 'active-class' );
            $('#showvines').removeClass( "active-class" );
            $('#showvines').addClass( 'list-history_item_first' );
            $('#showubis').removeClass( "active-class" );
            $('#showubis').addClass( 'list-history_item' );
            $('#showsuelos').removeClass( "active-class" );
            $('#showsuelos').addClass( 'list-history_item' );
           }
    });
    $('#showsuelos').click(function() {
        if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.suelos').slideToggle('fast');
            $('.vineyards').hide();
            $('.climas').hide();
            $('.ubis').hide();
            $('#showsuelos').removeClass( "list-history_item" );
            $('#showsuelos').addClass( 'active-class' );
            $('#showvines').removeClass( "active-class" );
            $('#showvines').addClass( 'list-history_item_first' );
            $('#showclimas').removeClass( "active-class" );
            $('#showclimas').addClass( 'list-history_item' );
            $('#showubis').removeClass( "active-class" );
            $('#showubis').addClass( 'list-history_item' );
           }
    });
    
    $('#showubis').click(function() {
        if($( this ).hasClass( "active-class" )) { 
               return null;
           } else {
            $('.ubis').slideToggle('fast');
            $('.vineyards').hide();
            $('.climas').hide();
            $('.suelos').hide();
            $('#showubis').removeClass( "list-history_item" );
            $('#showubis').addClass( 'active-class' );
            $('#showvines').removeClass( "active-class" );
            $('#showvines').addClass( 'list-history_item_first' );
            $('#showclimas').removeClass( "active-class" );
            $('#showclimas').addClass( 'list-history_item' );
            $('#showsuelos').removeClass( "active-class" );
            $('#showsuelos').addClass( 'list-history_item' );
           }
    });
    
    
    
    
    $(".border-square").click(function() {
  window.location = $(this).find("a").attr("href"); 
  return false;
});


var imgs = $('.banner-adv');//jQuery class selector

  imgs.each(function(){
    var img = $(this);
    var width = img.width(); //jQuery width method
    var height = img.height(); //jQuery height method
    if(width < height){
        img.next().removeClass( 'blog-info' );
        img.next().addClass('on-image');
       
    }else{
        return null;
    }
  });

});  



  $(window).on("load",function(){

    if(!$(document).data("mPS2id")){
      console.log("Error: 'Page scroll to id' plugin not present or activated. Please run the code after plugin is loaded.");
      return;
    }

    $(document).data("mPS2idExtend",{
      selector:".hola",
      currentSelector:function(){
        return this.index($(".mPS2id-highlight-first").length ? $(".mPS2id-highlight-first") : $(".mPS2id-highlight"));
      },
      input:{y:null,x:null},
      i:null,
      time:null
    }).on("scrollSection",function(e,dlt,i){
      var d=$(this).data("mPS2idExtend"),
        sel=$(d.selector);
      if(!$("html,body").is(":animated")){
        if(!i) i=d.currentSelector.call(sel);
        if(!(i===0 && dlt>0) && !(i===sel.length-1 && dlt<0)) sel.eq(i-dlt).trigger("click.mPS2id");
      }
    }).on("mousewheel DOMMouseScroll",function(e){ //mousewheel
      if($($(this).data("mPS2idExtend").selector).length) e.preventDefault();
      $(this).trigger("scrollSection",((e.originalEvent.detail<0 || e.originalEvent.wheelDelta>0) ? 1 : -1));
    }).on("keydown",function(e){ //keyboard
      var code=e.keyCode ? e.keyCode : e.which,
        keys=$(this).data("mPS2id").layout==="horizontal" ? [37,39] : [38,40];
      if(code===keys[0] || code===keys[1]){
        if($($(this).data("mPS2idExtend").selector).length) e.preventDefault();
        $(this).trigger("scrollSection",(code===keys[0] ? 1 : -1));
      }
    }).on("pointerdown touchstart",function(e){ //touch (optional)
      var o=e.originalEvent,
        d=$(this).data("mPS2idExtend");
      if(o.pointerType==="touch" || e.type==="touchstart"){
        var y=o.screenY || o.changedTouches[0].screenY;
        d.input.y=y;
        if($(this).data("mPS2id").layout==="horizontal"){
          var x=o.screenX || o.changedTouches[0].screenX;
          d.input.x=x;
        }
        d.time=o.timeStamp;
        d.i=d.currentSelector.call($(d.selector));
      }
    }).on("touchmove",function(e){
      if($("html,body").is(":animated")) e.preventDefault();
    }).on("pointerup touchend",function(e){
      var o=e.originalEvent;
      if(o.pointerType==="touch" || e.type==="touchend"){
        var y=o.screenY || o.changedTouches[0].screenY,
          d=$(this).data("mPS2idExtend"),
          diff=d.input.y-y,
          time=o.timeStamp-d.time,
          i=d.currentSelector.call($(d.selector));
        if($(this).data("mPS2id").layout==="horizontal"){
          var x=o.screenX || o.changedTouches[0].screenX,
            diff=d.input.x-x;
        }
        if(Math.abs(diff)<2) return;
        var _switch=function(){
            return time<200 && i===d.i;
          };
        $(this).trigger("scrollSection",[(diff>0 && _switch() ? -1 : diff<0 && _switch() ? 1 : 0),(_switch() ? d.i : i)]);
      }
    });

  });
})(jQuery);