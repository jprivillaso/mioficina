/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    
    $(function(){
        initApplication();
    });
    
});

//__VARS __//
var myPlayer = _V_("video-canvas");

var classController = function(){
    //vars
}

classController.prototype = {
    
    initEvents: function(){
        
        myPlayer.addEvent("timeupdate", function(){
            var currentTime = myPlayer.currentTime();
            var buffered = myPlayer.bufferedPercent();
            if(buffered > 0){
                if(currentTime > 0.2){                    
                    instanceController.hideVideoImageFront();
                }
            }
        });
        
        myPlayer.addEvent("ended", function(){
           instanceController.showPlayButton();
           instanceController.hideVideoImageFront();
           instanceController.hideVideoZone();
        });
        
        $('#buttonPlayVideo').bind('click', function(){
            myPlayer.play();
            instanceController.showVideoImageFront();
            instanceController.showVideoZone();
            instanceController.hidePlayButton();
        });
    },
    
    showPlayButton: function(){
        $('#imgPlayVideo').show();
    },
    
    hidePlayButton: function(){
        $('#imgPlayVideo').hide();
    },
    
    showVideoZone: function(){
        $('#videoZone').show();
    },
    
    hideVideoZone: function(){
        $('#videoZone').hide();
    },
    
    hideVideoImageFront: function(){
        $('#videoFront').hide();
    },
    
    showVideoImageFront: function(){
        $('#videoFront').show();
    },
    
    _main : function(){
        instanceController.initEvents();
    }
}


var instanceController = new classController();

///___MAIN___///
function initApplication(){
    instanceController._main();
}