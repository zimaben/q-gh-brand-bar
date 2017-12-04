/*/  
 * $ Calls v0.9 ##
 * (c) 2012 Q Studio - qstudio.us
/*/

/*/ EACH TIME BRAND BAR UPDATES THIS MUST BE UPDATED MANUALLY - TOOL HERE - https://www.textfixer.com/tools/remove-line-breaks.php /*/
var mini_html_desktop = '<div class="widget widget-brand-bar brand-bar wrapper-outer desktop"> <ul class="wrapper-inner wrapper-padding"> <li class="greenheart"> <a href="https://www.greenheart.org/" target="_blank" title="greenheart"> greenheart </a> </li> <li class="greenheart-exchange"> <a href="https://www.greenheartexchange.org/" target="_blank" title="exchange"> exchange </a> </li> <li class="greenheart-travel"> <a href="https://www.greenhearttravel.org" target="_blank" title="travel"> travel </a> </li> <li class="greenheart-shop"> <a href="http://www.greenheartshop.org" target="_blank" title="shop"> shop </a> </li> <li class="greenheart-transforms"> <a href="http://www.greenhearttransforms.org" target="_blank" title="transforms"> transforms </a> </li> <li class="donate"> <a href="https://greenheart.org/donate" target="_blank" title="Donate"> Donate </a> </li> </ul> </div>';
var mini_html_handheld = '<div class="widget widget-brand-bar brand-bar wrapper-outer handheld"> <ul class="wrapper-inner wrapper-padding"> <li class="greenheart"> <a href="https://www.greenheart.org/" target="_blank" title="greenheart"> greenheart </a> </li> <li class="greenheart-exchange"> <a href="https://www.greenheartexchange.org/" target="_blank" title="exchange"> exchange </a> </li> <li class="greenheart-travel"> <a href="https://www.greenhearttravel.org" target="_blank" title="travel"> travel </a> </li> <li class="greenheart-shop"> <a href="http://www.greenheartshop.org" target="_blank" title="shop"> shop </a> </li> <li class="greenheart-transforms"> <a href="http://www.greenhearttransforms.org" target="_blank" title="transforms"> transforms </a> </li> <li class="donate"> <a href="https://greenheart.org/donate" target="_blank" title="Donate"> Donate </a> </li> </ul> <ul class="branches-open"> <div class="branches-close"></div> <li class="greenheart"> <a href="https://www.greenheart.org/" target="_blank" title="greenheart"> greenheart </a> </li> <li class="greenheart-exchange"> <a href="https://www.greenheartexchange.org/" target="_blank" title="exchange"> exchange </a> </li> <li class="greenheart-travel"> <a href="https://www.greenhearttravel.org" target="_blank" title="travel"> travel </a> </li> <li class="greenheart-shop"> <a href="http://www.greenheartshop.org" target="_blank" title="shop"> shop </a> </li> <li class="greenheart-transforms"> <a href="http://www.greenhearttransforms.org" target="_blank" title="transforms"> transforms </a> </li> <li class="donate"> <a href="https://greenheart.org/donate" target="_blank" title="Donate"> Donate </a> </li> <li class="greenheart"><a href="https://www.greenheart.org" target="_blank" title="Greenheart International"></a></li> </ul> </div>';

function GreenheartBrandBar( target ){
    this.targetElement = target;               
    this.addBar = function(){
       if(this.targetElement !== null && typeof this.targetElement == 'string' && this.targetElement.length > 1 ){
        if(this.targetElement.substring(0,1) == '.'){
            var DOM_target = this.targetElement.substring(1);
            var header = document.getElementsByClassName( DOM_target )[0]; }
            else if(this.targetElement.substring(0,1) == '#'){
                DOM_target = this.targetElement.substring(1);
                var header = document.getElementById( DOM_target );
            }
            else {
                var header = document.getElementsByTagName( this.targetElement )[0];
            }
        var section = document.createElement("section");
        section.classList.add("gh-global-header");
        section.innerHTML = mini_html_desktop + mini_html_handheld;
        header.insertBefore( section, header.childNodes[0] );
        //header.appendChild( section );
     } else { return false; }
    return false;
    }
}
