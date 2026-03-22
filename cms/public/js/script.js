 // the main Toasty function:

 'use strict';

var $bell = document.getElementById('notification');
var $bell1 = document.getElementById('notification1');
var $bell2 = document.getElementById('notification2');
var $bell3 = document.getElementById('notification3');
var $bell4 = document.getElementById('notification4');
var $bell5 = document.getElementById('notification5');
var $bell6 = document.getElementById('notification6');
var $bell7 = document.getElementById('notification7');
$bell.addEventListener("animationend", function(event){
    $bell.classList.remove('notify');
});

 var toasty = new Toasty({
     transition: "fade",
     duration: 0, // calculated automatically.
     enableSounds: true,
     progressBar: false,
     autoClose: true,
     onShow: function (type) {

        //  console.log("a toast " + type + " message is shown!");
     },
     onHide: function (type) {
        //  console.log("the toast " + type + " message is hidden!");
     }
 });

 function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  getNotify();

  function getNotify() {
    var count1 = getCookie("count1") ? getCookie("count1") : 0;
    var count2 = getCookie("count2") ? getCookie("count2") : 0;
    var count3 = getCookie("count3") ? getCookie("count3") : 0;
    var count4 = getCookie("count4") ? getCookie("count4") : 0;
    var count5 = getCookie("count5") ? getCookie("count5") : 0;
    var count6 = getCookie("count6") ? getCookie("count6") : 0;
    var count7 = getCookie("count7") ? getCookie("count7") : 0;
    var count = Number(count1) + Number(count2) + Number(count3) + Number(count4) + Number(count5) + Number(count6) + Number(count7);

    if(Number(count1) !== 0) {
        $bell1.setAttribute('data-count', count1);
        $bell1.classList.add('show-count');
        $bell1.classList.add('notify');
    }
    if(Number(count2) !== 0) {
        $bell2.setAttribute('data-count', count2);
        $bell2.classList.add('show-count');
        $bell2.classList.add('notify');
    }
    if(Number(count3) !== 0) {
        $bell3.setAttribute('data-count', count3);
        $bell3.classList.add('show-count');
        $bell3.classList.add('notify');
    }
    if(Number(count4) !== 0) {
        $bell4.setAttribute('data-count', count4);
        $bell4.classList.add('show-count');
        $bell4.classList.add('notify');
    }
    if(Number(count5) !== 0) {
        $bell5.setAttribute('data-count', count5);
        $bell5.classList.add('show-count');
        $bell5.classList.add('notify');
    }
    if(Number(count6) !== 0) {
        $bell6.setAttribute('data-count', count6);
        $bell6.classList.add('show-count');
        $bell6.classList.add('notify');
    }
    if(Number(count7) !== 0) {
        $bell7.setAttribute('data-count', count7);
        $bell7.classList.add('show-count');
        $bell7.classList.add('notify');
    }
    console.log(Number(count));
    if(Number(count) !== 0) {
        $bell.setAttribute('data-count', count);
        $bell.classList.add('show-count');
        $bell.classList.add('notify');
    }
    $bell1.addEventListener("click", function(event){
        $bell1.setAttribute('data-count', 0);
        setCookie("count1", 0, 1);
        count = 0 + Number(count2) + Number(count3) + Number(count4) + Number(count5) + Number(count6) + Number(count7);
    });
    // $bell2.addEventListener("click", function(event){
    //     $bell2.setAttribute('data-count', 0);
    //     setCookie("count2", 0, 1);
    //     count = Number(count1) + 0 + Number(count3) + Number(count4) + Number(count5) + Number(count6) + Number(count7);
    // });
    $bell4.addEventListener("click", function(event){
        $bell4.setAttribute('data-count', 0);
        setCookie("count4", 0, 1);
        count = Number(count1) + Number(count2) + Number(count3) + 0 + Number(count5) + Number(count6) + Number(count7);
    });
    // $bell5.addEventListener("click", function(event){
    //     $bell5.setAttribute('data-count', 0);
    //     setCookie("count5", 0, 1);
    //     count = Number(count1) + Number(count2) + Number(count3) + Number(count4) + 0 + Number(count6) + Number(count7);
    // });
    $bell6.addEventListener("click", function(event){
        $bell6.setAttribute('data-count', 0);
        setCookie("count6", 0, 1);
        count = Number(count1) + Number(count2) + Number(count3) + Number(count4) + Number(count5) + 0 + Number(count7);
    });
    $bell7.addEventListener("click", function(event){
        $bell7.setAttribute('data-count', 0);
        setCookie("count7", 0, 1);
        count = Number(count1) + Number(count2) + Number(count3) + Number(count4) + Number(count5) + Number(count6) + 0;
    });
  }

 function setToastyPlay(result) {
    var count1 = getCookie("count1") ? getCookie("count1") : 0;
    var count2 = getCookie("count2") ? getCookie("count2") : 0;
    var count3 = getCookie("count3") ? getCookie("count3") : 0;
    var count4 = getCookie("count4") ? getCookie("count4") : 0;
    var count5 = getCookie("count5") ? getCookie("count5") : 0;
    var count6 = getCookie("count6") ? getCookie("count6") : 0;
    var count7 = getCookie("count7") ? getCookie("count7") : 0;
    var count = Number(count1) + Number(count2) + Number(count3) + Number(count4) + Number(count5) + Number(count6) + Number(count7);
    // console.log(result);
    // Create the event.
    var event = document.createEvent('Event');
    // ================================================================
    if (result.napBank == true) {
        count1 = Number(count1) + 1;
        setCookie("count1", count1, 1);
        toasty.bank('Nạp tiền ngân hàng!');
        event.initEvent('Event_rechargebybank', true, true);
        window.dispatchEvent(event);
    }
    if(Number(count1) !== 0) {
        $bell1.setAttribute('data-count', count1);
        $bell1.classList.add('show-count');
        $bell1.classList.add('notify');
    }
    // $bell1.addEventListener("click", function(event){
    //     $bell1.setAttribute('data-count', 0);
    //     setCookie("count1", 0, 1);
    //     count = 0 + Number(count2) + Number(count3) + Number(count4) + Number(count5) + Number(count6) + Number(count7);
    // });
    // ================================================================
    if (result.napOnePay == true) {
        count2 = Number(count2) + 1;
        setCookie("count2", count2, 1);
        toasty.onepay('Nạp tiền 1 PAY!');
        event.initEvent('Event_rechargebyonepay', true, true);
        window.dispatchEvent(event);
    }
    if(Number(count2) !== 0) {
        $bell2.setAttribute('data-count', count2);
        $bell2.classList.add('show-count');
        $bell2.classList.add('notify');
    }
    // $bell2.addEventListener("click", function(event){
    //     $bell2.setAttribute('data-count', 0);
    //     setCookie("count2", 0, 1);
    //     count = Number(count1) + 0 + Number(count3) + Number(count4) + Number(count5) + Number(count6) + Number(count7);
    // });

    // ================================================================
    if (result.napMomo == true) {
        count3 = Number(count3) + 1 || 0;
        setCookie("count3", count5, 1);
        toasty.momo('Nạp Tiền mo mo');
        event.initEvent('Event_rechargebymomo', true, true);
        window.dispatchEvent(event);
    }
    if(Number(count3) !== 0) {
        $bell3.setAttribute('data-count', count3);
        $bell3.classList.add('show-count');
        $bell3.classList.add('notify');
    }
    // $bell3.addEventListener("click", function(event){
    //     $bell3.setAttribute('data-count', 0);
    //     setCookie("count3", 0, 1);
    //     count = Number(count1) + Number(count2) + 0 + Number(count4) + Number(count5) + Number(count6) + Number(count7);
    // });

    // ================================================================
    if (result.napCardPhone == true) {
        count4 = Number(count4) + 1;
        setCookie("count4", count4, 1);
        toasty.theCao('Nạp tiền thẻ cào');
        event.initEvent('Event_rechargebyautocard', true, true);
        window.dispatchEvent(event);
    }
    if(Number(count4) !== 0) {
        $bell4.setAttribute('data-count', count4);
        $bell4.classList.add('show-count');
        $bell4.classList.add('notify');
    }
    // $bell4.addEventListener("click", function(event){
    //     $bell4.setAttribute('data-count', 0);
    //     setCookie("count4", 0, 1);
    //     count = Number(count1) + Number(count2) + Number(count3) + 0 + Number(count5) + Number(count6) + Number(count7);
    // });
    // ================================================================
    if (result.onePayOtp == true) {
        count5 = Number(count5) + 1;
        setCookie("count5", count5, 1);
        toasty.otp('Thông báo Mã OTP');
        event.initEvent('Event_rechargebyonepay', true, true);
        window.dispatchEvent(event);
    }
    if(Number(count5) !== 0) {
        $bell5.setAttribute('data-count', count5);
        $bell5.classList.add('show-count');
        $bell5.classList.add('notify');
    }
    $bell5.addEventListener("click", function(event){
        $bell5.setAttribute('data-count', 0);
        setCookie("count5", 0, 1);
        count = Number(count1) + Number(count2) + Number(count3) + Number(count4) + 0 + Number(count6) + Number(count7);
    });
    // ================================================================

    if (result.rutBank == true) {
        count6 = Number(count6) + 1;
        console.log(count6);
        setCookie("count6", count6, 1);
        toasty.rutTien('Yêu cầu rút tiền qua ngân hàng!');
        event.initEvent('Event_cashoutbybank', true, true);
        window.dispatchEvent(event);
    }
    if(Number(count6) !== 0) {
        $bell6.setAttribute('data-count', count6);
        $bell6.classList.add('show-count');
        $bell6.classList.add('notify');
    }
    // $bell6.addEventListener("click", function(event){
    //     $bell6.setAttribute('data-count', 0);
    //     setCookie("count6", 0, 1);
    //     console.log(123);
    //     count = Number(count1) + Number(count2) + Number(count3) + Number(count4) + Number(count5) + 0 + Number(count7);
    // });
    // ================================================================
    if (result.rutCardPhone == true) {
        count7 = Number(count7) + 1;
        setCookie("count7", count7, 1);
        toasty.rutTien('Yêu cầu rút tiền qua thẻ cào!');
        event.initEvent('Event_cashoutbycardmanual', true, true);
        window.dispatchEvent(event);
    }
    if(Number(count7) !== 0) {
        $bell7.setAttribute('data-count', count7);
        $bell7.classList.add('show-count');
        $bell7.classList.add('notify');
    }
    // $bell7.addEventListener("click", function(event){
    //     $bell7.setAttribute('data-count', 0);
    //     setCookie("count7", 0, 1);
    //     count = Number(count1) + Number(count2) + Number(count3) + Number(count4) + Number(count5) + Number(count6) + 0;
    // });
    // ================================================================

    // if (result.cacheLogin == true) {
    //     console.log('Có khách anh ơi!');
    //     toasty.cokhach('Có khách anh ơi!');
    // }

    // ================================================================
    if(Number(count) !== 0) {
        $bell.setAttribute('data-count', count);
        $bell.classList.add('show-count');
        $bell.classList.add('notify');
    }
    
}

