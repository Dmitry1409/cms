
var final_transcript = '';
var recognizing = false;
let final_fild
// let voiceBlob
// let mediaRecorder
// let voice = []

function voice_down(){
	let mic = document.querySelector(".animation-outer")
	mic.classList.add("mic_record")
	// if (recognizing) {
	//   recognition.stop();
	//   return;
	// }
	final_transcript = '';
	recognition.lang = 'ru-RU';
	final_fild = document.querySelector('.voice_fild_insert_id')
	recognition.start();
	final_fild.innerHTML = '';
	

}
function voice_up(){
	let mic = document.querySelector(".animation-outer")
	mic.classList.remove('mic_record')

}


if (('webkitSpeechRecognition' in window)) {
    
  var recognition = new webkitSpeechRecognition();
  recognition.continuous = true;
  recognition.interimResults = false;

  recognition.onstart = function() {
    recognizing = true;

} 

  recognition.onresult = function(event) {
    for (var i = event.resultIndex; i < event.results.length; ++i) {
      if (event.results[i].isFinal) {
        final_transcript += event.results[i][0].transcript;
      }
    }
    final_transcript = capitalize(final_transcript);
    final_fild.innerHTML = final_transcript
    recognizing = false
  };
}

var first_char = /\S/;
function capitalize(s) {
  return s.replace(first_char, function(m) { return m.toUpperCase(); });
}


// function media_rec_stop(){
// 	mediaRecorder.stop();
// }

// function media_rec_start(){
// 	voice = []
// 	 mediaRecorder.start();
// }

// navigator.mediaDevices.getUserMedia({ audio: true})
//     .then(stream => {
//      mediaRecorder = new MediaRecorder(stream);       

// 	 mediaRecorder.addEventListener("dataavailable",function(event) {
// 	    voice.push(event.data);
// 	    voiceBlob = new Blob(voice, {type: 'audio/wav'});

// 	 });
//  });
