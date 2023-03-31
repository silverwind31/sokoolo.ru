! function r(e, o, i) {
    function t(n, l) {
        if (!o[n]) {
            if (!e[n]) {
                var a = "function" == typeof require && require;
                if (!l && a) return a(n, !0);
                if (s) return s(n, !0);
                var u = new Error("Cannot find module '" + n + "'");
                throw u.code = "MODULE_NOT_FOUND", u
            }
            var c = o[n] = {
                exports: {}
            };
            e[n][0].call(c.exports, function(r) {
                var o = e[n][1][r];
                return t(o ? o : r)
            }, c, c.exports, r, e, o, i)
        }
        return o[n].exports
    }
    for (var s = "function" == typeof require && require, n = 0; n < i.length; n++) t(i[n]);
    return t
}({
    1: [function(r, e, o) {
        "use strict";
        $(function() {
            $(".multiple-items.multiple-items_scrolling").slick({
                    infinite: !0,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    nextArrow: '<div class="multiple-items__arrow multiple-items__arrow_right"><img src="./img/arrow_Right.png"></div>',
                    prevArrow: '<div class="multiple-items__arrow multiple-items__arrow_left"><img src="./img/arrow_Left.png"></div>',
                    customPaging: function(r, e) {
                        return "<span></span>"
                    },
                    responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            dots: !0
                        }
                    }, {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: !0
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: !0
                        }
                    }]
                }),
                $(".btns-groups a").on("click", function(event) {
                    event.preventDefault();
                    var id = $(this).attr('href'),
                        top = $(id).offset().top - 140;
                    console.log('top', top);
                    $('body,html').animate({
                        scrollTop: top
                    }, 1500);
                });
        })
    }, {}]
}, {}, [1]);

$(document).ready(function() {

  $(".header__toggle").click(function(){
      $(".header__nav").toggleClass("openToggle")
      $("body").toggleClass("openToggle")
  })

  function fixHeader() {
    if ( $(window).scrollTop() > 0 ) {
      $(".block-header").addClass("block-header_fixed");
    } else {
      $(".block-header.block-header_fixed").removeClass("block-header_fixed");
    }
  }

  $(window).scroll(function(){
    // if ( !scrolling ) {
    //   var scrolling = window.setTimeout(function(){
        fixHeader();
    //   }, 100);
    // }
  })

  fixHeader();


  // ajax


  $(".ajax-form").submit(function(){
    var form = $(this);
    var data = form.serialize();
    
    $.ajax({
       type: 'POST',
       url: 'mailer.php',
       dataType: 'json',
       data: data,
          beforeSend: function(data) {
              form.find('input[type="submit"]').attr('disabled', 'disabled');
          },
          success: function(data){
            console.log(data['error']);
            if ( !data['error'] ) {
              alert("Спасибо, ваш запрос успешно отправлен! Скоро мы выйдем на связь. Для оперативного ответа напишите нам в WhatsApp +79370922000")
              form.find("input[type=text], textarea").val("")
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alert("Произошла какая-то дичь! Попробуйте позже.")
          },
          complete: function(data) {
              form.find('input[type="submit"]').prop('disabled', false);
          }
    });
    
    return false;
  });

  function formatDate(date) {

    var dd = date.getDate();
    if (dd < 10) dd = '0' + dd;
  
    var mm = date.getMonth() + 1;
    if (mm < 10) mm = '0' + mm;
  
    var yy = date.getFullYear();
    if (yy < 10) yy = '0' + yy;

    var hh = date.getHours();
    if (hh < 10) hh = '0' + hh;

    var min = date.getMinutes();
    if (min < 10) min = '0' + min;
  
    return dd + '.' + mm + '.' + yy;
  }
  
  var d = new Date();
  
  var salt = 'text8989';
  formatDate(d);
  let code = document.querySelector('#code'); // Получаем скрытый input
  document.querySelector('#form-popup-btn').onclick = function(){ // Клик по кнопке отправки
    code.value =  salt; // Подставляем значение в value инпута
  };

  let codeTwo = document.querySelector('#code_2'); // Получаем скрытый input
  document.querySelector('#form-callback-btn').onclick = function(){ // Клик по кнопке отправки
    codeTwo.value = salt; // Подставляем значение в value инпута
  };

  $(".multiple-items__item__link").click(function(){
    var rosename = $(this).attr("data-rose-name");
    $('input[name="item"]').val(rosename);
    $('#roseName span').html(rosename);
  })


  $('input[name=phone]').maskinp("+9 (999) 999-99-99");



  // custom popups


  $(".custom-popup-trigger").click(function(){
    var popupName = $(this).attr("data-popup");
    var popupWrapper = $(".popup-bg" + popupName)
    var popupContent = popupWrapper.find(".form-main");

    popupWrapper.fadeIn(200);
    popupContent.css({
      "top": $(window).scrollTop() + $(window).height() / 2,
      "marginTop": (-popupContent.outerHeight() / 2 ) + "px",
      "left": ($(window).width() - popupContent.width()) / 2
    })

    $("html, body").addClass("active-popup");
    return false;
  })


  $(".close-popup-trigger").click(function(){
    $(".popup-bg").fadeOut(400);
    $("html, body").removeClass("active-popup");
    return false;
  })






});


/*
* This sample uses a custom control to display the SaveWidget. Custom
* controls can be used in place of the default Info Window to create a
* custom UI.
* This sample uses a Place ID to reference Google Sydney. Place IDs are
* stable values that uniquely reference a place on a Google Map and are
* documented in detail at:
* https://developers.google.com/maps/documentation/javascript/places#placeid
*/

function initMap() {
var map = new google.maps.Map(document.getElementById('google-map'), {
  zoom: 17,
  center: {lat: 48.727961, lng: 44.5260071},
  mapTypeControlOptions: {
    mapTypeIds: [
      'roadmap',
      'satellite'
    ],
    position: google.maps.ControlPosition.BOTTOM_LEFT
  }
});


  var contentString = '<div id="mapPopup"><div class="title"><span>THE</span>ROSE</div><div class="content">Волгоград, улица Селенгинская, д.11 оф 1 (Напротив маг "Пятерочка") </div><div class="worktime">тел.: +7(961)6973472 (WhatsApp)</div></div>';

  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

  var marker = new google.maps.Marker({
    position: {lat: 48.727961, lng: 44.5260071},
    map: map,
    title: 'Uluru (Ayers Rock)'
  });

  infowindow.open(map, marker);

  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });




}