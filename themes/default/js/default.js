(function(){


    //Index'i 1 olanu şecer
    $('.location-block').eq(1).append('Selam');
    //$('.location-block:eq(1)').append('Selam')
    
    //Tüm p'lerden .foo1 class'ılı olanı şeç    
    $('p').filter('.foo1').append(' Ben Filterr!');


    //Tüm p'lerden .foo1 olmayanı şeç
    $('p').not('.foo1').append(' Ez Not(); ');

    //ILK p'yi seçer
    $('p').first().append('Selam ben FIRST(); ');

    //,Son p'yi seçer
    $('p').last().append('Selam ben LAST(); ');

    // içerisinde span olan tüm p'leri seçç
    $('p').has('span').append('Ben HASSSSS');

    // p'nin foo classı varsa true yada folse Döndndürür
    $('p').is('.foo');
        
    //Slice tüm p'leri seçer. 0'dan başlayarak 2'tane seçtikten sonra append işlemini yapar..
    $('p').slice(0,2).append('Selam BEN SLICE(); ');

    //Son 2 elementi seçer
    //$('p').slice(-2).append('Selam BEN SLICE(); '); 
    
    //Çocuk taglarını seçer
    $('p').children().append('Selam BEN CHILDRENNNN');
    //$('p').children('strong').append('Selam BEN CHILDRENNNN STRONGAAAA');

    //p tagını seçer ve ebeven ilk div'i seçer ve seçmeyi bittirir. parent() seçer ve seçmeyi devam ettirir.
    $('p').closest('div').append('SELAMMMm BEN CLOSEST');

    //Seçilen tagın içinde belirtilen tüm childeren elementleri seçer. 
    //Childreden farkı; Children 1 level aşağı iner find ise tüm level yani torunları seçer
    $('p').find('span').append('SELAM BEN FIND!');

    //seçilen divden sonra gelen ilk elementi seçer
    $('.closest').next().append('SELAM BEN NEXXXXXXXXTTTT()');

    //Seçilen elementen sonra gelen tüm elemenleri seçer
    $('.closest').nextAll('p').append('SELAM BEN NEXXXXXXXXTTTTalllll()');
    //$('.closest').nextAll('a').append('SELAM BEN NEXXXXXXXXTTTTalllll()');
    
    //a .closest divinden başlayacak a divin bulduğu yere kadar seçer. A haric!
    $('.closest').nextUntil('a').append('SELAM BEN NEXXXXXXXXTTTTuntillll()');

    //Seçilen tagdan hemen önceki belirtilen elementi seçer
    $('a').prev('p').append('BENNNN PREVVVV BIR USTT!');

    //Adan başlayacak yukarı doğru tüm peri seçer
    $("a").prevAll('p').append('BEN PREVVV ALLL TUM HER ŞŞEYİ SEÇEERİMM');

    //Adan başlayacak yukarı doğru ilk foo'ya tüm p'leri seçer
    $("a").prevUntil('p').append('BEN PREVVV UNTIL ILK .FOO ya kadar şeçerimmm');
    
    //Kardeş'leri çekerrrr Yana yana olan elementler
    $('button').siblings('button').append('SELAMMMMM BEN SIBLINGS!');

    //Evebeyni seçer ilk
    $('span').parent().append('<span style="color: red">BENNN PARENNNT</span>');
    
    //Tüm parent'leri seçer
    $('span').parents("div").append('<span style="color: blue">BENNN PARENNNTS</span>');

    //Belirtilen class'a kadar seçerr
    $('span').parentsUntil('.closest').append('<span style="color: yellow">BENNN PARENNNTS</span>');

    //p taglarını seçer ve selam classlı bir table atar.
    $('p').add('<table class="selam"><tr><td>SELAMMMMM TABLEE ADD()</td></tr></table>');

    //A'yı şçer ve daha sonra span bulur içinde. Bu normal. Normalde find'ten sonra appen'tin yapacağı iş SELAMMMMMMM NABERRR yacaktı.
    //Ama eğer bir hem a'ya hemde seçilen spanlara aynı işlemi uygulamak istiyorsa andSelf'i kullanırız
    // 
    $('a').find('span').andSelf().append('SELAMMMMMMM NABERRR');

    //A değerinin içindekileri alır
    console.log($('a').contents());

    //p.foo3 yi seçer daha sonra spanı seçer ve geri dönmek yani f.foo3'yi seçemek için end() kullanırız.
    $('p.foo3').find('span').end().append('SELAMMMMM BEN ENNNNDDDDD');

    //Tagın : Öncesine ekler
    $('i').after('<p>AFTER : SELAMMMMM</p>');
        //$('i').insertAfter('<p>AFTER : SELAMMMMM</p>'); Aynı

    //Tagın : Sonrasına ekler
    $('i').before('<p>BEFORE : SELAMMMMM</p>');
        //$('i').insertBefore('<p>BEFORE : SELAMMMMM</p>'); Aynı

        //Tag içinde başa ekler
    $('i').prepend('SELAMMMMMMMM <strong>PREPEND</strong>');

        //tag içinde sona ekler
    $('i').append('SELAMMMMMMMM <strong>APPEND</strong>');

    //i tagını h1 ile çerceveler
    $('i').wrap('<h1/>');

    //p'e oluşturur ve body'nın başına ekler
    $('<p>',{
        text: 'KAdınlar Kadınlar Daglara doğru'
    }).prependTo('body');

    //p'e oluşturur ve body'nın sonuna ekler
    $('<p>',{
        text: 'KAdınlar Kadınlar Daglara doğru'
    }).appendTo('body');

    //U'yi seçer ve callback çağırır. Burada eğer u selam clasına sahipse h2 değil ise h6 içne alır
    $('u').wrap(function(){
        return $(this).is('.selam') ? "<h2>" : '<h6>';
    });
    
    //u'yi çerçeveleyeni isler.
    $('i').unwrap();

    var div = $('<div />',{
        css:{'background':'red'}
    });
    $('i').wrapAll(div);

    //P'nin içini em ile kaplar
    $('p').wrapInner('<em>');

    //Nesneyi kaldırır
    //$('u').remove();
    
    //Kaldırdığı element içindeki değeri alır.
    //return eder
    $("p:first").data("test","This is some data.");
    var p = $("p:first").detach();
    console.log("Data stored: "+p.data("test"));

    //elementin değerini almak için kullanılır
    var id = $('small:first').attr('id');
    $('body').append(id);

    //Değer atatar..
    $('small:last').attr('id','selam23');

    //alternatif kullanım.
    $('small:last').attr({
        id: 'SElam',
        title: 'Ez Small Ji Attr hatım'
    });

    $("a").removeAttr('id');

})();





