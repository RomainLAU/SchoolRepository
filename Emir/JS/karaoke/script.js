document.addEventListener("DOMContentLoaded", function () {

    let lyrics = document.querySelector("#lyric")
    let audio = document.querySelector("#audio")

    fetch("paroles.txt").then(function (response) {
        response.text().then(function (text) {
            let timingRegex = new RegExp('\[(.*)\]', 'm') // To get the timing of the lyric
            let lyricRegex = new RegExp('[A-Z](.*)', 'm') // To get the lyric of the timing
            audio.addEventListener("timeupdate", function () {
                let timing = audio.currentTime.toFixed(2)
                if (timing >= 10 && timing < 60) {
                    timing = "00:" + timing
                }
                if (timing < 60) {
                    timing = "00:0" + timing
                }
                if (timing >= 60 && timing < 70 || timing >= 120 && timing < 130 || timing >= 180 && timing < 190) {
                    minutes = Math.floor(timing / 60)
                    seconds = timing - minutes * 60
                    timing = "0" + minutes + ":0" + seconds.toFixed(2)
                }
                if (timing >= 70 && timing < 120 || timing >= 120 && timing < 180 || timing >= 180 && timing < 240) {
                    minutes = Math.floor(timing / 60)
                    seconds = timing - minutes * 60
                    timing = "0" + minutes + ":" + seconds.toFixed(2)
                }
                var myTiming = timingRegex.exec(timing)
                console.log(myTiming)
                // console.log(timing)
            })
        })
    })

    // let body = document.querySelector("body")

    // body.style.backgroundColor = "darkblue"
})