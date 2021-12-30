let video = document.querySelector("video")
function margin_top () 
    {  
      video.style.marginTop = "0px"   
    }
   setTimeout(margin_top, 2000)
  
   video.addEventListener('ended',function(){video.style.marginTop = "-200px"})
  
video.addEventListener('volumechange',function(){ alert('le volume change!!!')})
  
  //video.addEventListener('volumechange',function(){ alert('le volume change!!!')})
   //premier argument

   // exécute le message d'accueil après 2000 millisecondes (2 secondes)




/*let video = document.querySelector("video")
setTimeoutfunction(function(video_margin_top)//premier argument
    {
        carre.style.marginTop = "-175px"
        
    }, 2000)//temp de transition avant l'ensement du 2iem
    animation()*/