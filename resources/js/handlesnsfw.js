function init(){
    var myModal = new bootstrap.Modal(document.getElementById('nsfwModal'), {});
    var timer = document.getElementById("timer");
    var linkAddress = "";

    //Apply a modal with a countdown of 10 seconds for links NSFW
    var handleNsfwLinks = function(){
        //Get the links
        var nsfwLinks = document.getElementsByClassName('handlesNSFW');

        //Event function of the NSFW behavior
        var handleNSFW = function(e){
            var isNsfw = this.getAttribute('data-nsfw');
            linkAddress = this.getAttribute('href');
            var modalButtonRedirect = document.getElementById('modalLinkRedirect');

            //Set up the redirect button in the modal
            modalButtonRedirect.setAttribute('href', linkAddress)

            if (isNsfw == 1){
                e.preventDefault();
                myModal.show();
                handleCountdown();
            }
        };

        //Apply the nsfw event for all the shortened links
        for (var i = 0; i < nsfwLinks.length; i++)
        {
            nsfwLinks[i].addEventListener("click", handleNSFW);
        }
    }();

    //Handles the countdown
    var handleCountdown = function(){
        var countdownSeconds = 10;
        var elapsed = 0;

        // Update the count down every 1 second
        var timerInterval = setInterval(function() {
            //If the modal is closed It will assume the user don't want to be redirected
            if (! myModal._isShown) {
                timer.innerHTML = "10 seconds";
                clearInterval(timerInterval);
            }
            else {
                elapsed++;

                //Decrease the seconds
                var seconds = countdownSeconds - elapsed;
                var plural = 's';

                if (seconds >= 0){
                    //Change the timer text
                    timer.innerHTML = seconds + " second" + (seconds > 1 ? plural : "");
                }

                // If the count down is finished
                if (seconds < 0) {
                    clearInterval(timerInterval);
                    window.location.href = linkAddress;
                }
            }
        }, 1000);
    }
}

window.addEventListener('load', function () {
    init();
})
