<div>
    <div class="header_section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo"><a href="#"><img src="images/logo.png" style="width: 100px;"></a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a style="cursor: pointer;" class="nav-link" href="#">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a style="cursor: pointer;" class="nav-link" onclick="desplazar('s1')">Acerca</a>
                    </li>
                    <li class="nav-item">
                        <a style="cursor: pointer;" class="nav-link" onclick="desplazar('s2')" >Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a style="cursor: pointer;" class="nav-link" onclick="desplazar('s3')">Atención</a>
                    </li>
                    <li class="nav-item">
                        <a style="cursor: pointer;" class="nav-link" onclick="desplazar('s4')">Contanctanos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Acceder</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="banner_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Cuidando tu<br><span style="color: #151515;">Salud</span></h1>
                                    <p class="banner_text">Somos especialistas en cuidarte y cuidar a los que amas.</p>
                                    <div class="btn_main">
                                        <div class="more_bt"><a href="#" wire:click="getWhatsapp">Contactanos</a></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="image_1"><img src="images/img-1.png"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="banner_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Reabilitación Fisica<br><span style="color: #151515;">Deportiva</span></h1>
                                    <p class="banner_text">La primera de las técnicas de rehabilitación deportiva es la fisioterapia deportiva.</p>
                                    <div class="btn_main">
                                        <div class="more_bt"><a href="#" wire:click="getWhatsapp">Contactanos</a></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="image_1"><img src="images/fisioterapia.png"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="banner_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Tratamientos <br><span style="color: #151515;">Especializados</span></h1>
                                    <p class="banner_text">Tratamientos para cada parte de tu cuerpo.</p>
                                    <div class="btn_main">
                                        <div class="more_bt"><a href="#" wire:click="getWhatsapp">Contactanos</a></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="image_1"><img src="images/mus.png" style="height: 440px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                <i class="fa fa-long-arrow-left" style="font-size:24px; padding-top: 4px;"></i>
            </a>
            <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                <i class="fa fa-long-arrow-right" style="font-size:24px; padding-top: 4px;"></i>
            </a>
        </div>
    </div>
    <div class="health_section layout_padding">
        <div class="container" id="s1">
            <h1 class="health_taital">lo mejor en atención médica para ti</h1>
            <p class="health_text">Somos una clinica especializada en tratar el cuerpo humano con las mejores técnicas y herramientas de Oruro.</p>
            <div class="health_section layout_padding">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="image_main">
                            <div class="main">
                                <img src="images/fisio1.webp" alt="Avatar" class="image" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="image_main_1">
                            <div class="main">
                                <img src="images/fisio2.webp" alt="Avatar" class="image" style="width:100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="knowledge_section layout_padding">
        <div class="container" id="s2">
            <div class="knowledge_main">
                <div class="left_main">
                    <h1 class="knowledge_taital">conocimiento del centro</h1>
                    <p class="knowledge_text">Somos expertos en lo que hacemos, tratamos enfermedades Traumatologicas, por lesiones deportivas, neurologicas.</p>
                </div>
                <div class="right_main">
                    <div class="play_icon"><a href="#"><img src="images/play-icon.png"></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="news_section layout_padding">
        <div class="container" id="s3">
            <h1 class="health_taital">¿Por qué elegirnos?</h1>
            <p class="health_text">Contamos con horarios comodos y personal Especializado.</p>
            <div class="news_section_2 layout_padding">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="box_main">
                            <div class="icon_1"><img src="images/icon-2.png"></div>
                            <h4 class="daily_text">expertos en cuidado</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="box_main active">
                            <div class="icon_1"><img src="images/icon-3.png"></div>
                            <h4 class="daily_text_1">disponible 24/7</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="box_main">
                            <div class="icon_1"><img src="images/icon-4.png"></div>
                            <h4 class="daily_text_1">cuidado equilibrado</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact_section layout_padding">
        <div class="container" id="s4">
            <h1 class="contact_taital">que hacemos</h1>
            <div class="news_section_2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="icon_main">
                            <div class="icon_7"><img src="images/icon-7.png"></div>
                            <h4 class="diabetes_text">Diabetes y asesoramiento sobre obesidad </h4>
                        </div>
                        <div class="icon_main">
                            <div class="icon_7"><img src="images/icon-5.png"></div>
                            <h4 class="diabetes_text">Reabilitación Fisica Deportiva</h4>
                        </div>
                        <div class="icon_main">
                            <div class="icon_7"><img src="images/icon-6.png"></div>
                            <h4 class="diabetes_text">Tratamiento Especializado</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact_box">
                            <h1 class="book_text">Contactarse</h1>
                            <input wire:model="name" type="text" class="Email_text" placeholder="Nombre" name="Name">
                            <textarea wire:model="message" class="massage-bt" placeholder="Mensaje" rows="5" id="comment" name="Massage"></textarea>
                            <div class="send_bt"><a href="#" wire:click="sendMessage">Enviar</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">2024©OZONO</p>
        </div>
    </div>
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript -->
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script>
function desplazar(id) {
    document.getElementById(id).scrollIntoView({
    behavior: 'smooth'  // Desplazamiento suave
});
}
</script>
</div>
