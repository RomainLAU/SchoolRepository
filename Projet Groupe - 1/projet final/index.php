<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serpentard</title>
</head>
<body>
<style>
    body{
        position:relative;
    }

    #ensemble{
        position: absolute;
        transition-duration: 6s;
    }

    img{
        height: 400px;
        width: 350px; 
    }

    .button{
        margin-left: 50px;
    }
    #span{
        display: none;
        color: green;
        position: relative;
    
    }
    #fois{
        display: none;
    }
    p{
        margin-top: -100px;
        display: flex;
        align-items: flex-end;
        transition-duration: 2s;
    }
    video{
        position: absolute;
        margin-top:-200px;
        transition-duration: 2s;
    }
</style>

    <div id="ensemble">

        <img src="https://jarlstore.fr/29391-large_default/box-serpentard.jpg" alt="logo-serpentard"><br>


        <div class="button">

            <label>Mot de passe : </label><br>
            <input type="password" id="pwd">

        </div>

    </div>

    <video src="https://www.w3schools.com/html/mov_bbb.mp4" controls ></video>
    <script type="text/javascript" src="exercice-pop-up.js"></script>

    <p>le javascript <span id="cest">c'est&nbsp;</span><span id="span">cool </span><span id="fois">&nbsp;des fois</span></p>

    <script>

        let span = document.querySelector("span#span")
        let span2 = document.querySelector("span#fois")
        let p = document.querySelector("p") 
        let cest = document.querySelector("#cest")
        let video = document.querySelector("video")

        // MDP

        let pwd = document.querySelector("#pwd")

        let ensemble = document.querySelector("#ensemble")

        pwd.addEventListener("input", function() {
            console.log(pwd.value)

            if (pwd.value == 'mdp145')
            {
                alert('Bienvenue')

                ensemble.style.marginTop = "-1100px"
                function margin_top () 
                {  
                    video.style.marginTop = "0px"   
                }
                setTimeout(margin_top, 2000)
            }
        })

        // VIDEO

        
        
        video.addEventListener('ended',function(){
            video.style.marginTop = "-200px"
            setTimeout(function (){
            p.style.marginTop = "0px" 
            },2000)
            setTimeout(function(){
                span.style.display = "block"
            },4000) 
            setTimeout(function(){
                cest.style.display = "block"
            },4000)
            setTimeout(function(){
                fois.style.display = "block"
            },6000)
            setTimeout(function(){
                span.style.fontSize = "100px"
                span.style.marginBottom = "-20px"
            },8000)
        
        })
        
        video.addEventListener('volumechange',function(){ alert('le volume change!!!')})

        // TEXTE



    </script>   
</body>
</html>