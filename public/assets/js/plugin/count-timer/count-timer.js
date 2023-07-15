// grab the .countdown
const countDown = document.querySelector('#countdown');

/* global variables and constants*/
// variable to store setInterval
let countDownInterval;

// secondsLeft in millisecond
let secondsLeftms;
// end time
let endTime;

function iniciarTemporizador() {
  // get the countdown time user typed
  let countDownTime = 10;

  const format = "minutes";

  // check if it is not zero
  if (countDownTime > 0) {
    // check which is the format, ie the <select> element's value
    if (format === 'hours') {
      // convert hours to milliseconds
      // 1 hrs = 3600000 ms (5 zeros)
      countDownTime = countDownTime * 3600000;
    } else if (format === 'minutes') {
      // 1 minute = 60000 ms (4 zeros)
      countDownTime = countDownTime * 60000;
    } else if (format === 'seconds') {
      // 1 seconds = 1000 ms (3 zeros)
      countDownTime = countDownTime * 1000;
    }

    // get current time in milliseconds
    const now = Date.now();
    // calculate the ending time
    endTime = now + countDownTime;

    // activate the countdown at first
    setCountDown(endTime);

    countDownInterval = setInterval(() => {
      setCountDown(endTime);
    }, 1000);
  }
}  


/* setCountDown function */
function setCountDown(endTime) {
  // calculate how many milliseconds is left to reach endTime from now
  secondsLeftms = endTime - Date.now();
  // convert it to seconds
  const secondsLeft = Math.round(secondsLeftms / 1000);

  // calculate the hours, minutes and seconds
  let hours = Math.floor(secondsLeft / 3600);
  let minutes = Math.floor(secondsLeft / 60) - (hours * 60);
  let seconds = secondsLeft % 60;

  // adding an extra zero infront of digits if it is < 10
  if (hours < 10) {
    hours = `0${hours}`;
  }
  if (minutes < 10) {
    minutes = `0${minutes}`;
  }
  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  // stopping the timer if the time is up 
  if (secondsLeft < 0) {
    resetCountDown();
    return;
  }

  // set the .countdown text
  countDown.innerHTML = `${hours} : ${minutes} : ${seconds}`;
}
/* setCountDown function ends */

/* resetCountDown function */
function resetCountDown(){
  // destroy the setInterval()
  clearInterval(countDownInterval);
  // reset the countdown text
  countDown.innerHTML = '00 : 00 : 00';
}
