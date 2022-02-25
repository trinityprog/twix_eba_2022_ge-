    var scanfail = setInterval(function () { $('[data-remodal-id=rm-scanner-wrong]').remodal().open(); }, 15000);

    let loop_delayer = 0;
    let nav = navigator.mediaDevices;
    //let navum = navigator.mediaDevices.getUserMedia;

    var percentage = 0.70;

    const URL = '/ml/twix/';
    var lettri = 0, delay = 0;
    let model, webcam, labelContainer, maxPredictions;

    var screencanvas = document.getElementById('hiddencanvs');
    var screencontext = screencanvas.getContext('2d');
    var w, h, ratio, countdown = 10;


    var scannerctdinterval = setInterval(function () {
        countdown--;
        if(countdown == 0){ clearInterval(scannerctdinterval); }
    }, 1000);



    init();


    async function init() {

        const modelURL = URL + 'model.json';

        model = new cvstfjs.ClassificationModel();
        await model.loadModelAsync(modelURL);

        webcam = document.querySelector('.advancedCam');

        webcam.addEventListener('loadedmetadata', function() {
            ratio = webcam.videoWidth / webcam.videoHeight;
            w = webcam.videoWidth - 100;
            h = parseInt(w / ratio, 10);
            screencanvas.width = w;
            screencanvas.height = h;
        }, false);

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
        {
            const webCamPromise = navigator.mediaDevices
                .getUserMedia({
                    audio: false,
                    video: {
                        facingMode: 'environment',
                    }

                })
                .then(stream => {
                    window.stream = stream;
                    var v = document.querySelector('.advancedCam');
                    v.srcObject = stream;

                    setInterval(function () { loop(); }, 500);


                    return new Promise((resolve, _) => {
                        v.onloadedmetadata = () => {
                            resolve();
                        }
                    });
                })
                .catch(function(err) {
                    $('[data-remodal-id=rm-scan-camera]').remodal().open();
                });

            setTimeout(function () { delay = 1; },1000);

        }
        else{
            $('[data-remodal-id=rm-scan-camera]').remodal().open();
        }

    }

    async function loop() {
        try {
            await predict();
        }catch (e) {

        }
    }

    var predicted_number = 0;

    async function predict()
    {
        const result = await model.executeAsync(webcam);

        $('#label-container').text(result[0][0].toFixed(2)+" "+result[0][1].toFixed(2)+" "+result[0][1].toFixed(2));

        if(result[0][2].toFixed(2) >= percentage)
        {
            if(predicted_number > 2 && lettri == 0)
            {
                screencontext.fillRect(0, 0, w, h);
                screencontext.drawImage(webcam, 0, 0, w, h);
                var data = screencanvas.toDataURL('image/png');


                $('#screenshot_input').attr('value', data);
                $('#screenshot_form').submit();
                lettri++;

            }
            predicted_number++;
        }
        // if(result[0][0].toFixed(2) >= 0.02 || result[0][2].toFixed(2) >= 0.02){
        //     predicted_number = 0;
        // }

    }


    function hideScannerAndRunFileWithMessage(text = "", redirect = true) {
        clearInterval(scannerctdinterval);
        $('.scanner h2').html(text);
        if(redirect == true)
        {
            window.location.href = "/scanner/file";
        }
    }


