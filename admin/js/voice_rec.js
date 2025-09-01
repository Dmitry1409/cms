let voiceBlob
let mediaRecorder
let voice = []


function media_rec_stop(){
	mediaRecorder.stop();
}

function media_rec_start(){
	voice = []
	 mediaRecorder.start();
}

navigator.mediaDevices.getUserMedia({ audio: true})
    .then(stream => {
     mediaRecorder = new MediaRecorder(stream);       

	 mediaRecorder.addEventListener("dataavailable",function(event) {
	    voice.push(event.data);
	    voiceBlob = new Blob(voice, {type: 'audio/wav'});

	 });
 });
