@extends('layouts.main')

@section('header')
    @include('partials.header', ['class' => 'absolute'])
@endsection

@section('content')
    <section id="upload-scanner_register" class="">
        <div class="bg_1"></div>
        <div class="container">
            <div class="bg_2"></div>
            <div class="bg_3"></div>
            <div class="content">

                    <h2 class="title">{!! __('scanner.scan_file.scanner_h2_1', ['brand' => $scanner_type.'<sup>®</sup>']) !!}</h2>
                    <h2 class="text">{!! __('scanner.scan_file.scanner_h2_2', ['brand' => $scanner_type.'<sup>®</sup>']) !!}</h2>

                <div class="scanner-hold">
                    <div class="scanner-hold" style="background: white; border-radius: 5px; z-index: 4;position: relative;cursor: pointer;">
                        <form action="{{ url('scanner/storeFile') }}" method="post" class="drop-zone" enctype="multipart/form-data" id="screenshot_form" >
                            @csrf
                            <input type="hidden" name="scanner_type" value="{{ $scanner_type }}">
                            <input type="hidden" name="prize" value="{{ $prize }}">
                            <div class="fallback">
                                <input type="file" name="screenshot" id="screenshot_input" style="visibility: hidden">
                            </div>
                            <p class="dz-message"><img src="{{ url('i/photo.png') }}" alt=""><span>{!! __('texts.scanfile_drop') !!}</span></p>
                        </form>

                    </div>

                    <a href="#" class="upload-bill button">{!! __('scanner.scan_file.scanfile_send') !!}</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@section('modals')
    @include('partials.modals')
@endsection

@section('scripts')

    <script type="text/javascript">
        $('document').ready(() => {
            var messages = {};
            var lang = '{{ App::getLocale() }}';
            if(lang == 'ru'){
                messages = {
                    'bill_upload_p': '<br>Перетяни в эту область фото или <br> нажми, чтобы выбрать файл с устройства',
                    'bill_upload_error' : 'Ошибка - ',
                    'bill_upload_cancel': 'Возникла ошибка при загрузке файла! \n Попробуйте еще раз!',
                    'bill_chosen': 'Вы выбрали файл: ',
                    'required': 'Это обязательное поле',
                    'phone_empty': '<label for="" class="error">Введите номер</label>',
                    'no_data': 'Нет данных',
                    'city': 'Выберите город',
                    'loading': 'Загрузка... Ожидайте...',
                    'default' : "Оправить"
                };
            }else {
                messages = {
                    'bill_upload_p': '<br>Құрылғыдан файл таңдау үшін суретті <br> осы жерге әкел немесе осы жерді бас',
                    'bill_upload_error' : 'Қате - ',
                    'bill_upload_cancel': 'Файлды жүктеу кезінде қате пайда болды! \n Тағы да қайталап көріңіз!',
                    'bill_chosen': 'Сіз файлды таңдадыңыз: ',
                    'required': 'Бұл міндетті өріс.',
                    'phone_empty': '<label for="" class="error">Нөмірді енгізіңіз</label>',
                    'no_data': 'Мәлімет жоқ',
                    'city': 'Қаланы таңдау...',
                    'loading': 'Жүктелуде... КҮТІҢІЗ...',
                    'default' : "Жүктеу"
                };
            }



            Dropzone.options.screenshotForm = {
                uploadMultiple: false,
                parallelUploads: 1,
                maxFilesize: 10,
                acceptedFiles: 'image/*',
                resizeWidth: 2000,
                addRemoveLinks: false,
                autoProcessQueue:false,
                required:true,
                paramName: 'screenshot',
                createImageThumbnails: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

                accept: function(file, done){
                    $('#screenshot_form p span').html(messages.bill_chosen + file.name).css('color', '#ff2227');
                    $('#screenshot_form').css('border', '1px solid transparent');
                    $('#screenshot_form .dz-message img').attr('src', '{{ url('i/photo-activen.png') }}');
                    done();
                }
            };

            if($('#screenshot_form').length){
                var billzone = new Dropzone('#screenshot_form');

                billzone.on("sending", function (file) {
                    $('.upload-bill').text(messages.loading);

                })


                billzone.on('success', (file, response) => {

                    if(response != "1")
                    {
                        $('[data-remodal-id=rm-scanner-wrong]').remodal().open();

                    }else{
                        window.location.href = '{{ url('scanner/success/'.$prize) }}';

                    }

                    $('#screenshot_form p span').html(messages.bill_upload_p).css('color', 'rgba(0, 0, 0, 0.5)');
                    billzone.removeAllFiles();
                    $('.upload-bill').text(messages.default);


                });

                billzone.on('canceled', function(){
                    alert(messages.bill_upload_cancel);
                    $('.upload-bill').text(messages.default);
                });

                billzone.on('error', (file, errorMessage) => {
                    alert(messages.bill_upload_error + errorMessage);
                    billzone.removeAllFiles();
                    $('.upload-bill').text(messages.default);
                });

                $('.upload-bill').click((e) => {
                    e.preventDefault();
                    billzone.processQueue();
                });
            }
        })
    </script>
@endsection
