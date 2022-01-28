document.addEventListener("DOMContentLoaded", function () {

    let lyrics = document.querySelector("#lyrics")
    let previousLyrics = document.querySelector("#previous-lyrics")
    let nextLyrics = document.querySelector("#next-lyrics")
    let audio = document.querySelector("#audio")
    let title = document.querySelector('#title')
    let body = document.body
    let image = document.querySelector('#img')

    audio.volume = '0.2'

    audio.addEventListener('play', function() {
        title.innerText = 'Warriors'
        title.style.color = 'rgb(119, 19, 19)'
        body.style.backgroundColor = 'rgb(10, 4, 12)'
        image.style.backgroundImage = "url('https://external-preview.redd.it/XLwd-_ijF3LKBoj9uCs2WSzKh6_kmjcqTsTnFb-kryA.jpg?auto=webp&s=4656b1a0db3a1cf16658d0dbe69c636f4692aa5a')"
    })

    audio.addEventListener('pause', function() {
        title.innerText = 'Wario'
        body.style.backgroundColor = 'rgb(101, 33, 122)'
        title.style.color = 'rgb(235, 198, 98)'
        image.style.backgroundImage = "url('https://static.fnac-static.com/multimedia/Images/FD/Comete/143198/CCP_IMG_ORIGINAL/1884667.jpg')"
    })


    fetch("paroles.txt").then(function (response) {

        response.text().then(function (text) {

            let timingRegex = /\d{2}:\d{2}/g // To get the timing of the lyrics
            let lyricRegex = /[A-Z](.*)/g // To get the lyrics of the timing
            let minuteRegex = /\d{2}:/g // To get the minutes from the timingRegex
            let secondRegex = /:\d{2}/g // To get the seconds from the timingRegex

            let timingInLRC = text.match(timingRegex)
            let lyricInLRC = text.match(lyricRegex)

            let timingLyrics = [] // The array will stock timing of currentTime function, in second

            for (i = 0; i < timingInLRC.length; i++) {

                let minutes = timingInLRC[i].match(minuteRegex)
                minutes = parseInt(minutes[0].substring(0,2)) // I only keep numbers and convert string to int

                let seconds = timingInLRC[i].match(secondRegex)
                seconds = parseInt(seconds[0].substring(1,3)) // I only keep numbers and convert string to int

                if (minutes !== 00) {

                    minutes *= 60
                    seconds += minutes
                    timingLyrics.push(seconds)

                } else {

                    timingLyrics.push(seconds)

                }
            }
            
            audio.addEventListener("timeupdate", function () {

                let timeUpdate = (audio.currentTime.toFixed(0)) - 1

                for (let i = 0; i < timingLyrics.length; i++) {

                    if (!(lyricInLRC[-1] in lyricInLRC)) {

                        lyricInLRC[-1] = "..." // In case that the previous lyrics are not defined, it will display this string

                    } else if (!(lyricInLRC[i+1]) in lyricInLRC) {

                        lyricInLRC[i+1] = " "
                    
                    }

                    if (timingLyrics[i] == timeUpdate) {

                        previousLyrics.innerText = lyricInLRC[i-1] // Displays previous lyrics
                        lyrics.innerText = lyricInLRC[i] // Displays current lyrics
                        nextLyrics.innerText = lyricInLRC[i+1] // Displays next lyrics

                    } else if (timingLyrics[i-1] == timeUpdate) {

                        previousLyrics.innerText = lyricInLRC[i-2]
                        lyrics.innerText = lyricInLRC[i-1]
                        nextLyrics.innerText = lyricInLRC[i]

                    } else if (timingLyrics[i-1] == timeUpdate-1) {

                        previousLyrics.innerText = lyricInLRC[i-2]
                        lyrics.innerText = lyricInLRC[i-1]
                        nextLyrics.innerText = lyricInLRC[i]

                    } else if (timingLyrics[i-1] == timeUpdate-2) {

                        previousLyrics.innerText = lyricInLRC[i-2]
                        lyrics.innerText = lyricInLRC[i-1]
                        nextLyrics.innerText = lyricInLRC[i]

                    } else if (timingLyrics[i-1] == timeUpdate-3) {

                        previousLyrics.innerText = lyricInLRC[i-2]
                        lyrics.innerText = lyricInLRC[i-1]
                        nextLyrics.innerText = lyricInLRC[i]

                    }

                    else if (timingLyrics[i+1] == timeUpdate) {

                        previousLyrics.innerText = lyricInLRC[i]
                        lyrics.innerText = lyricInLRC[i+1]
                        nextLyrics.innerText = lyricInLRC[i+2]

                    } else if (timingLyrics[i+1] == timeUpdate+1) {

                        previousLyrics.innerText = lyricInLRC[i]
                        lyrics.innerText = lyricInLRC[i+1]
                        nextLyrics.innerText = lyricInLRC[i+2]

                    } else if (timingLyrics[i+1] == timeUpdate+2) {

                        previousLyrics.innerText = lyricInLRC[i]
                        lyrics.innerText = lyricInLRC[i+1]
                        nextLyrics.innerText = lyricInLRC[i+2]

                    }
                }
            })
        })
    })
})